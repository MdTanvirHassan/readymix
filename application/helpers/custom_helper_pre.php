<?php

/*
 * Gather here functions which are need usullay 
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('print_pre')) {

    function print_pre($var = '') {

        echo '<pre>';
        if (is_array($var)) {
            print_r($var);
        } else {
            var_dump($var);
        }
        echo '</pre>';
    }

}







function checkUserPermission($menuName, $subMenu = false, $userData) {
    $userRole = unserialize($userData[0]['userRole']);
    $usermenu = unserialize($userData[0]['userMenu']);
    if (in_array($menuName, $usermenu)) {
        if (isset($userRole[$menuName])) {
            if (array_key_exists($subMenu, $userRole[$menuName])) {
                return $userRole[$menuName][$subMenu];
            } else {
                return false;
            }
        } else {
            return $menuName;
        }
    } else {
        return false;
    }
}

function fetch_approver($menuName, $subMenu = false, $userData) {
  if(count($userData)>1){  
        $userRole = unserialize($userData[1]['userRole']);
        $firstApp = $userRole[$menuName][$subMenu][7];
        $secondApp = $userRole[$menuName][$subMenu][8];
        $thirdApp = $userRole[$menuName][$subMenu][9];
        $fourthApp = $userRole[$menuName][$subMenu][10];
        if(empty($firstApp))
            $firstApp = $userData[0]['approver1'];
        if(empty($secondApp))
            $secondApp = $userData[0]['approver2'];
        if(empty($thirdApp))
            $thirdApp = $userData[0]['approver3'];
        if(empty($fourthApp))
            $fourthApp = $userData[0]['approver4'];
  }else{
      $userRole = unserialize($userData[0]['userRole']);
        $firstApp = $userRole[$menuName][$subMenu][7];
        $secondApp = $userRole[$menuName][$subMenu][8];
        $thirdApp = $userRole[$menuName][$subMenu][9];
        $fourthApp = $userRole[$menuName][$subMenu][10];
        if(empty($firstApp))
            $firstApp = $userData[0]['approver1'];
        if(empty($secondApp))
            $secondApp = $userData[0]['approver2'];
        if(empty($thirdApp))
            $thirdApp = $userData[0]['approver3'];
        if(empty($fourthApp))
            $fourthApp = $userData[0]['approver4'];
  }
  return array($firstApp,$secondApp,$thirdApp,$fourthApp);
}





function checkMenuPermission($menuName,$userData) {
    $userRole = unserialize($userData[0]['userRole']);
    $usermenu = unserialize($userData[0]['userMenu']);
    if (in_array($menuName, $usermenu)) {
            return $menuName;  
    } else {
        return false;
    }
}





function redirect_with_msgs($url, $msg) {
    $CI = & get_instance();
    if ($url == "..")
        $url = $_SERVER['HTTP_REFERER'];
    elseif ($url == ".")
        $url = current_url();
    $CI->session->set_flashdata("FLASH_MESSAGE", $msg);
    redirect($url);
    exit("Execution should not continue below this line");
}

Function uploadImage($fileName, $filePath) {
    $imgUpload = new Img_upload(array('path' => $filePath));
    if (is_dir($filePath)) {
        if (is_uploaded_file($_FILES[$fileName]['tmp_name'])) {
            $imgUpload->do_upload($fileName);
            $errors = $imgUpload->display_errors();
            if (!empty($errors)) {
                return false;
            } else {
                $image_info = $imgUpload->data();
                $imgUpload->resize_img($fileName, '700', '550');
                $imageName = $image_info ['file_name'];
                return $imageName;
            }
        }
    } else {
        return false;
    }
}

 function generateFileName() {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < 12; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

/*
  -------> This function for change date format for save into database as (year-month-date),
  @ First parameter is date format ,which format will give this function for date to save into database
  @ Second parameter is actual date , which have been given
 */

function change_dateFormat($formate, $date = '') {
    if ($date != false) {
        $result = substr($formate, 0, 2);
        if ($result == "dd") {
            $dateInput = explode('-', $date);
            $Date = $dateInput[2] . '-' . $dateInput[1] . '-' . $dateInput[0];
        } elseif ($result == "yy") {
            $dateInput = explode('-', $date);
            $Date = $dateInput[2] . '-' . $dateInput[1] . '-' . $dateInput[0];
        } elseif ($result == 'mm') {
            $dateInput = explode('-', $date);
            $Date = $dateInput[2] . '-' . $dateInput[1] . '-' . $dateInput[0];
        }

        return $Date;
    } else {
        return 0;
    }
}

/*
  -------> This function for change date format for show  user as  (date-month-year) format,
  @ $date is the actual date taken from database . but this will be changed by this function for show user
 */

function change_dateFormat_forShow($date) {
    $date = new DateTime($date);
    return $date->format('d-m-Y');
}

/*
  ------>This function for change number format to word format
  @ $number is actual number which taken from database for show user but this will changed as a word format.
 */

function convert_number_to_words($number) {

    $number = explode(".", (string) $number);

    $integer = $number[0];
    if (isset($number[1]) && !empty($number[1])) {
        $fraction = $number[1];
    } else {
        $fraction = '00';
    }

    $output = "";

    if ($integer{0} == "-") {
        $output = "negative ";
        $integer = ltrim($integer, "-");
    } else if ($integer{0} == "+") {
        $output = "positive ";
        $integer = ltrim($integer, "+");
    }

    if ($integer{0} == "0") {
        $output .= "zero";
    } else {
        $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
        $group = rtrim(chunk_split($integer, 3, " "), " ");
        $groups = explode(" ", $group);

        $groups2 = array();
        foreach ($groups as $g) {
            $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});
        }

        for ($z = 0; $z < count($groups2); $z++) {
            if ($groups2[$z] != "") {
                $output .= $groups2[$z] . convertGroup(11 - $z) . (
                        $z < 11 && !array_search('', array_slice($groups2, $z + 1, -1)) && $groups2[11] != '' && $groups[11]{0} == '0' ? " and " : ", "
                        );
            }
        }

        $output = rtrim($output, ", ");
    }

    if ($fraction > 0) {
        $output .= " point";
        for ($i = 0; $i < strlen($fraction); $i++) {
            $output .= " " . convertDigit($fraction{$i});
        }
    }

    return $output;
}

function convertGroup($index) {
    switch ($index) {
        case 11:
            return " decillion";
        case 10:
            return " nonillion";
        case 9:
            return " octillion";
        case 8:
            return " septillion";
        case 7:
            return " sextillion";
        case 6:
            return " quintrillion";
        case 5:
            return " quadrillion";
        case 4:
            return " trillion";
        case 3:
            return " billion";
        case 2:
            return " million";
        case 1:
            return " thousand";
        case 0:
            return "";
    }
}

function convertThreeDigit($digit1, $digit2, $digit3) {
    $buffer = "";

    if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0") {
        return "";
    }

    if ($digit1 != "0") {
        $buffer .= convertDigit($digit1) . " hundred";
        if ($digit2 != "0" || $digit3 != "0") {
            $buffer .= " and ";
        }
    }

    if ($digit2 != "0") {
        $buffer .= convertTwoDigit($digit2, $digit3);
    } else if ($digit3 != "0") {
        $buffer .= convertDigit($digit3);
    }

    return $buffer;
}

function convertTwoDigit($digit1, $digit2) {
    if ($digit2 == "0") {
        switch ($digit1) {
            case "1":
                return "ten";
            case "2":
                return "twenty";
            case "3":
                return "thirty";
            case "4":
                return "forty";
            case "5":
                return "fifty";
            case "6":
                return "sixty";
            case "7":
                return "seventy";
            case "8":
                return "eighty";
            case "9":
                return "ninety";
        }
    } else if ($digit1 == "1") {
        switch ($digit2) {
            case "1":
                return "eleven";
            case "2":
                return "twelve";
            case "3":
                return "thirteen";
            case "4":
                return "fourteen";
            case "5":
                return "fifteen";
            case "6":
                return "sixteen";
            case "7":
                return "seventeen";
            case "8":
                return "eighteen";
            case "9":
                return "nineteen";
        }
    } else {
        $temp = convertDigit($digit2);
        switch ($digit1) {
            case "2":
                return "twenty-$temp";
            case "3":
                return "thirty-$temp";
            case "4":
                return "forty-$temp";
            case "5":
                return "fifty-$temp";
            case "6":
                return "sixty-$temp";
            case "7":
                return "seventy-$temp";
            case "8":
                return "eighty-$temp";
            case "9":
                return "ninety-$temp";
        }
    }
}

function convertDigit($digit) {
    switch ($digit) {
        case "0":
            return "zero";
        case "1":
            return "one";
        case "2":
            return "two";
        case "3":
            return "three";
        case "4":
            return "four";
        case "5":
            return "five";
        case "6":
            return "six";
        case "7":
            return "seven";
        case "8":
            return "eight";
        case "9":
            return "nine";
    }
}

/* ---------------------------------------------- Convert number format function  end ---------------------------------------------------------  */



function clean($string) {
    $string = str_replace(' ', '_', $string);

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}

function summary($str, $limit = 100, $strip = false) {
    $str = ($strip == true) ? strip_tags($str) : $str;
    if (strlen($str) > $limit) {
        $str = substr($str, 0, $limit - 3);
        return (substr($str, 0, strrpos($str, ' ')) . ' [...]');
    }
    return trim($str);
}

//function showData($dir) {
//    foreach ($dir as $folder => $data) {
//        if (is_integer($folder)) {
//                $path = 'images/gallery';
//            echo '<img src="'.$path.'/'.$data.'"/>';
//        }else{
//            echo '<img src="images/folder_up.png" style="height:80px;width:80px;margin-right:20px;"/><img src="images/folder.png" style="height:80px;width:80px;margin-right:20px;"/>'.$folder.'';
//            showData('images/');
//        }
//    }
//}

function dirToArray($images) {

    $result = array();
    $dir = 'images/gallery';
    $cdir = array_reverse(scandir($dir));
    foreach ($cdir as $key => $value) {
        if (!in_array($value, array(".", ".."))) {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                $aa = urlencode($dir . '/' . $value);
                $ss = dirToimg($dir . '/' . $value);
                if (empty($ss))
                    $img = 'images/dummy.jpg';
                else
                    $img = $ss;
                echo '<div class="col-md-3" style="margin-bottom:20px"><a href="' . site_url() . 'front_gallery/forwardDir?d=' . $aa . '&prev=' . urlencode($dir) . '"><img src="' . site_url() . $img . '" class="img-responsive" style="height:200px;width:275px; border:2px solid;padding:3px;"/><br><p style="text-align:center;">' . $value . '</p></a></div>';
                //  dirToArray($dir . DIRECTORY_SEPARATOR . $value);
            } else {
                echo '<div class="col-md-3" style="margin-bottom:20px"><a href="' . site_url() . $dir . '/' . $value . '" class="colorbox cboxElement" rel="colorbox" >   <img style="height:200px;width:275px;  border:2px solid;padding:3px;" class="img-responsive" src="' . site_url() . $dir . '/' . $value . '" alt="test" /></a>
                                                    </div>';
            }
        }
    }
}

function nextdirToArray($dir, $prev) {

    $result = array();
    //  $dir = 'images/gallery';
    $cdir = array_reverse(scandir($dir));
    if (count($cdir) == 3) {
        $prev = 'images/gallery';
    }
    foreach ($cdir as $key => $value) {
        if (!in_array($value, array(".", ".."))) {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                $aa = urlencode($dir . '/' . $value);

                $ss = dirToimg($dir . '/' . $value);
                if (empty($ss))
                    $img = 'images/dummy.jpg';
                else
                    $img = $ss;

                if ($key == 0) {
                    echo '<div class="col-md-3" style="margin-bottom:20px"><a href="' . site_url() . 'front_gallery/forwardDir?d=' . $aa . '&prev=' . urlencode($prev) . '"><img src="' . site_url() . $img . '" class="img-responsive" style="height:200px;width:275px; border:2px solid;padding:3px;"/><br><p style="text-align:center;">' . $value . '</p></a></div>';
                } else {
                    echo '<div class="col-md-3" style="margin-bottom:20px"><a href="' . site_url() . 'front_gallery/forwardDir?d=' . $aa . '&prev=' . urlencode($prev) . '"><img src="' . site_url() . $img . '" class="img-responsive" style="height:200px;width:275px; border:2px solid;padding:3px;"/><br><p style="text-align:center;">' . $value . '</p></a></div>';
                }
            } else {
                if ($key == 0) {
                    echo '<div class="col-md-3" style="margin-bottom:20px"><a href="' . site_url() . $dir . '/' . $value . '" class="colorbox cboxElement" rel="colorbox" >   <img style="height:200px;width:275px; border:2px solid;padding:3px;" class="img-responsive" src="' . site_url() . $dir . '/' . $value . '" alt="test" /></a>
                                                    </div>';
                } else {
                    echo '<div class="col-md-3" style="margin-bottom:20px"><a href="' . site_url() . $dir . '/' . $value . '" class="colorbox cboxElement" rel="colorbox" >   <img style="height:200px;width:275px; border:2px solid;padding:3px;" class="img-responsive" src="' . site_url() . $dir . '/' . $value . '" alt="test" /></a>
                                                    </div>';
                }
            }
        }
    }
    if (count($cdir) == 2) {
        echo '<div class="col-md-12" style="margin-bottom:20px;text-align:center;">No Image Found</div>';
    }
}

function dirToimg($dir) {

    $result = '';

    $cdir = scandir($dir);
    foreach ($cdir as $key => $value) {
        if (!in_array($value, array(".", ".."))) {
            if (!empty($result))
                return $result;
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                $result = dirToimg($dir . DIRECTORY_SEPARATOR . $value);
            } else {
                $result = str_replace(DIRECTORY_SEPARATOR, '/', $dir) . '/' . $value;
            }
        }
    }

    return $result;
}

function numberToWord($num) {
    switch ($num) {
        case 1: return 'A';
        case 2: return 'B';
        case 3: return 'C';
        case 4: return 'D';
        case 5: return 'E';
        case 6: return 'F';
        case 7: return 'G';
        case 8: return 'H';
        case 9: return 'I';
        case 10: return 'J';
        case 11: return 'K';
        case 12: return 'L';
        case 13: return 'M';
        case 14: return 'N';
        case 15: return 'O';
        case 16: return 'P';
        case 17: return 'Q';
        case 18: return 'R';
        case 19: return 'S';
        case 20: return 'T';
        case 21: return 'U';
        case 22: return 'V';
        case 23: return 'W';
        case 24: return 'X';
        case 25: return 'Y';
        case 26: return 'Z';
        case 27: return 'AA';
        case 28: return 'AB';
        case 29: return 'AC';
        case 30: return 'AD';
        case 31: return 'AE';
        case 32: return 'AF';
        case 33: return 'AG';
        case 34: return 'AH';
        case 35: return 'AI';
        case 36: return 'AJ';
        case 37: return 'AK';
        case 38: return 'AL';
        case 39: return 'AM';
        case 40: return 'AN';
        case 41: return 'AO';
        case 42: return 'AP';
        case 43: return 'AQ';
        case 44: return 'AR';
        case 45: return 'AS';
        case 46: return 'AT';
        case 47: return 'AU';
        case 48: return 'AV';
        case 49: return 'AW';
        case 50: return 'AX';
    }
    
    
}



function convert_number($number) 
{ 
    $my_number = $number;

    if (($number < 0) || ($number > 999999999)) 
    { 
    throw new Exception("Number is out of range");
    } 
    $Kt = floor($number / 10000000); /* Koti */
    $number -= $Kt * 10000000;
    $Gn = floor($number / 100000);  /* lakh  */ 
    $number -= $Gn * 100000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 

    if ($Kt) 
    { 
        $res .= convert_number($Kt) . " Koti "; 
    } 
    if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Lakh"; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
           // $res .= " and "; 
            $res .= " "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 


} 
