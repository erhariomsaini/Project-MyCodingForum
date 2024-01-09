<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About - My Coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <?php 
    require('components/_dbconnect.php');
    require('components/_header.php');
     ?>
    <div class="container" class="aboutsite">
    <h1 class="text-center mt-3 mb-0">About Page</h1>
    <h4 class="text-center mt-3 mb-3">My Coding Forum is an online discussion site where people can hold conversations in the form of posted questions related to different coding languages.They differ from categories in that questions and answer are often longer than one line of text, and are at least temporarily archived. Also, depending on the access level of a user or the My Coding Forum set-up, a posted message might need to be approved by community before it becomes publicly visible.
    My Coding Forum have a specific set of jargon associated with them; for example, a single conversation is called a "thread", or question.
    A discussion forum is hierarchical or tree-like in structure; a forum can contain a number of subforums, each of which may have several topics. Within a forum's topic, each new discussion started is called a thread and can be replied to by as many people as they so wish.
    Depending on the forum's settings, users can be anonymous or have to register with the forum and then subsequently log in to post messages. On most forums, users do not have to log in to read existing messages.</h4>
    </div>
    <div class="container">
    <h1 class="text-center my-3">About Developer</h1>
    <table>
        <tr class="my-0">
            <td rowspan="2"><img style="border-radius : 500px;" src="images/hariom pic.jpg" alt="Er.Hariom Saini" height="200px"></td>
            <td><h1>Er.Hariom Saini</h1></td>
        </tr>
        <tr class="my-0">
            <td rowspan="2"><h4>Junior PHP Developer <br>Technical Skills : HTML, CSS, Javascript, Core PHP, Laravel, Word Press CMS, MySQL, Bootstrap</h4></td>
        </tr>
        <tr>
            <td><pre>       <a href="https://www.instagram.com/hariom_saini_2002/"><img src="images/instagram.jfif" alt="Instagram" height="40px"></a> <a href="https://in.linkedin.com/in/hariom-saini-04540a1b5?trk=people-guest_people_search-card" ><img src="images/linkedin.png" alt="Linkedin" height="40px" class="mx-3"></a></pre></td>
        </tr>
    </table>
    </div>
    <?php 
    require('components/_footer.php'); 
    ?>
</body>

</html>
