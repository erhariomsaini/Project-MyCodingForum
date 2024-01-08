<style>
    .d-flex {
    flex-direction: row;
    justify-content: flex-end;
}
</style>
<?php
session_start();
// require('_signup_handle.php');
require('_signupmodal.php');
require('_loginmodal.php');
require('_logoutmodal.php');
echo '<nav class="navbar navbar-expand-lg bg-body-tertiary py-0 bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">My Coding Forum</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">Top Categories </a>
                    <ul class="dropdown-menu">';
                        $sql4 = "SELECT * FROM `categories` LIMIT 5";
                        $result4 = mysqli_query($conn,$sql4);
                        while($row4 = mysqli_fetch_assoc($result4)){
                        echo '<li>
                            <a class="dropdown-item" href="threadlist.php?catid='.$row4["category_id"].'">'.$row4["category_name"].'</a>
                        </li>';
                        }
                        echo '<li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="index.php">Browse more Categories</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
            <div class="col py-2 d-grid mx-5" >
                <div class="d-flex">
                <form  class="d-flex" role="search" action="search.php">
                    <input for="search" class="form-control mx-2" type="search" placeholder="Search" aria-label="Search" name="query">
                    <button class="btn btn-success ms-2" type="submit" id="search">Search</button>
                    <h3 class="mx-2 mt-1"><span class="badge bg-success ">';if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){echo "Welcome ".$_SESSION['useremail'];} echo '</span></h3>
                </form>';
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
                    echo'
                        <button class="btn btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#logoutModal">Logout</button>
                        ';
                }
                else{
                    echo '
                    <div >
                                <button class="btn btn-outline-success me-2" data-bs-toggle="modal"
                                data-bs-target="#loginModal">Login</button>
                                <button class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#signupModal">Signup</button>
                    </div>';
                }
           echo '</div>
            </div>
        </div>
    </div>
</nav>';
// var_dump(isset($_SESSION['userexists']));
if(isset($_SESSION['userexists']) && $_SESSION['userexists']==true){
    // echo "user exists";exit;
    echo '<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
            <strong>Useremail already exists! </strong> You can login using same useremail or Signup using other useremail...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    $_SESSION['userexists']=false;
}
if(isset($_SESSION['signup']) && $_SESSION['signup']==true){
    // echo "signup success";exit;
    echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
            <strong>Sign Up Successful! </strong> Now you can login...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    $_SESSION['signup']=false;
}
if(isset($_SESSION['passnotmatch']) && $_SESSION['passnotmatch']==true){
    //  echo "password not match";exit;
    echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
            <strong>Password do not match! </strong>Please enter same password and confirm password...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    $_SESSION['passnotmatch']=false;
}
if(isset($_SESSION['usernotexists']) && $_SESSION['usernotexists']==true){
    echo '<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
            <strong>Useremail does not exists! </strong> You first Signup then login ...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    $_SESSION['usernotexists']=false;
}
if(isset($_SESSION['wrongpassword']) && $_SESSION['wrongpassword']==true){
    echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
            <strong>Wrong Password! </strong>Please enter correct password...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    $_SESSION['wrongpassword']=false;
}
?>