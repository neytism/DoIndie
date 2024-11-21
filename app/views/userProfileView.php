<?php
$is_self = $data['is_self'];
?>


<?php include 'app/views/navbarView.php'; ?>

<?php if(!$is_self){
    $user_info = $data['searched_user'];
}else{
    $user_info = $data['user_info'];
}?>

<h2>DoIndie Profile Page</h2>


<div ><img
        style="height: auto; max-width: 300px"
        src="<?php echo BASEURL; ?>uploads/images/profile_pictures/<?= $user_info['picture_path'] ?>"
        alt="<?= $user_info['username'] ?> Profile Pic"></div>
<?php if ($user_info['is_artist'] == "true"): ?>
    <h1>Artist: <?= $user_info['artist_display_name'] ?></h1>
<?php endif; ?>
<h3><?= $user_info['username'] ?></h3>
<?php if ($is_self): ?>
    <h4>This is you.</h4>
<?php endif; ?>
<h4> User id is <?= $user_info['user_id'] ?></h4>
<h4> First Name is <?= $user_info['first_name'] ?></h4>
<h4> Last Name is <?= $user_info['last_name'] ?></h4>
<?php if ($user_info['is_verified_email'] == 'true'): ?>
    <h4>Email is Verified.</h4>
<?php else: ?>
    <h4>Email is Not verified.</h4>
    <?php if ($is_self): ?>
        <button class="b" onclick="window.location='<?php echo BASEURL; ?>verifyEmail'">Verify Email</button>
    <?php endif; ?>
<?php endif; ?>
<?php
$date_joined = new DateTime($user_info['date_joined']);
$formatted_date = $date_joined->format('F j, Y \a\t g:i A');
?>
<h4> Joined last <?= $formatted_date ?></h4>
<?php if ($is_self): ?>
    <button class="b" onclick="window.location='<?php echo BASEURL; ?>profile/edit'">Edit Profile</button>
<?php endif; ?>
<?php if($user_info['is_artist'] == "true"):?>
<h4><a href="<?php echo BASEURL; ?>products/artist/<?=$user_info['username']?>">See products</a></h4>
<?php endif; ?>
<h4> Use this to show more info</h4><br>

<?php if ($user_info['is_artist'] == "true"):?>
    <h2>Featured Artworks</h2>
<?php endif; ?>

<?php if ($is_self && $user_info['is_artist'] == "true"): ?>
    <button class="b">Upload new Product</button>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\website.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\userprofile.css">
    <title>DoIndie</title>
    <link rel="icon" type="image/png" href="<?php echo BASEURL; ?>uploads\images\LOGO.png"> 

    <!-- Swiper Stylesheet -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\website.css">

    <style>
        
        .b {
            background-color: #423329;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        
        .faded {
            opacity: 0.5;
        }
        
        .b:hover {
            color: #ff7200;
            background-color: #2f1a09; 
        }
            
    </style>
</head>
    
<body>

		<div class="artist-section">
			<div class="artist-picture">
                <img src="<?php echo BASEURL; ?>assets\img\sample.png" alt="Artist Picture"> 
            </div>
            <div class="box">
			    <div class="artist-info">
                    <h2>Artist Name</h2>
                    <p class="headline">"Artist's headline or tagline"</p>
                </div>
                
                <div class="artist-bio">
                    <h3>Bio</h3>
                    <p>Lorem ipsum dolor sit amet. Non optio officiis sed impedit beatae in voluptatem deserunt et doloribus debitis et modi natus qui earum voluptates eos autem sequi. Eos alias dolor qui incidunt repellendus et sint nesciunt eos sint neque nam odit amet aut minima debitis.</p>
                </div>
                
                <div class="artist-location">
                    <h3>Location</h3>
                    <p>Aut Quis sunt sed fugiat dolor est nihil iusto eos adipisci necessitatibus eos adipisci totam sit dolorum dolorem nam autem culpa.</p>
                </div>                           
            </div>
        </div>
        
		 <!-- Pins Section -->
		 <div id="gallery" class="gallery-section" style="display: flex; justify-content: center; align-items: center; margin-top: 100px;">
			<div class="swiper">
				<div class="swiper-wrapper">
					<div class="swiper-slide"> <a href="art-prev1.html"><img src="<?php echo BASEURL; ?>assets\img\sample.png" width="200" height="200" alt="ARTWORK PREVIEW 1" /></a> </div>
					<div class="swiper-slide"> <a href="art-prev2.html"><img src="<?php echo BASEURL; ?>assets\img\sample.png" width="200" height="200" alt="ARTWORK PREVIEW 2" /></a> </div>
					<div class="swiper-slide"> <a href="art-prev3.html"><img src="<?php echo BASEURL; ?>assets\img\sample.png" width="200" height="200" alt="ARTWORK PREVIEW 3" /></a> </div>
					<div class="swiper-slide"> <a href="art-prev4.html"><img src="<?php echo BASEURL; ?>assets\img\sample.png" width="200" height="200" alt="ARTWORK PREVIEW 4" /></a> </div>
					<div class="swiper-slide"> <a href="art-prev5.html"><img src="<?php echo BASEURL; ?>assets\img\sample.png" width="200" height="200" alt="ARTWORK PREVIEW 5" /></a> </div>
					<div class="swiper-slide"> <a href="art-prev6.html"><img src="<?php echo BASEURL; ?>assets\img\sample.png" width="200" height="200" alt="ARTWORK PREVIEW 6" /></a> </div>
					<div class="swiper-slide"> <a href="art-prev7.html"><img src="<?php echo BASEURL; ?>assets\img\sample.png" width="200" height="200" alt="ARTWORK PREVIEW 7" /></a> </div>
					<div class="swiper-slide"> <a href="art-prev8.html"><img src="<?php echo BASEURL; ?>assets\img\sample.png" width="200" height="200" alt="ARTWORK PREVIEW 8" /></a> </div>
				</div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
		</div>

        <!-- Reviews Section -->
        <div class="review-section">
            <div class="review-header">
                <h3>Reviews</h3>
            </div>
            <div id="review-list" class="review-list">
                <!-- Reviews will be dynamically loaded here -->
            </div>
        </div>

        <div class="review-links-container">
            <button id="seeAllReviews" class="review-link see-all-reviews">SEE ALL REVIEWS</button>
            <button id="writeReview" class="review-link write-review">WRITE A REVIEW</button>
        </div>

        <!-- Write Review Modal -->
        <div id="reviewModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeReviewModal">&times;</span>
                <h3>Write a Review</h3>
                <textarea id="reviewTextarea" rows="4" cols="30" placeholder="Write your review here..."></textarea>
                <button class="save" id="submitReview">Submit Review</button>
            </div>
        </div>
        
        <!-- FOOTER -->
        <div class="footer">
            <ul class="row-list center">
                <li><a class="rowItem">Home</a></li>
                <li><a class="rowItem">Products</a></li>
                <li><a class="rowItem">Shopping Cart</a></li>
                <li><a class="rowItem">Profile</a></li>
                <li><a class="rowItem">About Us</a></li>
            </ul>
            <ul class="row-list center">
                <a href="https://www.facebook.com" class="fa fa-facebook" style="font-size: 40px;" target="_blank"></a>
                <a href="https://www.youtube.com" class="fa fa-youtube" style="font-size: 40px;" target="_blank"></a>
                <a href="https://www.twitter.com" class="fa fa-twitter" style="font-size: 40px;" target="_blank"></a>
                <a href="https://www.instagram.com" class="fa fa-instagram" style="font-size: 40px;" target="_blank"></a>
                <a href="https://www.tumblr.com" class="fa fa-tumblr" style="font-size: 40px;" target="_blank"></a>
            </ul>
            <p style="color: #f4e9dc">&copy; 2024 DoIndie. All rights reserved.</p>
        </div>

    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- External JS File -->
    <script src="<?php echo BASEURL; ?>assets\js\userprofile.js"></script>
    <script>

        document.addEventListener("DOMContentLoaded", function () {
            const reviewModal = document.getElementById("reviewModal");
            const closeReviewModal = document.getElementById("closeReviewModal");
            const writeReviewBtn = document.getElementById("writeReview");
            const submitReviewBtn = document.getElementById("submitReview");
            const reviewTextarea = document.getElementById("reviewTextarea");
            const reviewList = document.getElementById("review-list");

            // Load and display reviews from local storage
            const loadReviews = () => {
                localStorage.getItem("publicReviews");
                reviewList.innerHTML = ""; // Clear existing reviews
                reviews.forEach((review, index) => {
                    addReviewToList(review, index);
                });
            };

            // Function to add a new review to the list
            const addReviewToList = (reviewText, index) => {
                // Create a new review section
                const reviewSection = document.createElement("div");
                reviewSection.classList.add("review-item");
                reviewSection.innerHTML = `
                    <h4>Review ${index + 1}</h4>
                    <p>${reviewText}</p>
                `;
                reviewList.appendChild(reviewSection); // Add to the review list
            };

            // Show modal for writing a new review
            writeReviewBtn.onclick = () => {
                reviewModal.style.display = "flex";
            };

            // Close the review modal
            closeReviewModal.onclick = () => {
                reviewModal.style.display = "none";
                reviewTextarea.value = ""; // Clear the textarea
            };

            // Submit review
            submitReviewBtn.onclick = () => {
                const newReview = reviewTextarea.value.trim();
                if (newReview) {
                    const reviews = JSON.parse(localStorage.getItem("publicReviews") || "[]");
                    reviews.push(newReview);
                    localStorage.setItem("publicReviews", JSON.stringify(reviews));
                    addReviewToList(newReview, reviews.length - 1); // Display the new review
                    reviewModal.style.display = "none";
                    reviewTextarea.value = ""; // Clear the textarea
                }
            };

            // Close modal if user clicks outside of it
            window.onclick = function (event) {
                if (event.target == reviewModal) {
                    reviewModal.style.display = "none";
                }
            };

            // Initialize and load reviews on page load
            loadReviews();
        });
    </script>
	
</body>
</html>