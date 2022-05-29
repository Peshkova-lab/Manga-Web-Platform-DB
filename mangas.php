<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Manga</title>
        <link rel="stylesheet" href="libs/css/style.css">
    </head>

    <body>

    <h1>Усі манги</h1>

<?php

$servername = "courseWork2";
$username = "root";
$password = "root";
$dbname = "course_work_db";

function connect() {
    $conn = mysqli_connect("courseWork2", "root", "root", "course_work_db");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($conn, "utf8");
    return $conn;
}

function loadImage() {
    $conn = connect();
    $sql = "SELECT manga.id, manga.cover, manga.name, manga.originalName, manga.author, manga.genres
    FROM manga
    ORDER BY manga.id";
    $result = mysqli_query($conn, $sql);
    
    
    if (mysqli_num_rows($result)>0) {
        
        echo "<link rel='stylesheet' href='/libs/css/style.css'>";
        
        while ($row = $result->fetch_array()) {
            echo '<div class="card"><img class="cover" src="data:image/jpeg;base64,'.base64_encode($row['cover']).'"/>';
            echo '<a href="manga.php?hash='.$row['id'].'"><h2 class="name">'.$row['name'].' | '.$row['originalName'].'</h2></a>';
            echo '<p class="author">'.$row['author'].'</p>';
            echo '<p class="genres">'.$row['genres'].'</p>';
            echo '</div>';
        }
    } else {
        echo "0 results";
    }

    mysqli_close($conn);
}

loadImage();

?>

        <script src = "libs/js/jquery-3.6.0.min.js"></script>
    
    </body>
</html>