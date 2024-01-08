<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Coding Forum - Coding Discussion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .container{
            min-height : 670px;
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
    <?php
    $query = $_GET['query'];
    echo '<div class="container my-3">
        <h1>Search results for "<em>'.$query.'</em>"</h1>';
    $sql1="SELECT * FROM `thread` WHERE MATCH(`thread_title`,`thread_desc`) AGAINST('$query')";
    $result1 = mysqli_query($conn,$sql1);
    $row=true;
    while($row1 = mysqli_fetch_assoc($result1)){
        $title1 = $row1['thread_title'];
        $desc1 = $row1['thread_desc'];
        $threadid =$row1['thread_id'];
        echo '<table>
            <tr class="mb-2">
                <td class="px-4">
                    <ul><li><a href="thread.php?threadid='.$threadid.'"><h4>'.$title1.'</h4></a>
                    <h6>'.$desc1.'</h6></li></ul>
                </td>
            </tr>
        </table>';
        $row=false;
    }
    if($row){
        echo '<h2 class="mt-5">No result found</h2><h4>Suggestions:
        <ul>
        <li>Make sure that all words are spelled correctly.</li>
        <li>Try different keywords.</li>
        <li>Try more general keywords.</li></ul></h4>';
    }
    echo '</div>';
    ?>
    
        
    
    <?php require('components/_footer.php'); ?>


</body>

</html>