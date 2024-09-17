<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mahana_model extends CI_Model {

    /**
     * Send a New Message
     *
     * @param   integer  $sender_id
     * @param   mixed    $recipients  A single integer or an array of integers
     * @param   string   $subject
     * @param   string   $body
     * @param   integer  $priority
     * @return  boolean
     */
    function send_new_message($sender_id, $recipients, $subject, $body, $priority) {
        $this->db->trans_start();

        $thread_id = $this->_insert_thread($subject);
        $msg_id = $this->_insert_message($thread_id, $sender_id, $recipients, $body, $priority);

        // Create batch inserts
        // $participants[] = array('thread_id' => $thread_id,'user_group' => $recipients);
        //  $statuses     = array('message_id' => $msg_id, 'user_group' => $recipients,'user_id'=>$sender_id,'status' => MSG_STATUS_READ);
        //  if ( ! is_array($recipients))
        //{
        $participants[] = array('thread_id' => $thread_id, 'user_group' => $recipients);

        //}
        // else
        //{
        ///  foreach ($recipients as $recipient)
        //{
        //  $participants[] = array('thread_id' => $thread_id,'user_group' => $recipient);
        // $statuses[]     = array('message_id' => $msg_id, 'user_group' => $recipient, 'status' => MSG_STATUS_UNREAD);
        //}
        //}
        // $this->_insert_participants($participants);
        $users = $this->get_users_by_group($recipients);
        foreach ($users as $user) {
            
            $statuses = array('message_id' => $msg_id, 'user_group' => $recipients, 'user_id' => $user['id'], 'status' => MSG_STATUS_UNREAD);
            $this->_insert_statuses($statuses);
        }


        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        return $thread_id;
    }

    function get_users_by_group($group) {
        $this->db->select('id');
        $this->db->where('userGroup', $group);
        $result = $this->db->get('users');
        return $result->result_array();
    }

    // ------------------------------------------------------------------------

    /**
     * Reply to Message
     *
     * @param   integer  $reply_msg_id
     * @param   integer  $sender_id
     * @param   string   $body
     * @param   integer  $priority
     * @return  boolean
     */
    function reply_to_message($reply_msg_id, $sender_id, $body, $recipient_id, $priority) {
        $this->db->trans_start();

        // Get the thread id to keep messages together
        if (!$thread_id = $this->_get_thread_id_from_message($reply_msg_id)) {
            return FALSE;
        }

        // Add this message
        $msg_id = $this->_insert_message($thread_id, $sender_id, $recipient_id, $body, $priority);

        if ($recipients = $this->_get_thread_participants($thread_id, $sender_id)) {
            $statuses[] = array('message_id' => $msg_id, 'user_group' => $sender_id, 'status' => MSG_STATUS_READ);

            foreach ($recipients as $recipient) {
                $statuses[] = array('message_id' => $msg_id, 'user_group' => $recipient['user_group'], 'status' => MSG_STATUS_UNREAD);
            }

            $this->_insert_statuses($statuses);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        return TRUE;
    }

    // ------------------------------------------------------------------------

    /**
     * Get a Single Message
     *
     * @param  integer $msg_id
     * @param  integer $user_id
     * @return array
     */
    function get_message($msg_id, $user_group) {
        $sql = 'SELECT m.*, s.status, t.subject, ' . USER_TABLE_USERNAME .
                ' FROM ' . $this->db->dbprefix . 'msg_messages m ' .
                ' JOIN ' . $this->db->dbprefix . 'msg_threads t ON (m.thread_id = t.id) ' .
                ' JOIN ' . $this->db->dbprefix . USER_TABLE_TABLENAME . ' ON (' . USER_TABLE_ID . ' = m.sender_id) ' .
                ' JOIN ' . $this->db->dbprefix . 'msg_status s ON (s.message_id = m.id AND s.user_group = ? ) ' .
                ' WHERE m.id = ? ';

        $query = $this->db->query($sql, array($user_group, $msg_id));

        return $query->result_array();
    }

    // ------------------------------------------------------------------------

    /**
     * Get a Full Thread
     *
     * @param   integer  $thread_id
     * @param   integer  $user_id
     * @param   boolean  $full_thread
     * @param   string   $order_by
     * @return  array
     */
    function get_full_thread($thread_id, $user_group, $full_thread = FALSE, $order_by = 'asc') {
        $sql = 'SELECT m.*, s.status, t.subject, ' . USER_TABLE_USERNAME .
                ' FROM ' . $this->db->dbprefix . 'msg_participants p ' .
                ' JOIN ' . $this->db->dbprefix . 'msg_threads t ON (t.id = p.thread_id) ' .
                ' JOIN ' . $this->db->dbprefix . 'msg_messages m ON (m.thread_id = t.id) ' .
                ' JOIN ' . $this->db->dbprefix . USER_TABLE_TABLENAME . ' ON (' . USER_TABLE_ID . ' = m.sender_id) ' .
                ' JOIN ' . $this->db->dbprefix . 'msg_status s ON (s.message_id = m.id AND s.user_group = ? ) ' .
                ' WHERE p.user_group = ? ' .
                ' AND p.thread_id = ? ';

        if (!$full_thread) {
            $sql .= ' AND m.cdate >= p.cdate';
        }

        $sql .= ' ORDER BY m.cdate ' . $order_by;

        $query = $this->db->query($sql, array($user_group, $user_group, $thread_id));

        return $query->result_array();
    }

    // ------------------------------------------------------------------------

    /**
     * Get All Threads
     *
     * @param   integer  $user_id
     * @param   boolean  $full_thread
     * @param   string   $order_by
     * @return  array
     */
    function get_all_threads($user_group, $full_thread = FALSE, $order_by = 'asc') {
        $sql = 'SELECT m.*, s.status, t.subject, ' . USER_TABLE_USERNAME . ', (SELECT `users`.`name` from `users` where (`users`.`id` = `m`.`recipient_id`)) AS recipient_name' .
                ' FROM ' . $this->db->dbprefix . 'msg_participants p ' .
                ' JOIN ' . $this->db->dbprefix . 'msg_threads t ON (t.id = p.thread_id) ' .
                ' JOIN ' . $this->db->dbprefix . 'msg_messages m ON (m.thread_id = t.id) ' .
                ' JOIN ' . $this->db->dbprefix . USER_TABLE_TABLENAME . ' ON (' . USER_TABLE_ID . ' = m.sender_id) ' .
                ' JOIN ' . $this->db->dbprefix . 'msg_status s ON (s.message_id = m.id AND s.user_group = ? ) ' .
                ' WHERE p.user_group = ? ';

        if (!$full_thread) {
            $sql .= ' AND m.cdate >= p.cdate';
        }

        $sql .= ' ORDER BY t.id ' . $order_by . ', m.cdate ' . $order_by;

        $query = $this->db->query($sql, array($user_group, $user_group));

        return $query->result_array();
    }

    // ------------------------------------------------------------------------

    /**
     * Change Message Status
     *
     * @param   integer  $msg_id
     * @param   integer  $user_id
     * @param   integer  $status_id
     * @return  integer
     */
    function update_message_status($msg_id, $user_group, $status_id) {
        $this->db->where(array('message_id' => $msg_id, 'user_group' => $user_group));
        $this->db->update('msg_status', array('status' => $status_id));

        return $this->db->affected_rows();
    }

    // ------------------------------------------------------------------------

    /**
     * Add a Participant
     *
     * @param   integer  $thread_id
     * @param   integer  $user_id
     * @return  boolean
     */
    function add_participant($thread_id, $user_group) {
        $this->db->trans_start();

        $participants[] = array('thread_id' => $thread_id, 'user_group' => $user_group);

        $this->_insert_participants($participants);

        // Get Messages by Thread
        $messages = $this->_get_messages_by_thread_id($thread_id);

        foreach ($messages as $message) {
            $statuses[] = array('message_id' => $message['id'], 'user_group' => $user_group, 'status' => MSG_STATUS_UNREAD);
        }

        $this->_insert_statuses($statuses);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        return TRUE;
    }

    // ------------------------------------------------------------------------

    /**
     * Remove a Participant
     *
     * @param   integer  $thread_id
     * @param   integer  $user_id
     * @return  boolean
     */
    function remove_participant($thread_id, $user_group) {
        $this->db->trans_start();

        $this->_delete_participant($thread_id, $user_group);
        $this->_delete_statuses($thread_id, $user_group);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        return TRUE;
    }

    // ------------------------------------------------------------------------

    /**
     * Valid New Participant - because of CodeIgniter's DB Class return style,
     *                         it is safer to check for uniqueness first
     *
     * @param   integer $thread_id
     * @param   integer $user_id
     * @return  boolean
     */
    function valid_new_participant($thread_id, $user_group) {
        $sql = 'SELECT COUNT(*) AS count ' .
                ' FROM ' . $this->db->dbprefix . 'msg_participants p ' .
                ' WHERE p.thread_id = ? ' .
                ' AND p.user_group = ? ';

        $query = $this->db->query($sql, array($thread_id, $user_group));

        if ($query->row()->count) {
            return FALSE;
        }

        return TRUE;
    }

    // ------------------------------------------------------------------------

    /**
     * Application User
     *
     * @param   integer  $user_id`
     * @return  boolean
     */
    function application_user($user_group) {
        $sql = 'SELECT COUNT(*) AS count ' .
                ' FROM ' . $this->db->dbprefix . USER_TABLE_TABLENAME .
                ' WHERE ' . USER_TABLE_ID . ' = ?';

        $query = $this->db->query($sql, array($user_group));

        if ($query->row()->count) {
            return TRUE;
        }

        return FALSE;
    }

    // ------------------------------------------------------------------------

    /**
     * Get Participant List
     *
     * @param   integer  $thread_id
     * @param   integer  $sender_id
     * @return  mixed
     */
    function get_participant_list($thread_id, $sender_id = 0) {
        if ($results = $this->_get_thread_participants($thread_id, $sender_id)) {
            return $results;
        }
        return FALSE;
    }

    // ------------------------------------------------------------------------

    /**
     * Get Message Count
     *
     * @param   integer  $user_id
     * @param   integer  $status_id
     * @return  integer
     */
    function get_msg_count($where, $status_id = MSG_STATUS_UNREAD) {
        $query = $this->db->select('COUNT(*) AS msg_count')->where($where)->get('msg_status');

        return $query->row()->msg_count;
    }

    // ------------------------------------------------------------------------
    // Private Functions from here out!
    // ------------------------------------------------------------------------

    /**
     * Insert Thread
     *
     * @param   string  $subject
     * @return  integer
     */
    private function _insert_thread($subject) {
        $insert_id = $this->db->insert('msg_threads', array('subject' => $subject));

        return $this->db->insert_id();
    }

    /**
     * Insert Message
     *
     * @param   integer  $thread_id
     * @param   integer  $sender_id
     * @param   string   $body
     * @param   integer  $priority
     * @return  integer
     */
    private function _insert_message($thread_id, $sender_id, $recipients, $body, $priority) {
        $insert['thread_id'] = $thread_id;
        $insert['sender_id'] = $sender_id;
        $insert['user_group'] = $recipients;
        $insert['body'] = $body;
        $insert['priority'] = $priority;

        $insert_id = $this->db->insert('msg_messages', $insert);

        return $this->db->insert_id();
    }

    /**
     * Insert Participants
     *
     * @param   array  $participants
     * @return  bool
     */
    private function _insert_participants($participants) {
        return $this->db->insert_batch('msg_participants', $participants);
    }

    /**
     * Insert Statuses
     *
     * @param   array  $statuses
     * @return  bool
     */
    private function _insert_statuses($statuses) {

        return $this->db->insert('msg_status', $statuses);
    }

    /**
     * Get Thread ID from Message
     *
     * @param   integer  $msg_id
     * @return  integer
     */
    private function _get_thread_id_from_message($msg_id) {
        $query = $this->db->select('thread_id')->get_where('msg_messages', array('id' => $msg_id));

        if ($query->num_rows()) {
            return $query->row()->thread_id;
        }
        return 0;
    }

    /**
     * Get Messages by Thread
     *
     * @param   integer  $thread_id
     * @return  array
     */
    private function _get_messages_by_thread_id($thread_id) {
        $query = $this->db->get_where('msg_messages', array('thread_id' => $thread_id));

        return $query->result_array();
    }

    /**
     * Get Thread Particpiants
     *
     * @param   integer  $thread_id
     * @param   integer  $sender_id
     * @return  array
     */
    private function _get_thread_participants($thread_id, $sender_id = 0) {
        $array['thread_id'] = $thread_id;

        if ($sender_id) { // If $sender_id 0, no one to exclude
            $array['msg_participants.user_group != '] = $sender_id;
        }

        $this->db->select('msg_participants.user_group, ' . USER_TABLE_USERNAME, FALSE);
        $this->db->join(USER_TABLE_TABLENAME, 'msg_participants.user_group = ' . USER_TABLE_ID);

        $query = $this->db->get_where('msg_participants', $array);

        return $query->result_array();
    }

    /**
     * Delete Participant
     *
     * @param   integer  $thread_id
     * @param   integer  $user_id
     * @return  boolean
     */
    private function _delete_participant($thread_id, $user_group) {
        $this->db->delete('msg_participants', array('thread_id' => $thread_id, 'user_group' => $user_group));

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Delete Statuses
     *
     * @param   integer  $thread_id
     * @param   integer  $user_id
     * @return  boolean
     */
    private function _delete_statuses($thread_id, $user_group) {
        $sql = 'DELETE s FROM msg_status s ' .
                ' JOIN ' . $this->db->dbprefix . 'msg_messages m ON (m.id = s.message_id) ' .
                ' WHERE m.thread_id = ? ' .
                ' AND s.user_group = ? ';

        $query = $this->db->query($sql, array($thread_id, $user_group));

        return TRUE;
    }

}

/* end of file mahana_model.php */