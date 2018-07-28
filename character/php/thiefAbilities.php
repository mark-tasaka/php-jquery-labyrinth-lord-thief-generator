<?php


function thiefAbility ($level)
{
    $message = "";
    
    if($level === "01" || $level === "02" || $level === "03")
    {
        $message = "";
    }
    else if($level === "04" || $level === "05" || $level === "06" || $level === "07" || $level === "08")
    {
        $message = "80% probability of reading languages (any non-magical writings).";
    }
    else if($level == "09")
    {
        $message = "80% probability of reading languages (any non-magical writings).<br/>
                    Can establish a thief's den, with 2d6 1st level thief apprentices.";
    }
    else
    {
        $message = "80% probability of reading languages (any non-magical writings).<br/>
                    Can establish a thief's den, with 2d6 1st level thief apprentices.<br/>
                    Can read and cast magic from magic-user/elf scrolls with 90% accuracy.";
    }
    
    return $message;
    
}



?>