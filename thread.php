<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Coding Forum - Coding Discussion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    #footerbottom {
        min-height: 450px;
    }
    </style>
</head>

<body>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    
    <?php
    require('components/_dbconnect.php');
    require('components/_header.php');
     
    ?>

    
    <?php 
    $catid = $_GET['threadid'];
    $sql ="SELECT * FROM `thread` WHERE `thread_id`= $catid";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname=$row['thread_title'];
        $catdesc=$row['thread_desc'];
        }
    ?>
    
    
    <?php 
    $method= $_SERVER['REQUEST_METHOD'];
    $threadid= $_GET['threadid'];
    $_SESSION['threadid']=$threadid;
    
    if($method=='POST'){
        $user_id = $_SESSION['user_id'];
        $th_ans_desc = $_POST['ans_desc'];
        $th_ans_desc = str_replace("<","&lt;",$th_ans_desc);
        $th_ans_desc = str_replace(">","&gt;",$th_ans_desc);
        if($th_ans_desc!=NULL){
        $sql ="INSERT INTO `threadans` (`threadans_desc`, `thread_id`, `threadans_user_id`, `threadans_time`) VALUES ('$th_ans_desc', '$threadid', '$user_id', current_timestamp())";
        $result = mysqli_query($conn,$sql);
        if($result==1){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Great! </strong> Your comment has been added...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            $result=0;
            }
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error! </strong> Comment can\'t be blank...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        $th_ans_desc=NULL;
    }
    
    ?>
    

    <?php
    echo '<div class="container my-4">
    <fieldset>
        <legend>
            <h3 class="display-6"><strong>'.$catname.'</strong></h3>
        </legend>
        <h6>'.$catdesc.'</h6>

        <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do
            not
            post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross
            post
            questions. Remain respectful of other members at all times.</p>';
    $threadid1 = $_GET['threadid'];
    $sql1 ="SELECT * FROM `thread` WHERE `thread_id`= $threadid1";
    $result1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $threadans_user_id=$row1['thread_user_id'];

    $sql2 ="SELECT * FROM `users` WHERE `user_id` = $threadans_user_id";
    $result2 = mysqli_query($conn,$sql2);
    while($row2 = mysqli_fetch_assoc($result2)){
    $thread_user_id = $row2['useremail'];
    echo '<p>Posted by <strong>'.$thread_user_id.'</strong></p>';
    }
    echo '<hr class="my-0">
    </fieldset>
    </div>';
    ?>
    
    
            
            

    <?php 
    if(isset($_SESSION['loggedin'])==true && $_SESSION['loggedin']==true){
    echo '<div class="container">
        <fieldset>
            <legend>
                <h1 class="my-0">Add Comment</h1>
            </legend>
            <form action="thread.php?threadid='.$catid.'" method="post">
                <div>
                    <label for="ans_desc" class="col-form-label ms-2">
                        <h5>Comment Discription</h5>
                    </label>
                    <div>
                        <textarea type="text" class="form-control" id="ans_desc" name="ans_desc" rows="4" placeholder="Type your comment here..."></textarea>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success my-2">Post a Comment</button>
                </div>
            </form>
        </fieldset>
        <hr class="mt-4 mb-2">
    </div>';
    }
    else{
        echo '<div class="container">
        <div class="alert alert-success" role="alert">
        <h1>Login to add comments...</h1>
        </div>
        </div>';
    }
    ?>


    <div class="container" id="footerbottom">
        <h1 class="my-2">Browse Comments</h1>
        <?php
        $noentry=true;
        $threadid = $_GET['threadid'];
        $sql ="SELECT * FROM `threadans` WHERE `thread_id`= $threadid";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $threadans_desc = $row['threadans_desc'];
            $threadans_user_id = $row['threadans_user_id'];
            $threadans_time = $row['threadans_time'];
            $sql3 ="SELECT * FROM `users` WHERE `user_id` = $threadans_user_id";
            $result3 = mysqli_query($conn,$sql3);
            $row3 = mysqli_fetch_assoc($result3);
            $comment_user_id = $row3['useremail'];
            $noentry=false;
            echo '<table>
                <tr>
                    <td><img src="images/user.jpg" height="50px" alt="User"></td>
                    <td class="px-3">
                        <h4>'.$threadans_desc.'</h4>
                        <h6>Posted By <strong>'.$comment_user_id.'</strong> at <strong>'.$threadans_time.'</strong></h6>
                    </td>
                </tr>
            </table>';
            }
            if($noentry){
                echo '<div class="container" id="footerbottom"><strong><h4>No Discussion Answer,Be the first to answer discussion</h4></strong></div>';
            }
        ?>
    </div>
    
    <?php 
    require('components/_footer.php'); 
    ?>


</body>

</html>