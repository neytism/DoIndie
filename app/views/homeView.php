<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?php echo BASEURL; ?>assets\img\LOGO.png" />
    <title>DoIndie</title>

     <!-- CSS FILE LINK -->
     <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\website.css">
     <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\homepage.css">
  
  </head>
  <body>
    <?php include 'app/views/navbarView.php'; ?>
    <div class="home-container">

      <!-- HERO SECTION START -->
      <section class="hero" style="height: calc(100vh - 64px);">
        <div class="hero-image">
          <img 
            src="<?php echo BASEURL; ?>assets\img\FISH MASCOT.png"
            alt="homepage image"
            data-aos="fade-up"
          />
          <h2 data-aos="fade-up">
            Do, <br />
            Indie
          </h2>

          <div class="hero-image__overlay"></div>
        </div>
        
        <div class="hero-content">
          <div class="hero-content-info" data-aos="fade-left">
            <?php if($is_logged_in):?>
            <p>Welcome, <?=$data['user_info']['username'] ?></p>
            <?php endif;?>
            <h1>Made by Artists,<br>for Artists</h1>
            <p>An online artists' marketplace.</p>

            <!-- <div class="hero-content__buttons">
              <button class="hero-content__order-button">What's New?</button>
              <button class="hero-content__play-button">
                <img src="<?php echo BASEURL; ?>assets\img\play-circle.svg" alt="play" />
                Terms and Conditions
              </button>
            </div> -->
          </div>

          <!-- <div class="hero-content__testimonial" data-aos="fade-up">
            <div class="hero-content__customer flex-center">
              <h4>Lorem</h4>
              <p>Ipsum Dolor</p>
            </div>

            <div class="hero-content__review">
              <img src="<?php echo BASEURL; ?>assets\img\user.png" alt="user" />
              <p>"User review here maybe?"</p>
            </div>
          </div> -->
        </div>
      </section>
      <!-- HERO SECTION END -->


      <!-- SCROLLING GALLERY START -->
      
      <div class="carousel" style="padding-top: 150px; padding-bottom: 150px; background-color: #6d584b;">
        <h1 style="text-align: center; font-weight: bolder; color: #f4e9dc; font-family:'Roboto', sans-serif; padding-top: 5px;">TOP ARTWORKS</h1>
        <div class="carousel-container">
            <?php 
            $index = 1; 
            $totalArtists = count($data['top_artworks']);
            
            while ($index <= 5) {
                $currentArtistIndex = ($index - 1) % $totalArtists;
                $artwork = $data['top_artworks'][$currentArtistIndex]; 
            ?>
                <img class="carousel-item carousel-item-<?=$index?>" 
                    src="<?php echo BASEURL; ?>uploads/images/product_pictures/<?= $artwork['product_picture_path'] ?>" 
                    loading="lazy" 
                    data-index="<?=$index?>"
                    title="<?= $artwork['title'] ?>">
                <?php 
                $index++; 
            } 
            ?>
        </div>
        
        <div class="carousel-controls">
          <button class="carousel-control carousel-control-previous" data-name="previous">
            <span class="ax-hidden">previous</span>
          </button>
          <!-- <button class="carousel-control carousel-control-add" data-name="add">
            <span class="ax-hidden">add</span>
          </button> -->
          <button class="carousel-control carousel-control-play playing" data-name="play">
            <span class="ax-hidden">play</span>
          </button>
          <button class="carousel-control carousel-control-next" data-name="next">
            <span class="ax-hidden">next</span>
          </button>
        </div>
      </div>

      <div class="carousel" style="padding-top: 150px; padding-bottom: 150px; background-color:#f4e9dc ;">
        <h1 style="text-align: center; font-weight: bolder; color: #6d584b; font-family:'Roboto', sans-serif; padding-top: 5px;">NEW ARTISTS</h1>
        <div class="carousel-container">
            <?php 
            $index = 1; 
            $totalArtists = count($data['new_artists']);
            
            while ($index <= 5) {
                $currentArtistIndex = ($index - 1) % $totalArtists;
                $new_artist = $data['new_artists'][$currentArtistIndex]; 
            ?>
                <img class="carousel-item carousel-item-<?=$index?>" 
                    src="<?php echo BASEURL; ?>uploads/images/profile_pictures/<?= $new_artist['picture_path'] ?>" 
                    loading="lazy" 
                    data-index="<?=$index?>"
                    title="<?= $new_artist['artist_display_name'] ?>">
                <?php 
                $index++; 
            } 
            ?>
        </div>
        
        <div class="carousel-controls">
          <button class="carousel-control carousel-control-previous" data-name="previous">
            <span class="ax-hidden">previous</span>
          </button>
          <!-- <button class="carousel-control carousel-control-add" data-name="add">
            <span class="ax-hidden">add</span>
          </button> -->
          <button class="carousel-control carousel-control-play playing" data-name="play">
            <span class="ax-hidden">play</span>
          </button>
          <button class="carousel-control carousel-control-next" data-name="next">
            <span class="ax-hidden">next</span>
          </button>
        </div>
      </div>

      <div class="carousel" style="padding-top: 150px; padding-bottom: 150px; background-color:#6d584b ;">
        <h1 style="text-align: center; font-weight: bolder; color: #f4e9dc; font-family:'Roboto', sans-serif; padding-top: 5px;">NEW ARTWORKS</h1>
        <div class="carousel-container">
            <?php 
            $index = 1; 
            $totalArtists = count($data['new_artworks']);
            
            while ($index <= 5) {
                $currentArtistIndex = ($index - 1) % $totalArtists;
                $new_artwork = $data['new_artworks'][$currentArtistIndex]; 
            ?>
                <img class="carousel-item carousel-item-<?=$index?>" 
                    src="<?php echo BASEURL; ?>uploads/images/product_pictures/<?= $new_artwork['product_picture_path'] ?>" 
                    loading="lazy" 
                    data-index="<?=$index?>"
                    title="<?= $new_artwork['title'] ?>">
                <?php 
                $index++; 
            } 
            ?>
        </div>
        
        <div class="carousel-controls">
          <button class="carousel-control carousel-control-previous" data-name="previous">
            <span class="ax-hidden">previous</span>
          </button>
          <!-- <button class="carousel-control carousel-control-add" data-name="add">
            <span class="ax-hidden">add</span>
          </button> -->
          <button class="carousel-control carousel-control-play playing" data-name="play">
            <span class="ax-hidden">play</span>
          </button>
          <button class="carousel-control carousel-control-next" data-name="next">
            <span class="ax-hidden">next</span>
          </button>
        </div>
      </div>

      <!-- SCROLLING GALLERY END -->

      <?php include 'app/views/footerView.php';?>
    
    </div>
    

    <!-- JS FILE LINK -->
    <script defer src="<?php echo BASEURL; ?>assets\js\homepage.js"></script>
  </body>
</html>