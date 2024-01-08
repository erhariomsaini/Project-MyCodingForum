<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Coding Forum - Coding Discussion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
            .catdesc{
            min-height: 170px;
            }
        </style>
</head>

<body>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>


    <?php
    require('components/_dbconnect.php'); 
    require('components/_header.php'); ?>


    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/1.jpg" class="d-block w-100" height="450px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/2.jpg" class="d-block w-100" height="450px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/3.jpg" class="d-block w-100" height="450px" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <?php
     
    $sql ="SELECT * FROM `categories`";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    echo '<div class="container mb-2">
    <h1 class="text-center my-4"><b>My Coding Forum - Browse Categeries</b></h1>
    <div class="row mx-2">';
      while($show = mysqli_fetch_assoc($result)){
        $id = $show["category_id"];
        $name = $show["category_name"];
        $desc = $show["category_discription"];
        $imglink = "images\\$name.jpg";
      echo '<div class="card col" style="width: 18rem;">
      <img src="'.$imglink.'" height="250px" class="card-img-top mt-2" alt="...">
        <div class="card-body">
          <h3 class="card-title"><a href="threadlist.php?catid='.$id.'">'.$name.'</a></h3>
          <div class="catdesc"><p class="card-text">'.substr($desc,0,100).' . . . </p></div>
          <a href="threadlist.php?catid='.$id.'" class="btn btn-outline-primary">View Questions</a>
        </div>
      </div>';
      }
    echo'</div>  
  </div>';
    ?>


    <?php 
    require('components/_footer.php'); 
    ?>


</body>

</html>