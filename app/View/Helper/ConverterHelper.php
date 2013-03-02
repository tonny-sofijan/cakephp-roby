<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConverterHelper
 *
 * @author Joko Hermanto
 */
class ConverterHelper extends AppHelper {

    function yesNo($yesNo) {

        $yesArray = array('Y', '1');
        if (in_array(strtoupper(trim($yesNo)), $yesArray) != null) {
            return __('Ya');
        } else {
            return __('Tidak');
        }
    }

    function formatDate($date, $pattern = 'd M Y') {
        if ($date == null)
            return null;

        $newDate = new DateTime($date);
        return $newDate->format($pattern);
    }

    function formatNumber($number) {
        return number_format($number, 2, '.', ',');
    }

    function activeStatus($status) {
        if (!empty($status) && $status === 'A') {
            return __('Aktif');
        }

        return __('Tidak Aktif');
    }
    
    public function overUnder($val) {
        $result = '';
        switch ($val) {
            case '0':
                $result = 'Under';
                break;
            case '1':
                $result = 'Over';
                break;
        }
        
        return $result;
    }
    
    public function salutation($val) {
        $result = '';
        switch ($val) {
            case '0':
                $result = 'Saudara';
                break;
            case '1':
                $result = 'Bapak';
                break;
            case '2':
                $result = 'Ibu';
                break;
        }
        
        return $result;
    }
    
    public function gender($val) {
        $result = '';
        switch ($val) {
            case 'M':
                $result = 'Pria';
                break;
            case 'F':
                $result = 'Wanita';
                break;
        }
        
        return $result;
    }

}

?>
