<?php
if (isset($_GET['search'])) {
    
    
}

?>
<!-- <?php include('./components/navbar.php'); ?> -->
<script>
  console.log(<?php echo json_encode($songs); ?>);
</script>
<section>
    <h3 class="sectionTitle">Songs</h3>
    <div class="songsContain">
        <?php foreach ($songs as $index => $song) : ?>
            <?php
            $heartIcon = '<i class="far fa-heart fa-2x"></i>';
            
       
            if ($authenticated) {
                if (in_array($song["id"], $favSongs)) {
                    $heartIcon = '<i class="fas fa-heart fa-2x" fav="1"></i>';
                }
            }
            ?>
            <div class="song" data="<?php echo $song['id']; ?>">
                <div class="info">
                    <h4><?php echo $index + 1; ?> </h4>
                    <img src="<?php echo $song['img']; ?>">
                    <div class="detail">
                        <h4><?php echo $song['title']; ?></h4>
                        <h4><?php echo $song['fileType']; ?></h4>
                        <h5 class="singerPage" data-singer="<?php echo $song["singerID"]; ?>"><?php echo $song['singerName']; ?></h5>
                    </div>
                </div>
                <div class="func">
                <?php if ($song["fileType"]=="video") : ?>
                    <i data-songId="<?php echo $song['id'];?>" class="fas fa-film fa-2x"></i>
                <?php endif; ?>   
                <h1><?php echo $song["fileType"];  ?></h1>
                    <?php echo $heartIcon;  ?>
                    <i class="fas fa-list-ul fa-2x"></i>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<script>
    const videoIcon  = document.querySelector("i.fa-film");    
    videoIcon.addEventListener("click", () => {        
        const songId=videoIcon.getAttribute('data-songId');       
        window.location.assign("VideoSong.php?id="+songId+"");      
    });
</script>