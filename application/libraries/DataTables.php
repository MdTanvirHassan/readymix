<?php 
class DataTables {
    
    protected $CI;
    private $database;
    
    public function __construct($db = NULL)
    {
        $this->CI =& get_instance();
    }
    
    public function setDatabase($database) {
        $this->database = $database;
    }
    
    public function getDatabase() {
        return $this->database;
    }
    
    public function get_json($aTable = NULL, $aColumns = NULL,$joinTable=NULL,$JoinCriteria=NULL,$joinStatus=NULL,$where=NULL)
    {   
        // Load CI Database library
        $this->CI->load->database($this->database);
        
        // Read dataTables POST variables
        $iDraw = $this->CI->input->post('draw');
        $iColumns = $this->CI->input->post('columns');
        $iOrder = $this->CI->input->post('order');
        $iStart = $this->CI->input->post('start');
        $iLength = $this->CI->input->post('length');
        $iSearch = $this->CI->input->post('search');
        

        

        // Total rows in the table
        $recordsTotal = $this->CI->db->count_all($aTable);
        

        if (is_array($joinTable)) { // For multiple table join
            foreach ($joinTable as $key => $table)
            $this->CI->db->join($table, $JoinCriteria[$key], $joinStatus[$key]);
        } else { // For single table Join
            $this->CI->db->join($joinTable, $JoinCriteria, $joinStatus);
        }

        // Filtering
        // NOTE: This does not match the built-on DataTables filtering which does it
        // word by word on any field. It's possible to do here, but concerned about efficiency
        // on very large tables.
        $recordsFiltered = $recordsTotal;
        
        if(isset($iSearch) && $iSearch['value'] != '') {
            for($i=0; $i < count($aColumns); $i++) {
                $this->CI->db->or_like($aColumns[$i], $iSearch['value'],'after');
            }
            
            // Saves number of records that matches the query and filters
            //$recordsFiltered = $this->CI->db->count_all_results($aTable, false);
        }
        
        if(isset($iSearch) && $iSearch['value'] != '') {
            for($i=0; $i < count($aColumns); $i++) {
                $this->CI->db->or_like($aColumns[$i], $iSearch['value'],'after');
            }
        }
        
        // Write the SELECT portion of the query
        $this->CI->db->select(implode(',', $aColumns));
     
        // Ordering
        if(isset($iOrder)) {
            for($i=0; $i < count($iOrder); $i++) {
                $this->CI->db->order_by($aColumns[$iOrder[0]['column']], strtoupper($iOrder[0]['dir']));
            }
        } else {
            $this->CI->db->order_by($aColumns[0], 'ASC');
        }
        $limitData = $this->CI->db->get($aTable);

        if (is_array($joinTable)) { // For multiple table join
            foreach ($joinTable as $key => $table)
            $this->CI->db->join($table, $JoinCriteria[$key], $joinStatus[$key]);
        } else { // For single table Join
            $this->CI->db->join($joinTable, $JoinCriteria, $joinStatus);
        }

        // Filtering
        // NOTE: This does not match the built-on DataTables filtering which does it
        // word by word on any field. It's possible to do here, but concerned about efficiency
        // on very large tables.
        $recordsFiltered = $recordsTotal;
        
        if(isset($iSearch) && $iSearch['value'] != '') {
            for($i=0; $i < count($aColumns); $i++) {
                $this->CI->db->or_like($aColumns[$i], $iSearch['value'],'after');
            }
            
            // Saves number of records that matches the query and filters
            //$recordsFiltered = $this->CI->db->count_all_results($aTable, false);
        }
        
        if(isset($iSearch) && $iSearch['value'] != '') {
            for($i=0; $i < count($aColumns); $i++) {
                $this->CI->db->or_like($aColumns[$i], $iSearch['value'],'after');
            }
        }
        if(!empty($where)){
            foreach($where as $field=>$val){
                if($field=='between')
                    $this->CI->db->where($val);
                else
                    $this->CI->db->where($field, $val);
            } 
        }
        
        // Write the SELECT portion of the query
        $this->CI->db->select(implode(',', $aColumns));
     
        // Ordering
        if(isset($iOrder)) {
            for($i=0; $i < count($iOrder); $i++) {
                $this->CI->db->order_by($aColumns[$iOrder[0]['column']], strtoupper($iOrder[0]['dir']));
            }
        } else {
            $this->CI->db->order_by($aColumns[0], 'ASC');
        }

        // Paging
        if(isset($iStart) && $iLength != '-1') {
            $this->CI->db->limit($iLength, $iStart);
        } else {
            $this->CI->db->limit(25, 1);
        }
        
        // Select Data
        $Data = $this->CI->db->get($aTable);
       
        //echo $this->CI->db->last_query();exit;
        return array(
            "draw" => isset($iDraw) ? $iDraw : 1,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $limitData->num_rows(),
            "data" => $Data->result()
            );
    }
}