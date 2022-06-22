<?php

function isValidIP($str) {
    
    // TODO: Please write your code here
    $strTok =explode('.' , $str);//배열 크기 가져오기 
    $cnt = count($strTok);
    $message = "Invalid because ";
    $err = 0;
    
    for($i = 0 ; $i < $cnt ; $i++){
        $tmp = $strTok[$i];
        
        switch ($i) {
            case 0:
                $message .= "x1 ";
                break;
            case 1:
                $message .= "x2 ";
                break;
            case 2:
                $message .= "x3 ";
                break;
            case 3:
                $message .= "x4 ";
                break;
            default:
                ;
                break;
        }
        
        if($i==0){
            if( $tmp < 1 && $tmp > 255){
                $err = 1;
                $message .= "is $tmp";
            }
        }else{
            
            if( $tmp < 0 && $tmp > 255){
                $err = 1;
                $message .= "is $tmp";
            }
        }
        
        
        if(! is_numeric($tmp)){
            $err = 1;
            $message .= "has a non-numerical character.";
        }
        
        
        
        if( ctype_space($tmp)){
            $err = 1;
            $message .= "has a white space.";
        }
        
        
        if(substr($tmp,0,1) == '0'){
            $err = 1;
            $message .= "an unnecessary octal expression.";
        }
    }
    
    
    if($err == 1)
        return $message;
    else
        return "Valid IPv4 addresses.";
        
    
    //return(true);
    
}


isValidIP("1.2.3.4");
?>