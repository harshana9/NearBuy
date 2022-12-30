<?php

//return encypted messages
function resolveURLmsg($EncryptedMSG){
	$msg=unserialize(base64_decode($EncryptedMSG));
    return $msg;
}

function showAlert($msg){
	if($msg){
    	echo "<script type=\"text/javascript\">";
        echo "alert('".$msg."');";
        echo "</script>";
    }
}

//This generate the url with encrypted data
//Set multiparam true means you have some parameters for GET in the given url
function encyptMsgURL($myurl,$data,$datakey="msg",$multiParam=false){
    $data=base64_encode(serialize($data));
    if($multiParam)
    {
        $myurl=$myurl."&".$datakey."=".$data;
    }
    else{
        $myurl=$myurl."?".$datakey."=".$data;
    }
    return $myurl;
}

?>