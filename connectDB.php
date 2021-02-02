<?php

function connectToDB($host,$username,$pass,$database){
  $dbhost=$host;

  $user=$username;
  $password=$pass;
  $db=$database;
  $con=mysqli_connect($dbhost,$user,$password,$db);
  
  if(mysqli_connect_errno()){
    
   echo "Failed to connect to Mysql: " .mysqli_connect_error();
    //exit();
    return false;
  }
  
  //echo "conexion exitosa";
  return $con;
}


function query($con,$query){
  $result=mysqli_query($con,$query);
  return $result;
}

function getSingle($con,$query){
  $result=query($con,$query);
  $row= mysqli_fetch_row($result);
  return $row[0];
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>