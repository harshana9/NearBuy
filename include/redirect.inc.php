<?php
   function redirect($myurl, $statusCode = 303)
   {
      header('Location: ' . $myurl, true, $statusCode);
      die();
      //echo $myurl;
   }
?>