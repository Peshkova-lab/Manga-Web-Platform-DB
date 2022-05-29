<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>CHAPTER</title>
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

    $chapter = $_GET['chapter'];
    $manga = $_GET['manga'];

    $conn = connect();

    $sql = "SELECT page.id, page.number, page.image, chapter.name chname, chapter.number chnumber, manga.name mname, page.mangaId, page.chapterId
    FROM page INNER JOIN chapter ON page.chapterId = chapter.id
    INNER JOIN manga ON chapter.mangaId = manga.Id
    WHERE page.chapterId ='$chapter'
    AND page.mangaId='$manga'
    ORDER BY page.number";
    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)>0) {
        echo "<link rel='stylesheet' href='/libs/css/chapter.css'>";
        echo '<div class="chapter">';
        $i = 0;

        while ($row = $result->fetch_array()) {
            if ($i == 0 ) {
            echo '<h1><a href="manga.php?hash='.$row['mangaId'].'">'.$row['mname'].'</a></h1>';
            echo '<h2>'.$row['chname'].'</h2>';
            $i++;
            $chapterNumber = $row['chnumber'];
        }
            echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>';        
        }
        echo '</div>';
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