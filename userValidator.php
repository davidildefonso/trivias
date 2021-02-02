
<?php

include("connectDB.php") ;
$con=connectToDB("localhost","user","pass","trivias"); //change user and pass to your database user and password

$username= $_GET["username"];
$pass=$_GET["password"];




 
if(getSingle($con,"select * from users where name='$username' ")){    
  $isnew=false;
}else{
  $isnew=true;
}



if($isnew){
  echo "newPass"; 
}else{
  $savedPass=getSingle($con,"select password from users
    where name='$username'");
  if($savedPass==$pass){
    echo "passwordOK";
  }else{
    echo "passwordIncorrect";
  }
}



?>
