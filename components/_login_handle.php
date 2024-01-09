<?php
session_start();
require('_dbconnect.php');
$_SESSION['loggedin']=false;
$_SESSION['wrongpassword']=false;
$_SESSION['usernotexists']=false;

if($_SERVER['REQUEST_METHOD']== "POST"){
    $useremailcheck= $_POST['useremailcheck'];
    $passcheck= $_POST['passcheck'];
    
    $useremailcheck = str_replace("<","&lt;",$useremailcheck);
    $useremailcheck = str_replace(">","&gt;",$useremailcheck);
    $useremailcheck = str_replace("'","&#39;",$useremailcheck);
    $useremailcheck = str_replace('"',"&#34;",$useremailcheck);
    $useremailcheck = str_replace(';',"&#59;",$useremailcheck);

    $passcheck = str_replace("<","&lt;",$passcheck);
    $passcheck = str_replace(">","&gt;",$passcheck);
    $passcheck = str_replace("'","&#39;",$passcheck);
    $passcheck = str_replace('"',"&#34;",$passcheck);
    $passcheck = str_replace(';',"&#59;",$passcheck);
    
    $sql="SELECT * FROM `users` WHERE `useremail` LIKE '$useremailcheck'";
    $result= mysqli_query($conn,$sql);
    $row = mysqli_num_rows($result);
    if($row==1){
        $data= mysqli_fetch_assoc($result);
        if(password_verify($passcheck,$data['password'])){ 
            $_SESSION['loggedin']=true;
            $_SESSION['useremail']=$useremailcheck;
            $_SESSION['pass']=$passcheck;
            $_SESSION['user_id']=$data['user_id'];
            if(isset($_SESSION['catid'])){
                $catid_login = $_SESSION['catid'];
                header("location:\\threadlist.php?catid=$catid_login");
            }
            else{
                header("location:\index.php");
            }
            if(isset($_SESSION['threadid'])){
                $threadid_login = $_SESSION['threadid'];
                header("location:\\thread.php?threadid=$threadid_login");
            }
            
            // echo "Login Success";
        }
        else{
            $_SESSION['wrongpassword']=true;
            header("location:\index.php");
            // echo "Password Wrong";
            }
    }
    else{
        $_SESSION['usernotexists']=true;
        header("location:\index.php");
        // echo "User does not Exists";
    }
}
?>