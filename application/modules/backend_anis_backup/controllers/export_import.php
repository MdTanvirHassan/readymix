<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Export_import extends Site_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->is_logged_in($this->session->userdata('logged_in'))) {
            redirect_with_msg('backend/login', 'Please Login to see this page');
        }
        $this->load->model("m_common");
        $this->setTemplateFile('template');
        $this->user_id = $this->session->userdata('user_id');
    }

    function index() {
        $this->menu = 'export_import';
        $this->sub_menu = 'export_import';
        $this->titlebackend("Export Import List");
        $this->load->view('export_import');
    }

    function importDoctor() {
        if (isset($_FILES['doctor_list']['tmp_name']) && !empty($_FILES['doctor_list']['tmp_name'])) {
            $row = 1;
            if (($handle = fopen($_FILES['doctor_list']['tmp_name'], "r")) !== FALSE) {

                move_uploaded_file($_FILES['doctor_list']['tmp_name'], 'data.csv');
                $sql = "TRUNCATE TABLE physician";
                $this->m_common->customeUpdate($sql);

                $sql = "LOAD DATA LOCAL INFILE 'data.csv' INTO TABLE physician FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 LINES "
                        . "(phy_no,phy_name,phy_degree,phy_speciality,phy_address,phy_district,phy_thana,phy_year,phy_brick,phy_notes,phy_mt,phy_cns,phy_card,phy_oad,phy_port)";

                $this->m_common->customeUpdate($sql);
                $row = $this->m_common->customeQuery("SELECT ROW_COUNT() as total");
                $row = $row[0]['total'];

//                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//
//                    if ($row > 1) {
//                        $insertArray = array();
//                        $insertArray['phy_no'] = $data[0];
//                        $insertArray['phy_name'] = $data[1];
//                        $insertArray['phy_degree'] = $data[2];
//                        $insertArray['phy_speciality'] = $data[3];
//                        $insertArray['phy_address'] = $data[4];
//                        $insertArray['phy_district'] = $data[5];
//                        $insertArray['phy_thana'] = $data[6];
//                        $insertArray['phy_year'] = $data[7];
//                        $insertArray['phy_brick'] = $data[8];
//                        $insertArray['phy_notes'] = $data[9];
//                        $insertArray['phy_mt'] = $data[10];
//                        $insertArray['phy_cns'] = $data[11];
//                        $insertArray['phy_card'] = $data[12];
//                        $insertArray['phy_oad'] = $data[13];
//                        $insertArray['phy_port'] = $data[14];
//                        $phy_id = $this->m_common->get_row_array('physician', array('phy_no' => $insertArray['phy_no']), 'phy_id');
//                        if (empty($phy_id)) {
//                            $insertArray['phy_created'] = date('Y-m-d');
//                            $this->m_common->insert_row('physician', $insertArray);
//                        } else {
//                            $insertArray['phy_modified'] = date('Y-m-d');
//                            $this->m_common->update_row('physician', array('phy_id' => $phy_id[0]['phy_id']), $insertArray);
//                        }
//                    }
//
//                    $row++;
//                }
//                fclose($handle);
                redirect_with_msg('export_import/index', $row . ' Physician Uploaded successfully');
            }
        } else {
            redirect_with_msg('export_import/index', 'Please upload any csv file first');
        }
    }

    function exportDoctor() {
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=doctorList.csv");
        $fp = fopen('php://output', 'w');
        $i = 0;

        $data = $this->m_common->get_row_array('physician', '', 'phy_no,phy_name,phy_degree,phy_speciality,phy_address,phy_district,phy_thana,phy_year,phy_brick,phy_notes,phy_mt,phy_cns,phy_card,phy_oad,phy_port');
        //   $salesLine = $this->m_common->get_row_array('sales_line', '', '*');
        $header = array("PHY_ID", "PHY_NM", "PHY_DEGR", "PHY_SPC", "CH_ADD", "CH_DIST", "CH_THA", "RMONTH", "BRICK", "Notes", "MT", "CNS", "CARD", "OAD", "PORT");
//        foreach ($salesLine as $line) {
//            $header[] = $line['sl_name'];
//        }
        fputcsv($fp, $header);
        foreach ($data as $row) {
            fputcsv($fp, $row);
            $i++;
        }
        fclose($fp);
        exit;
    }

    function importTerritory() {
        if (isset($_FILES['territory_list']['tmp_name']) && !empty($_FILES['territory_list']['tmp_name'])) {
            $row = 1;
            if (($handle = fopen($_FILES['territory_list']['tmp_name'], "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                    if ($row > 1) {
                        $insertArray = array();
                        $insertArray['t_territory'] = $data[0];
                        $sl_id = $this->m_common->get_row_array('sales_line', array('sl_short_form' => $data[1]), 'sl_id');
                        if (empty($sl_id)) {
                            continue;
                        } else {
                            $insertArray['t_salesline'] = $sl_id[0]['sl_id'];
                        }

                        $insertArray['t_subline'] = $data[2];
                        $insertArray['t_note'] = $data[3];
                        $insertArray['t_team'] = $data[4];
                        $insertArray['t_region'] = $data[5];
                        $insertArray['t_email'] = $data[6];
                        $t_id = $this->m_common->get_row_array('territory', array('t_territory' => $insertArray['t_territory']), 't_id');
                        if (empty($t_id)) {
                            $insertArray['t_created'] = date('Y-m-d');
                            $this->m_common->insert_row('territory', $insertArray);
                        } else {
                            $insertArray['t_updated'] = date('Y-m-d');
                            $this->m_common->update_row('territory', array('t_id' => $t_id[0]['t_id']), $insertArray);
                        }
                    }

                    $row++;
                }
                fclose($handle);
                redirect_with_msg('export_import/index', $row . ' Territory Uploaded successfully');
            }
        } else {
            redirect_with_msg('export_import/index', 'Please upload any csv file first');
        }
    }

    function exportTerritory() {
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=territoryList.csv");
        $fp = fopen('php://output', 'w');
        $i = 0;
        $data = $this->m_common->get_row_array('territory', '', 't_territory,t_salesline,t_subline,t_note,t_team,t_region,t_email');
        $header = array("TERRITORY", "SALESLINE", "SUBLINE", "NOTES", "TEAM", "REGION", "EMAIL");
        fputcsv($fp, $header);
        foreach ($data as $row) {
            fputcsv($fp, $row);
            $i++;
        }
        fclose($fp);
        exit;
    }

    function importInstitution() {
        if (isset($_FILES['institution_list']['tmp_name']) && !empty($_FILES['institution_list']['tmp_name'])) {
            $row = 1;
            if (($handle = fopen($_FILES['institution_list']['tmp_name'], "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                    if ($row > 1) {
                        $insertArray = array();
                        $insertArray['inst_shop_sl'] = $data[0];
                        $insertArray['inst_shop_id'] = $data[1];
                        $insertArray['inst_spbasm'] = $data[2];
                        $insertArray['inst_spbmpo'] = $data[3];
                        $insertArray['inst_shop_name'] = $data[4];
                        $insertArray['inst_address'] = $data[5];
                        $insertArray['inst_district'] = $data[6];
                        $insertArray['inst_thana'] = $data[7];
                        $insertArray['inst_brick'] = $data[8];
                        $insertArray['inst_dummy_terr'] = $data[9];
                        $inst_id = $this->m_common->get_row_array('institute', array('inst_shop_sl' => $insertArray['inst_shop_sl']), 'inst_id');
                        if (empty($inst_id)) {
                            $insertArray['inst_created'] = date('Y-m-d');
                            $this->m_common->insert_row('institute', $insertArray);
                        } else {
                            $insertArray['inst_modified'] = date('Y-m-d');
                            $this->m_common->update_row('institute', array('inst_id' => $inst_id[0]['inst_id']), $insertArray);
                        }
                    }

                    $row++;
                }
                fclose($handle);
                redirect_with_msg('export_import/index', $row . ' Institute Uploaded successfully');
            }
        } else {
            redirect_with_msg('export_import/index', 'Please upload any csv file first');
        }
    }

    function exportInstitution() {
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=institutionList.csv");
        $fp = fopen('php://output', 'w');
        $i = 0;
        $data = $this->m_common->get_row_array('institute', '', 'inst_shop_sl,inst_shop_id,inst_spbasm,inst_spbmpo,inst_shop_name,inst_address,inst_district,inst_thana,inst_brick,inst_dummy_terr');
        $header = array("SHOP_SL", "SHOP_ID", "SPBASM", "SPBMPO", "SHOP_NM", "ADDRESS", "DISTRICT", "THANA", "BRICK", "DUMMY TERR");
        fputcsv($fp, $header);
        foreach ($data as $row) {
            fputcsv($fp, $row);
            $i++;
        }
        fclose($fp);
        exit;
    }

    function importInstitutionTerritory() {
        if (isset($_FILES['institution_list']['tmp_name']) && !empty($_FILES['institution_list']['tmp_name'])) {
            $row = 1;
            if (($handle = fopen($_FILES['institution_list']['tmp_name'], "r")) !== FALSE) {
           //     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {


                    move_uploaded_file($_FILES['institution_list']['tmp_name'], 'data.csv');
                    $sql = "TRUNCATE TABLE institute_territory";
                    $this->m_common->customeUpdate($sql);

                    $sql = "LOAD DATA LOCAL INFILE 'data.csv' INTO TABLE institute_territory FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 LINES "
                            . "(int_brick,@int_territory,@int_salesline,int_subline,int_note,int_team,int_region,int_share) set int_territory = (select t_id from territory where t_territory = @int_territory limit 1),int_salesline = (select sl_id from sales_line where sl_short_form = @int_salesline limit 1)";

                    $this->m_common->customeUpdate($sql);
                    $row = $this->m_common->customeQuery("SELECT ROW_COUNT() as total");
                    $row = $row[0]['total'];


//                    if ($row > 1) {
//                        $insertArray = array();
//                        $insertArray['int_brick'] = $data[0];
//                        $t_id = $this->m_common->get_row_array('territory', array('t_territory' => $data[1]), 't_id');
//                        if (empty($t_id)) {
//                            continue;
//                        } else {
//                            $insertArray['int_territory'] = $t_id[0]['t_id'];
//                        }
//
//                        $insertArray['int_salesline'] = $data[2];
//                        $insertArray['int_subline'] = $data[3];
//                        $insertArray['int_note'] = $data[4];
//                        $insertArray['int_team'] = $data[5];
//                        $insertArray['int_region'] = $data[6];
//                        $insertArray['int_share'] = $data[7];
//                        $int_id = $this->m_common->get_row_array('institute_territory', array('int_territory' => $insertArray['int_territory'], 'int_brick' => $insertArray['int_brick']), 'int_id');
//                        if (empty($int_id)) {
//                            $insertArray['int_created'] = date('Y-m-d');
//                            $this->m_common->insert_row('institute_territory', $insertArray);
//                        } else {
//                            $insertArray['int_modified'] = date('Y-m-d');
//                            $this->m_common->update_row('institute_territory', array('int_id' => $int_id[0]['int_id']), $insertArray);
//                        }
//                    }

                 //   $row++;
              //  }
                fclose($handle);
                redirect_with_msg('export_import/index', $row . ' Territory Uploaded successfully');
            }
        } else {
            redirect_with_msg('export_import/index', 'Please upload any csv file first');
        }
    }

    function exportInstitutionTerritory() {
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=instituteTerritoryList.csv");
        $fp = fopen('php://output', 'w');
        $i = 0;
        $data = $this->m_common->get_row_array('institute_territory', '', 'int_brick,int_territory,int_salesline,int_subline,int_note,int_team,int_region,int_share');
        $header = array("BRICK", "TERRITORY", "SALESLINE", "SUBLINE", "NOTES", "TEAM", "REGION", "SHARE");
        fputcsv($fp, $header);
        foreach ($data as $row) {
            fputcsv($fp, $row);
            $i++;
        }
        fclose($fp);
        exit;
    }

    function importTarget() {
        if (isset($_FILES['target_list']['tmp_name']) && !empty($_FILES['target_list']['tmp_name'])) {
            $row = 1;
            if (($handle = fopen($_FILES['target_list']['tmp_name'], "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                    if ($row > 1) {
                        $insertArray = array();
                        $t_id = $this->m_common->get_row_array('territory', array('t_territory' => $data[0]), 't_id');
                        if (empty($t_id)) {
                            continue;
                        } else {
                            $insertArray['t_id'] = $t_id[0]['t_id'];
                        }
                        $sl_id = $this->m_common->get_row_array('sales_line', array('sl_short_form' => $data[3]), 'sl_id');
                        if (empty($sl_id)) {
                            continue;
                        } else {
                            $insertArray['sl_id'] = $sl_id[0]['sl_id'];
                        }
                        $insertArray['tgt_proposed'] = str_replace(',', '', $data[4]);
                        $insertArray['tgt_base'] = str_replace(',', '', $data[5]);
                        $insertArray['tgt_target'] = str_replace('%', '', $data[6]);
                        $insertArray['tgt_year'] = $data[7];
                        $insertArray['tgt_cycle'] = $data[8];
                        $tgt_id = $this->m_common->get_row_array('target', array('tgt_year' => $insertArray['tgt_year'], 'tgt_cycle' => $insertArray['tgt_cycle'], 't_id' => $insertArray['t_id']), 'tgt_id');
                        if (empty($tgt_id)) {
                            $insertArray['created'] = date('Y-m-d');
                            $this->m_common->insert_row('target', $insertArray);
                        } else {
                            $insertArray['modified'] = date('Y-m-d');
                            $this->m_common->update_row('target', array('tgt_id' => $tgt_id[0]['tgt_id']), $insertArray);
                        }
                    }

                    $row++;
                }
                fclose($handle);
                redirect_with_msg('export_import/index', $row . ' Target Uploaded successfully');
            }
        } else {
            redirect_with_msg('export_import/index', 'Please upload any csv file first');
        }
    }

    function exportTarget() {
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=target.csv");
        $fp = fopen('php://output', 'w');
        $i = 0;
        $data = $this->m_common->get_row_array('v_target', '', 't_territory,sl_name,tgt_proposed,tgt_base,tgt_target,tgt_year,tgt_cycle');
        $header = array("TERRITORY", "SALESLINE", "PROPOSED VALUE", "BASE VALUE", "TARGET", "YEAR", "CYCLE");
        fputcsv($fp, $header);
        foreach ($data as $row) {
            fputcsv($fp, $row);
            $i++;
        }
        fclose($fp);
        exit;
    }
    
    
   
    
    function importOhersMoleculePre() {
        if (isset($_FILES['other_molecule_list']['tmp_name']) && !empty($_FILES['other_molecule_list']['tmp_name'])) {
            $row = 1;
             $j=0;
            if (($handle = fopen($_FILES['other_molecule_list']['tmp_name'], "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                     $j++;
                    if ($row > 1) {
                      
                        $insertArray = array();
                       
                        $sl_id = $this->m_common->get_row_array('sales_line', array('sl_short_form' => $data[0]), 'sl_id,sl_name');
                        if (empty($sl_id)) {
                            continue;
                        } else {
                            $insertArray['sl_id'] = $sl_id[0]['sl_id'];
                            $insertArray['sl_name'] =$sl_id[0]['sl_name'];
                            $insertArray['sl_short_name'] =$data[0];
                        }
                        
                        $c_id = $this->m_common->get_row_array('category', array('ct_name' => $data[1]), 'ct_id');
                        if (empty($c_id)) {
                            continue;
                        } else {
                            $insertArray['ct_id'] = $c_id[0]['ct_id'];
                            $insertArray['ct_name'] =$data[1];
                        }
                        
                         $b_id = $this->m_common->get_row_array('brand', array('b_name' => $data[2]), 'b_id');
                        if (empty($b_id)) {
                            continue;
                        } else {
                            $insertArray['b_id'] = $b_id[0]['b_id'];
                            $insertArray['b_name'] =$data[2];
                        }
                        
                        $insertArray['mol_name'] = $data[3];
                        $insertArray['status'] = $data[4];
                        
                        $insertArray['om_created'] = date('Y-m-d');
                        $this->m_common->insert_row('other_molecule', $insertArray);
                      
                    }

                    $row++;
                }
                fclose($handle);
                redirect_with_msg('export_import/index', $j-1 . ' Molecule Uploaded successfully');
            }
        } else {
            redirect_with_msg('export_import/index', 'Please upload any csv file first');
        }
    }
    
    function importOhersMolecule() {
        if (isset($_FILES['other_molecule_list']['tmp_name']) && !empty($_FILES['other_molecule_list']['tmp_name'])) {
            $row = 1;
             $j=0;
            if (($handle = fopen($_FILES['other_molecule_list']['tmp_name'], "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                     $j++;
                    if ($row > 1) {
                      
                        $insertArray = array();                    
                        $insertArray['mol_name'] =$data[0];    
                        $insertArray['om_created'] = date('Y-m-d');
                        $this->m_common->insert_row('other_molecule', $insertArray);
                      
                    }

                    $row++;
                }
                fclose($handle);
                redirect_with_msg('export_import/index', $j-1 . ' Molecule Uploaded successfully');
            }
        } else {
            redirect_with_msg('export_import/index', 'Please upload any csv file first');
        }
    }
    
    
    
    
   function exportOtherMolecule() {
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=other_molecule.csv");
        $fp = fopen('php://output', 'w');
        $i = 0;
        $data = $this->m_common->get_row_array('other_molecule', '', 'sl_name,ct_name,b_name,mol_name,status');
        $header = array("Sales Line", "Category", "Brand", "Molecule", "Status");
        fputcsv($fp, $header);
        foreach ($data as $row) {
            fputcsv($fp, $row);
            $i++;
        }
        fclose($fp);
        exit;
    }  
    
    
    
    function importMoleculeSubline(){
          if (isset($_FILES['molecule_subline']['tmp_name']) && !empty($_FILES['molecule_subline']['tmp_name'])) {
            $row = 1;
             $j=0;
            if (($handle = fopen($_FILES['molecule_subline']['tmp_name'], "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                     $j++;
                    if ($row > 1) {
                      
                        $insertArray = array();                    
                        $insertArray['ing'] =$data[0];
                        $insertArray['sales_line'] =$data[1];
                        $molecule_id=$this->m_common->get_row_array('molecule_list',array('mol_name'=>$data[0]),'*');
                        if(!empty($molecule_id)){
                          $insertArray['molecule_id'] =$molecule_id[0]['mol_id']; 
                        }
                        $insertArray['sub_line'] =$data[2];
                        $insertArray['created'] = date('Y-m-d');
                        $this->m_common->insert_row('molecule_subline', $insertArray);
                      
                    }

                    $row++;
                }
                fclose($handle);
                redirect_with_msg('dashboard/raw_data', $j-1 . ' Molecule Subline Uploaded successfully');
            }
        } else {
            redirect_with_msg('dashboard/raw_data', 'Please upload any csv file first');
        }
    }
    
    
     function importMajorInstitute(){
          if (isset($_FILES['major_institute']['tmp_name']) && !empty($_FILES['major_institute']['tmp_name'])) {
            $row = 1;
             $j=0;
            if (($handle = fopen($_FILES['major_institute']['tmp_name'], "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                     $j++;
                    if ($row > 1) {
                      
                        $insertArray = array();                    
                        $insertArray['inst_brick'] =$data[0];
                        $insertArray['inst_shop_name'] =$data[1];
                        $insertArray['inst_address'] =$data[2];
                        $insertArray['created'] = date('Y-m-d');
                        $this->m_common->insert_row('major_institute', $insertArray);
                      
                    }

                    $row++;
                }
                fclose($handle);
                redirect_with_msg('dashboard/raw_data', $j-1 . ' Major Institution Uploaded successfully');
            }
        } else {
            redirect_with_msg('dashboard/raw_data', 'Please upload any csv file first');
        }
    }
    

}




 


