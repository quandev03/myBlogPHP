<?php 
function validate_username($str) 
{
    $allowed = array(".", "-", "_"); // you can add here more value, you want to allow.
    if(ctype_alnum(str_replace($allowed, '', $str ))) {
        return True;
    } else {
        $str = "Invalid Username";
        return False;
    }
}

function validate_password($str) {
   $uppercase = preg_match('@[A-Z]@', $str);
   $lowercase = preg_match('@[a-z]@', $str);
   $number    = preg_match('@[0-9]@', $str);
   $specialChars = preg_match('@[^\w]@', $str);

   if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($str) < 8) {
      $str = "Invalid Password";
      return False;
   } else {
      return True;
   }

}
function validate_email($email)
{
   return filter_var($email, FILTER_VALIDATE_EMAIL);
}

?>