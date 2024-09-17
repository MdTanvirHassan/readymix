<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_common extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /* insert column function expects two parameter. 1st one is table name and 2nd one is data. $data variable will be an array of data which expects information like following
     * $data['user_id'], $data['user_name] .... etc
     * 
     */

    function insert_row($table_name, $data) {
        $this->db->insert($table_name, $data);
        return $this->db->insert_id();
    }

    /* delete_row function expects two parameter. 1st one is table name and 2nd one is where condition. $where_param variable will be an array of data which expects information like following
     * $data['user_id'], $data['user_name] .... etc
     * 
     */

    function delete_row($table_name, $where_param = false) {
        if (!empty($where_param))
            $this->db->where($where_param);
        $this->db->delete($table_name);
        return $this->db->affected_rows();
    }

    /* delete_multiple_row function expects two parameter. 1st one is table name and 2nd one is where_in condition. $where_param variable will be an array of data which expects information like following
     * $data['user_id'], $data['user_name] .... etc
     * 
     */

    function delete_multiple_row($table_name, $select_column_name, $where_in_param) {
        $this->db->where_in($select_column_name, $where_in_param);
        $this->db->delete($table_name);
        return $this->db->affected_rows();
    }

    /* update_row function expects three parameter. 1st one is table name and 2nd one is where condition and the 3rd parameter is data to be updated. $where_param variable and $data will be an array of data which expects information like following
     * $where['user_id'], $where['user_name] .... etc
     * $data['user_id'], $data['user_name] .... etc
     */

    function update_row($table_name, $where_param, $data) {
        $this->db->where($where_param);
        $this->db->update($table_name, $data);
        return $this->db->affected_rows();
    }

    /* get_row function expects three parameter. 1st one is table name and 2nd one is where condition and the 3rd parameter is the fields which we select to grab from database. $where_param variable will be an array of data which expects information like following
     * $where['user_id'], $where['user_name] .... etc
     * $select param expects array and string both like following
     * $select_param['user_id'], $select_param['user_name']  or $select_param = "*"
     * and this function will return data in object format
     */

    function get_row($table_name, $where_param, $select_param, $group = "", $limit = "") {
        if (!empty($select_param))
            $this->db->select($select_param);
        if (!empty($where_param))
            $this->db->where($where_param);
        $this->db->group_by($group);
        if (!empty($limit))
            $this->db->limit($limit);
        $result = $this->db->get($table_name);
        return $result->result();
    }

    function get_row_datatable($table, $where = "") {

        if ($where != "") {
            $this->db->where('(' . $where . ')');
        }
        $result = $this->db->get($table);
        return $result->result();
    }

    function get_row_in_array_datatable($table_name, $where_param) {
        if ($where_param != "") {
            $this->db->where('(' . $where_param . ')');
        }
        $result = $this->db->get($table_name);

        return $result->result_array();
    }

    function get_row_in_array_datatable_order($table_name, $where_param, $order_by = false, $order_value = false) {
        if ($where_param != "") {
            $this->db->where('(' . $where_param . ')');
        }
        if (!empty($order_by))
            $this->db->order_by($order_by, $order_value);
        $result = $this->db->get($table_name);

        return $result->result_array();
    }

    function get_row_array($table_name, $where_param, $select_param, $group = "", $limit = "", $order_by = false, $order_value = false) {
        if (!empty($select_param))
            $this->db->select($select_param);
        if (!empty($where_param))
            $this->db->where($where_param);
        if (!empty($group))
            $this->db->group_by($group);
        if (!empty($order_by))
            $this->db->order_by($order_by, $order_value);
        if (!empty($limit))
            $this->db->limit($limit);
        $result = $this->db->get($table_name);
        return $result->result_array();
    }

    function get_row_wherein_array($table_name, $where_param, $select_param, $group = "", $limit = "", $order_by = false, $order_value = false) {
        if (!empty($select_param))
            $this->db->select($select_param);
        if (!empty($where_param))
            $this->db->where_in($where_param);
        if (!empty($group))
            $this->db->group_by($group);
        if (!empty($order_by))
            $this->db->order_by($order_by, $order_value);
        if (!empty($limit))
            $this->db->limit($limit);
        $result = $this->db->get($table_name);
        return $result->result_array();
    }

    function get_report_array($table_name, $where_param, $select_param, $postData) {
        if (!empty($select_param))
            $this->db->select($select_param);
        if (!empty($where_param))
            $this->db->where($where_param);

        if (!empty($postData['from_date']) && !empty($postData['to_date'])) {
            $this->db->where('created_date >=', $postData['from_date']);
            $this->db->where('created_date <=', $postData['to_date']);
        } else if (!empty($postData['from_date']) && empty($postData['to_date'])) {
            $this->db->where('created_date >=', $postData['from_date']);
            $this->db->where('created_date <=', date('Y-m-d'));
        } else if (empty($postData['from_date']) && !empty($postData['to_date'])) {
            $this->db->where('created_date <=', $postData['to_date']);
        }

        if (!empty($group))
            $this->db->group_by($group);
        if (!empty($limit))
            $this->db->limit($limit);
        $result = $this->db->get($table_name);
        return $result->result_array();
    }

    function get_row_pagination($table_name, $limit, $page) {
        $this->db->limit($limit, $page);
        $result = $this->db->get($table_name);
        return $result->result_array();
    }

    function customeQuery($sql) {
        $result = $this->db->query($sql);
        return $result->result_array();
    }

    function customeUpdate($sql) {
        $this->db->query($sql);
        return true;
    }

    function get_row_like($table_name, $where_param, $select_param, $like, $limit = "") {

        $this->db->select($select_param);
        //$this->db->select('CONCAT("<li>",division,",",district,",",thana,",",area,",",post_code,"</li>") as item',false);
        //$this->db->where();
        $this->db->where($like);
        if (!empty($limit))
            $this->db->limit($limit);
        $result = $this->db->get($table_name);
        return $result->result_array();
    }

    /* get_row function expects three parameter. 1st one is table name and 2nd one is where condition and the 3rd parameter is the fields which we select to grab from database. $where_param variable will be an array of data which expects information like following
     * $where['user_id'], $where['user_name] .... etc
     * $select param expects array and string both like following
     * $select_param['user_id'], $select_param['user_name']  or $select_param = "*"
     * and this function will return data in array format
     */

    function get_row_in_array($table_name, $where_param, $select_param) {
        $this->db->select($select_param);
        $this->db->where($where_param);
        $result = $this->db->get($table_name);
        return $result->result_array();
    }

    function get_row_user($where_param) {
        if ($where_param != "") {
            $this->db->where('(' . $where_param . ')');
        }
        $result = $this->db->get("`news_users`");
        return $result;
    }

    function get_row_in_datatable_withJoin($table_name, $where_param, $select, $joinTable, $JoinCriteria, $joinStatus = '', $order_by = false, $order_value = false) {

        $this->db->select($select);
        $this->db->from($table_name);
        if (is_array($joinTable)) { // For multiple table join
            foreach ($joinTable as $key => $table)
                $this->db->join($table, $JoinCriteria[$key], $joinStatus[$key]);
        } else { // For single table Join
            $this->db->join($joinTable, $JoinCriteria, $joinStatus);
        }
        if ($where_param != "") {
            $this->db->where('(' . $where_param . ')');
        }
        if (!empty($order_by))
            $this->db->order_by($order_by, $order_value);
        $result = $this->db->get();
        return $result->result_array();
    }

    function insert_slide_image($tata) {
        $result = $this->db->insert('pages_slider', $tata);
        return $this->db->insert_id();
    }

    function get_selected_user($id) {
        $this->db->where('id', $id);
        $result = $this->db->get('users');
        return $result->result_array();
    }

    function get_cat_title($id) {
        $this->db->where('id', $id);
        $result = $this->db->get('category');
        return $result->result_array();
    }

    public function update_user($data, $where) {
        $this->db->where($where);
        if ($this->db->update('users', $data))
            return true;
        else
            return false;
    }

    public function get_search_result($table, $where, $select) {
        $this->db->select($select);
        $i = 1;
        foreach ($where as $item) {
            // if($i==1)
            $this->db->where($item);
            /*  else 
              $this->db->or_where($item);
              $i++; */
        }
        $result = $this->db->get($table);
        //echo $this->db->last_query();
        return $result->result_array();
        //return $this->db->get($table);
    }

    //Agent Login Process
    function login($username, $password, $user_type, $table_name) {
        $password = md5($password);
        $this->db->where("uname", $username);
        $this->db->where("pass", $password);
        $this->db->where("rank", $user_type);
        $res = $this->db->get($table_name);
        //echo $this->db->last_query();
        $num_rows = $res->num_rows();

        if ($num_rows == 1) {
            return $res->row();
        } else {
            return FALSE;
        }
    }

    //Agent Login without md5 Process
    function login_with_password_string($username, $password, $table_name) {
//        $this->db->where("uname", $username);
//        $this->db->where("pass", $password);
         $this->db->where("username", $username);
         $this->db->where("password", $password);
         $this->db->where("status",1);
         //$this->db->where("rank", $user_type);
         $res = $this->db->get($table_name);
         //echo $this->db->last_query();
         $num_rows = $res->num_rows();

        if ($num_rows == 1) {
            return $res->row();
        } else {
            return FALSE;
        }
    }

    function change_password($data) {
        $this->db->where('id', 1);
        $res = $this->db->get("users");
        $res = $res->row();
        if ($res->password != md5($data['old_pass'])) {
            return "Invalid password";
        }

        if ($data['pass_1'] != $data['pass_2']) {
            return "Passwords not match";
        }

        if (strlen($data['pass_1']) < 6 || strlen($data['pass_1']) > 20) {
            return "Passwords length must be between 6 to 20 charecters";
        }

        $this->db->update("admin", array("password" => md5($data['pass_1'])));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        else
            return "Cannot change password";
    }

    //stadium insert

    public function stadium_insert($data) {

        $this->db->insert('stadiums', $data);
    }

    public function short_stadium() {

        $query = $this->db->get('stadiums');
        return $query->result();
    }

    public function update_stadiums($data) {

        $this->db->where('stadium_id', $data['stadium_id']);
        $query = $this->db->update('stadiums', $data);
        return $this->db->affected_rows();
    }

    public function updatestadium($id) {
        $this->db->where('stadium_id', $id);
        $query = $this->db->get('stadiums');
        return $query->row();
    }

    public function deletestadium($id) {

        $this->db->where('stadium_id', $id);
        $this->db->delete('stadiums');
        return $this->db->affected_rows();
    }

    public function view_stadium($id) {

        $this->db->where('stadium_id', $id);
        $this->db->from('stadiums');
        $query = $this->db->get();
        return $query->result();
    }

    public function updatetoNotdlete($id) {
        $this->db->set('is_deleted', '0');
        $this->db->where('stadium_id', $id);
        $query = $this->db->update('stadiums');
    }

    public function updatetodelete($id) {
        $this->db->set('is_deleted', '1');
        $this->db->where('stadium_id', $id);
        $query = $this->db->update('stadiums');
    }

//   BRnd
    public function brand_insert($data) {

        $this->db->insert('menu', $data);
    }

    public function short_brand() {

        $query = $this->db->get('brands');
        return $query->result();
    }

    public function update_brand($data) {

        $this->db->where('brand_id', $data['brand_id']);
        $query = $this->db->update('brands', $data);
        return $this->db->affected_rows();
    }

    public function updatebrand($id) {
        $this->db->where('brand_id', $id);
        $query = $this->db->get('brands');
        return $query->row();
    }

    public function deletebrand($id) {

        $this->db->where('brand_id', $id);
        $this->db->delete('brands');
        return $this->db->affected_rows();
    }

    public function view_all_brand($id) {

        $this->db->where('brand_id', $id);
        $this->db->from('brands');
        $query = $this->db->get();
        return $query->result();
    }

    public function updatetoNotdlete_brand($id) {
        $this->db->set('is_deleted', '0');
        $this->db->where('brand_id', $id);
        $query = $this->db->update('brands');
    }

    public function updatetodelete_brand($id) {
        $this->db->set('is_deleted', '1');
        $this->db->where('brand_id', $id);
        $query = $this->db->update('brands');
    }

    //   conseccion
    public function concession_insert($data) {

        $this->db->insert('concession_stands', $data);
    }

    public function short_concession() {

        $query = $this->db->get('concession_stands');
        return $query->result();
    }

    public function update_concession($data) {

        $this->db->where('concession_id', $data['concession_id']);
        $query = $this->db->update('concession_stands', $data);
        return $this->db->affected_rows();
    }

    public function updateconcession($id) {
        $this->db->where('concession_id', $id);
        $query = $this->db->get('concession_stands');
        return $query->row();
    }

    public function deleteconcession($id) {

        $this->db->where('concession_id', $id);
        $this->db->delete('concession_stands');
        return $this->db->affected_rows();
    }

    public function view_all_concession($id) {

        $this->db->where('concession_id', $id);
        $this->db->from('concession_stands');
        $query = $this->db->get();
        return $query->result();
    }

    public function updatetodelete_concession($id) {
        $this->db->set('is_deleted', '1');
        $this->db->where('concession_id', $id);
        $query = $this->db->update('concession_stands');
    }

    //menu category
    public function updatetobrand($id) {
        $this->db->set('is_brand', '1');
        $this->db->set('is_brand_created', '1');
        $this->db->where('menu_category_id', $id);
        $query = $this->db->update('menu_categories');
    }

    public function update_category($data) {

        $this->db->where('menu_category_id', $data['menu_category_id']);
        $query = $this->db->update('menu_categories', $data);
        return $this->db->affected_rows();
    }

    public function updatecategory($id) {
        $this->db->where('menu_category_id', $id);
        $query = $this->db->get('menu_categories');
        return $query->row();
    }

    public function updatetenable($id) {
        $this->db->where('menu_category_id', $id);
        $this->db->update('menu_categories', array('is_enable' => '1'));
    }

    public function updatetdisable($id) {
        $this->db->where('menu_category_id', $id);
        $this->db->update('menu_categories', array('is_enable' => '0'));
    }

    public function category_delete($id) {
        $this->db->set('is_deleted', '1');
        $this->db->where('menu_category_id', $id);
        $query = $this->db->update('menu_categories');
    }

    public function view_all_category($id) {
        $this->db->select('*');
        $this->db->from('brands');
        $this->db->join('menu_categories', 'menu_categories.brand_id = brands.brand_id');
        $query = $this->db->get();
        return $query->result();
    }

    function get_login_row($table_name, $where_param, $select_param, $group = "", $limit = "") {
        $this->db->select($select_param);
        $this->db->or_where($where_param);
        $this->db->group_by($group);
        if (!empty($limit))
            $this->db->limit($limit);
        $result = $this->db->get($table_name);
        return $result->result();
    }

}

// END Admin_model Class

/* End of file admin_model.php */
/* Location: ./application/models/admin_model.php */