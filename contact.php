<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact - My Coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    .container {
        min-height: 705px;
        
    }

    .row {
        justify-content: center;
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
    if ($_SERVER['REQUEST_METHOD']=="POST"){
        $email = $_POST['email'];
        $topic = $_POST['topic'];
        $desc = $_POST['desc'];
        
        $sql = "INSERT INTO `contact_us` (`email`, `topic`, `description`, `timestamp`) VALUES ('$email', '$topic', '$desc', current_timestamp())";
        if(mysqli_query($conn,$sql)){
            echo '<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
        <strong>Your concern is submitted! </strong> We will reach out to you as soon as possible...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
    }
    ?>
    <div class="container">
        <h1 class="text-center mt-5 mb-3">Contact Us</h1>
        <form action="contact.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label"><strong>Email :</strong></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
            </div>
            <div class="mb-3">
                <label for="topic" class="form-label"><strong>Topic :</strong></label>
                <input type="text" class="form-control" id="topic" name="topic"
                    placeholder="Write your concern topic here...">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label"><strong>Description :</strong></label>
                <textarea class="form-control" id="desc" rows="5" name="desc"
                    placeholder="Eloborate your concern description here..."></textarea>
            </div>
            <div class="mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
                <input class="btn btn-success btn-lg" type="submit" name="Submit">
            </div>
        </form>

    </div>
    <?php require('components/_footer.php'); ?>
</body>

</html>