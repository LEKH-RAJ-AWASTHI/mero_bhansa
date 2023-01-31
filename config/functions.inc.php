<?php
    function pr($arr){
        echo '<pre>';
        print_r($arr);
    }
    function prx($arr){
        echo '<pre>';
        print_r($arr);
        die();

    }

    function get_safe_value($con,$str){
        if(($str!='')){

            $str2=trim($str,'');
            $str2=filter_var($str2, FILTER_SANITIZE_STRING);
            return mysqli_real_escape_string($con,$str2);
        }


    }
?>