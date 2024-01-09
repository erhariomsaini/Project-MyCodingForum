<?php
session_start();
require('_dbconnect.php');
if($_SERVER['REQUEST_METHOD']== "POST"){
    $useremail = $_POST['useremail'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    $useremail = str_replace("<","&lt;",$useremail);
    $useremail = str_replace(">","&gt;",$useremail);
    $useremail = str_replace("'","&#39;",$useremail);
    $useremail = str_replace('"','&#34;',$useremail);
    $useremail = str_replace(';',"&#59;",$useremail);

    // $pass = str_replace("<","&lt;",$pass);
    // $pass = str_replace(">","&gt;",$pass);
    // $pass = str_replace("'","&#39;",$pass);
    // $pass = str_replace('"','&#34;',$pass);
    // $pass = str_replace(';',"&#59;",$pass);

    // $cpass = str_replace("<","&lt;",$cpass);
    // $cpass = str_replace(">","&gt;",$cpass);
    // $cpass = str_replace("'","&#39;",$cpass);
    // $cpass = str_replace('"','&#34;',$cpass);
    // $cpass = str_replace(';',"&#59;",$cpass);
    

    
    $_SESSION['userexists']=false;
    $_SESSION['signup']=false;
    $_SESSION['passnotmatch']=false;
    $exists="SELECT * FROM `users` WHERE `useremail` LIKE '$useremail'";
    $result= mysqli_query($conn,$exists);
    $row = mysqli_num_rows($result);
    if($row>0){
        $_SESSION['userexists']=true;
        // echo "userexists";
        // var_dump($_SESSION['userexists']);exit;
        // echo "User Exists";
        header("location:\index.php?userexists=true");
    }
    else{
        if($pass==$cpass){

            $pass = str_replace("<","&lt;",$pass);
            $pass = str_replace(">","&gt;",$pass);
            $pass = str_replace("'","&#39;",$pass);
            $pass = str_replace('"','&#34;',$pass);
            $pass = str_replace(';',"&#59;",$pass);

            $passhash=password_hash($pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`useremail`, `password`, `timestamp`) VALUES ('$useremail', '$passhash', current_timestamp());";
            if($result = mysqli_query($conn,$sql)){
                    $_SESSION['signup']=true;
                    // echo "signup success";
                    //  var_dump($_SESSION['signup']);exit;
                    header("location:\index.php?signup=success");
                    // echo "Signup Success";
                }
            }
        else{
            $_SESSION['passnotmatch']=true;
            // echo "passnotmatch";
            //  var_dump($_SESSION['passnotmatch']);exit;
            header("location:\index.php?wrongpass=true");
            // echo "Password do not match";
        }
    }
}
?>