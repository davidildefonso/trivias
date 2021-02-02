<?php
// Initialize session data
session_start();



include("connectDB.php");
$con=connectToDB("localhost","user","pass","trivias"); //change user and pass to your database user and password



  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    if (empty($_POST["nickname"])) {
      $nameErr = "Name is required";
    } else {
      $user = test_input($_POST["nickname"]); 
      $_SESSION["name"] = $user;        
     
    }
    
    if (empty($_POST["password"])) {
      $passErr = "Password is required";
    } else {
      $pass = test_input($_POST["password"]);
    
    }
      
    $uid=getSingle($con,"select uid from users where name= '$user'");
    
    if(!$uid){
      query($con,"insert into users(name,password) values('$user','$pass') ");
    }
   
    if (empty($_POST["categories"])) {
      $categoryErr = "Category is required";
    } else {
      $category = test_input($_POST["categories"]);
      $_SESSION["cat"] = $category;  
      $uid=getSingle($con,"select uid from users where name= '$user'");
      $_SESSION["uid"] = $uid;  
      $date=Date("Y-m-d H:i:s");
      query($con,"insert into trivias(userID,cat,startTime) values('$uid','$category','$date')");
      $gameID=getSingle($con,"select id from trivias where userID= '$uid' 
      order by startTime desc");
    $_SESSION["gameID"] = $gameID;  


    }

    

    header("Location: play.php");

  } 



mysqli_close($con);

?>
