<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Get songs from database
    // $songsFilterQuery = "SELECT songs.id, songs.title title, singers.name singerName, 
    //                     songs.filePath audio, songs.imgPath img, singers.id singerID, songs.fileType fileType
    //                     FROM songs 
    //                     inner JOIN singers on singers.id = songs.singerID
    //                     WHERE id='$id'";

    // $result = mysqli_query($conn, $songsFilterQuery);
    // $song = mysqli_fetch_array($result,MYSQLI_ASSOC);
   
}

?>

<section style="width:100% !important ;">
    <div style="width:75% !important ;">
    <h3 class="sectionTitle">Title : Kahani Suno </h3>
    <h5>Singer : <?php echo $song['title']; ?></h5> 
    <video width="80%" controls autoplay>
  <source src="video/Kaifi Khalil - Kahani Suno 2.0.mp4" >
  Your browser does not support HTML video.
</video>
    </div>
    
    <div style="width:25% !important ;">
    <h4>RATE</h4>
    <h1>3.5/5</h1>  
    <p>Over all ratting based of 5 reviews</p>

    </div>
    
<!-- <iframe width="90%" height="90%" src="https://www.youtube.com/embed/zdp0zrpKzIE?list=PLlasXeu85E9cQ32gLCvAvr9vNaUccPVNP" title="map, filter & reduce 🙏 Namaste JavaScript Ep. 19 🔥" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
</section>