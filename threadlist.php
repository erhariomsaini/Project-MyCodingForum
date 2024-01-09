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
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        $th_title = $_POST['topic'];
        $th_desc = $_POST['desc'];
        $catid = $_GET['catid'];

        $th_title = str_replace("<","&lt;",$th_title);
        $th_title = str_replace(">","&gt;",$th_title);
        $th_title = str_replace("'","&#39;",$th_title);
        $th_title = str_replace('"','&#34;',$th_title);
        $th_title = str_replace(';',"&#59;",$th_title);

        $th_desc = str_replace("<","&lt;",$th_desc);
        $th_desc = str_replace(">","&gt;",$th_desc);
        $th_desc = str_replace("'","&#39;",$th_desc);
        $th_desc = str_replace('"','&#34;',$th_desc);
        $th_desc = str_replace(';',"&#59;",$th_desc);
        
        if($th_title!=NULL||$th_desc!=NULL){
        $user_id = $_SESSION['user_id'];
        // $sql1="SELECT * FROM `users` WHERE `user_id` = 27";
        // $result1 = mysqli_query($conn,$sql1);
        // $row1 = mysqli_fetch_assoc($result1);
        // $thread_user_id = $row1['user_id'];
        $sql ="INSERT INTO `thread` (`thread_title`, `thread_desc`, `thread_cat`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$catid', '$user_id', current_timestamp())";
        $result = mysqli_query($conn,$sql);
        if($result==1){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong> Your question has been added wait for community to respond...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            $result=0;
            }
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error! </strong> Question Title & Description can\'t be blank...
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        $th_title=NULL;
        $th_desc=NULL;
    }
    ?>


    <?php 
    $catid = $_GET['catid'];
    $_SESSION['catid'] = $catid;
    $sql ="SELECT * FROM `categories` WHERE `category_id`= $catid";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname=$row['category_name'];
        $catdesc=$row['category_discription'];
        }
    ?>
    

    <div class="container my-4">
        <fieldset>
            <legend>
                <h1 class="display-4"><strong><?php echo $catname;?></strong></h1>
            </legend>
            <p class="lead"><?php echo $catdesc;?></p>
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do
                not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross
                post
                questions. Remain respectful of other members at all times.</p>
            <hr class="my-0">
        </fieldset>
    </div>


    <?php 
    if(isset($_SESSION['loggedin'])==true && $_SESSION['loggedin']==true){
    echo '<div class="container">
        <fieldset>
            <legend>
            <h1 class="my-0">Ask Question</h1>
            </legend>
            <form action="threadlist.php?catid='.$catid.'" method="post">
                <div>
                    <label for="topic" class="col-form-label ms-2">
                        <h5>Question Topic</h5>
                    </label>
                    <div>
                        <input type="text" class="form-control" id="topic"  name="topic">
                    </div>
                </div>
                <div>
                    <label for="desc" class="col-form-label ms-2" >
                        <h5>Question Discription</h5>
                    </label>
                    <div>
                        <textarea type="text" class="form-control" id="desc"  name="desc" rows="4" placeholder="Elaborate your question here..."></textarea>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success mb-4 mt-2">Add Question</button>
                </div>
            </form>
        </fieldset>
        <hr class="my-0">
    </div>';
    }
    else{
        echo '<div class="container">
        <div class="alert alert-success" role="alert">
        <h1>Login to ask question...</h1>
        </div>
        </div>';
    }
    ?>


    <div class="container">
        <h2 class="mt-4 mb-2">Browse Questions</h2>
    </div>


    <div class="container" id="footerbottom">
        <?php 
    $noentry=true;
    $catid = $_GET['catid'];
    $sql ="SELECT * FROM `thread` WHERE `thread_cat` = $catid";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $id=$row['thread_id'];
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];

        $user_id=$row['thread_user_id'];
        $sql1 ="SELECT * FROM `users` WHERE `user_id` = $user_id";
        $result1 = mysqli_query($conn,$sql1);
        while($row1 = mysqli_fetch_assoc($result1)){
        $thread_user_id = $row1['useremail'];

        $thread_time=$row['timestamp'];
        $noentry=false;}
    
    echo'<table>
            <tr>
                <td><img src="images\user.jpg" height="50px" alt="User"></td>
                <td class="px-3">
                    <h4 class="mb-0"><a href="thread.php?threadid='.$id.'">'.$title.'</a></h4>
                    <h5>'.$desc.'</h5>
                    <h6>Posted by <strong>'.$thread_user_id.'</strong> at <strong>'.$thread_time.'</strong> </h6>
                </td>
            </tr>
        </table>';
    }
    if($noentry){
    echo '<div class="container" id="footerbottom"><strong><h4>No Discussion Topic,Be the first to start discussion</h4></strong></div>';
    }
    ?>
    </div>


    <?php 
    require('components\_footer.php'); 
    ?>


</body>

</html>