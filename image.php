<?php

function loadImage() {
    $host     = 'courseWork2';
    $username = 'root';
    $password = 'root';
    $db     = 'course_work_db';
    
    //Create the connection and select the database
    $db = new mysqli($host, $username, $password, $db);
    
    // Check the connection
    if($db->connect_error){
        die("Connexion error: " . $db->connect_error);
    }
    
    //Get the image from the database
    $res = $db->query("SELECT cover FROM manga WHERE id = 1");
    
    if($res->num_rows > 0){
        $img = $res->fetch_assoc();
        
        //Render the image
        header("Content-type: image/jpg"); 
        echo $img['cover']; 
    }else{
        echo 'Image not found...';
    }
}

loadImage();
?>