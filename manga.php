<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>TEST</title>
        <link rel="stylesheet" href="libs/css/style.css">
    </head>

    <body>

    <a href="mangas.php">Переглянути усі</a>

<?

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

    $id = $_GET['hash'];

    $conn = connect();

    $sql = "SELECT manga.id, manga.cover, manga.name, manga.originalName, manga.author, manga.genres, manga.description, 
    original_status.status ostatus, translate_status.status tstatus, translation_team.name tname, age_raiting.name aname
    FROM manga INNER JOIN age_raiting ON manga.ageRaitingId = age_raiting.id
    INNER JOIN translation_team ON manga.translationTeamId = translation_team.id
    INNER JOIN translate_status ON manga.translateStatusId = translate_status.id
    INNER JOIN original_status ON manga.originalStatusId = original_status.id
    WHERE manga.id ='$id'";
    
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result)>0) {
        echo "<link rel='stylesheet' href='/libs/css/manga.css'>";
        $row = $result->fetch_array();
        echo '<div class="card"><div class="left"><img class="cover" src="data:image/jpeg;base64,'.base64_encode($row['cover']).'"/></div>';
        echo '<div class="right"><h2 class="name">'.$row['name'].' | '.$row['originalName'].'</h2>';
        echo '<p class="author">Автор: '.$row['author'].'</p>';
        echo '<p class="orig_status">Статус виходу оригінального твору: '.$row['ostatus'].'</p>';
        echo '<p class="translate_status">Статус перекладу: '.$row['tstatus'].'</p>';  
        echo '<p class="age_raiting">Віковий рейтинг: '.$row['aname'].'</p>'; 
        echo '<p class="team_translate"> Команда перекладачів: '.$row['tname'].'</p>'; 

        echo '<p class="genres">Жанри: '.$row['genres'].'</p></div>';
        echo '<p class="genres">'.$row['description'].'</p>';

        echo '</div>';
        echo '<div class="chapters">';
        echo '<h1>Chapters: </h1>'; 
    } else {
        echo "0 results";
    }

    $sql = "SELECT chapter.id, chapter.mangaId, chapter.number, chapter.name
    FROM chapter
    WHERE chapter.mangaId ='$id'";

    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result)>0) {
    echo "<link rel='stylesheet' href='/libs/css/manga.css'>";
    echo '<table>';
    while ($row = $result->fetch_array()) {
     echo '<tr><td>'.$row['number'].'</td><td><a href="chapter.php?chapter='.$row['id'].'&manga='.$row['mangaId'].'">'.$row['name'].'</a></td></tr>';  
    }
    echo '</div></table>';
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