
<?php

session_start();


include("connectDB.php");
$con=connectToDB("localhost","root","","trivias");
/*
echo $_SESSION["name"];
echo $_SESSION["uid"];
echo $_SESSION["cat"];


echo $_SESSION["gameID"];*/


$score= $_GET["score"];
$time= $_GET["time"];
$game=$_SESSION["gameID"];

//echo $score;
//echo $time;


query($con,"update trivias set score = $score, time=$time where id=$game");

$result=query($con,"select name,score,time  from trivias
           join users on trivias.userID=users.uid 
            order by score desc 
            limit 5");

$rankings=array();


while($row= mysqli_fetch_assoc($result)){
  $rankings[]=$row;
}

echo json_encode($rankings);


?>
