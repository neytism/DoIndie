<?php
$is_self = $data['is_self'];
?>


<?php if (!$is_self) {
    $user_info = $data['searched_user'];
    $user_top_products = $data['searched_user_products'];
} else {
    $user_info = $data['user_info'];
    $user_top_products = $data['user_products'];
} ?>

<?php
    $date_joined = new DateTime($user_info['date_joined']);
    $formatted_date = $date_joined->format('F j, Y \a\t g:i A');
?>

<?php include 'app/views/navbarView.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\website.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets\css\userprofile.css">
    <title><?= $user_info['username'] ?></title>
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

        .banner {
            top: -64px;
            height: 400px; /* Set your desired height */
            width: 100%; /* Full width of the screen */
            position: relative; /* Position relative for overlay text if needed */
            overflow: hidden; /* Prevent overflow of the pseudo-element */
            z-index: -5; 

            border-bottom: 10px solid white;
        }

        .banner::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 150%;
            height: 150%; 
            background-image: url('<?php echo BASEURL; ?>uploads/images/profile_pictures/<?= $user_info['picture_path'] ?>'); 
            background-size: cover;
            background-position: center; 
            filter: blur(80px);
            transform: translate(-50%, -50%); 
            z-index: 0; 
        }
        
        .banner::after {
            position: absolute;
            top: 50%;
            left: 50%;
            right: 50%;
            bottom: 50%;
            z-index: 1; 
        }
        
        .profile-info {
            position: relative; 
            width: 100%; 
            height: 300px; 
            overflow: hidden; 
            top: calc(-100px - 64px); 
            z-index: 3;
        }

        .profile-info img {
            border: 10px solid white;
            position: absolute; 
            left:0px;
            margin-left: 100px;
            width: 300px; 
            height: 300px;
            border-radius: 25px; 
            background-color: #423329; 
            z-index: 4;
        }
        
        .profile-info h1 {
            margin-left: 100px;
            font-size: 64px;
            text-align: left;
            position: absolute; 
            left: 350px;
            z-index: 4;
            top: calc(60% - 64px);
        }

        .profile-info h2 {
            margin-left: 100px;
            font-size: 24px;
            text-align: left;
            position: absolute; 
            left: 350px;
            z-index: 4;
            opacity: 0.75;
            top: calc(85% - 64px);
        }

        .profile-info p {
            margin-left: 100px;
            font-size: 18px;
            text-align: left;
            position: absolute; 
            left: 350px;
            z-index: 4;
            top: calc(100% - 64px);
        }

        .profile-info .edit-profile-btn {
            position: absolute; 
            right: 50px;
            z-index: 4;
            top: calc(60% - 64px);
        }
    
    </style>
</head>

<body>

    <div class="banner"></div>
    
    <div class="profile-info">
        <img src="<?php echo BASEURL; ?>uploads/images/profile_pictures/<?= $user_info['picture_path'] ?>" alt="Artist Picture" style="aspect-ratio: 1 / 1; object-fit: cover;">
        <h1>
        <?php if ($user_info['is_artist'] == "true"): ?>
            <?= $user_info['artist_display_name'] ?>
        <?php else: ?>
            <?= $user_info['username'] ?>
        <?php endif; ?>
        </h1>
        <h2>@<?= $user_info['username'] ?></h2>
        <p>
            <?php if (empty($user_info['bio'])): ?>
                <?= "No Bio." ?>
            <?php else: ?>
                <?= $user_info['bio'] ?>
            <?php endif; ?>
        </p>
        <?php if ($is_self): ?>
            <button class="b edit-profile-btn" onclick="window.location='<?php echo BASEURL; ?>profile/edit'">Edit Profile</button>
        <?php endif; ?>        
    </div>

    <div class="artist-section" style="margin-top: -100px">
        <div class="box">

            <div class="artist-info">
                <h4 class="info-title">Username</h4>
                <p class="info-deets" ><?= $user_info['username'] ?></p>
            </div>

            <div class="artist-info">
                <h4 class="info-title">Full Name</h4>
                <p class="info-deets" ><?= $user_info['full_name'] ?></p>
            </div>

            <div class="artist-info">
                <h4 class="info-title">Email</h4>
                <p class="info-deets" ><?= $user_info['email'] ?>
                <?php if ($user_info['is_verified_email'] == 'true'): ?>
                     (Verified)
                <?php else: ?>
                     (Not verified.)
                <?php endif; ?></p>
            </div> 
            
            <?php if ($user_info['is_artist'] == 'true'): ?>

                <div class="artist-info">
                    <h4 class="info-title">Artist Name</h4>
                    <p class="info-deets" ><?= $user_info['artist_display_name'] ?></p>
                </div>   
                
                <div class="artist-info">
                    <h4 class="info-title">Specialty</h4>
                    <p class="info-deets" ><?= $user_info['artist_category_name'] ?></p>
                </div>   

            <?php endif; ?>

            <div class="artist-info">
                <h4 class="info-title">Join Date</h4>
                <p class="info-deets" ><?= $formatted_date ?></p>
            </div>   
        </div>
    </div>
    
    <?php if ($user_info['is_artist'] == 'true'): ?>

        <div id="gallery" class="gallery-section" style="display: flex; justify-content: center; align-items: center;">
            <h1 style="padding: 50px; font-size: 48px;">Top Works</h1>
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php foreach($user_top_products as $product): ?>
                        <div class="swiper-slide"> <a href="CHANGE_LINK"><img src="<?php echo BASEURL; ?>uploads/images/product_pictures/<?= $product['product_picture_path'] ?>" width="200" height="200" alt="<?= $product['title'] ?>" /></a> </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
        
        <br> <br>
        
        <button class="b" onclick="window.location='<?php echo BASEURL; ?>products/artist/<?= $user_info['username'] ?>'">See All products</button>
    
    <?php endif; ?>
    <!-- Pins Section -->
    
    
    <!-- Reviews Section -->
    <!-- <div class="review-section">
        <div class="review-header">
            <h3>Reviews</h3>
        </div>
        <div id="review-list" class="review-list"> -->
            <!-- Reviews will be dynamically loaded here -->
        <!-- </div>
    </div> -->
    
    <!-- <div class="review-links-container">
        <button id="seeAllReviews" class="review-link see-all-reviews">SEE ALL REVIEWS</button>
        <button id="writeReview" class="review-link write-review">WRITE A REVIEW</button>
    </div> -->
    
    <!-- Write Review Modal -->
    <!-- <div id="reviewModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeReviewModal">&times;</span>
            <h3>Write a Review</h3>
            <textarea id="reviewTextarea" rows="4" cols="30" placeholder="Write your review here..."></textarea>
            <button class="save" id="submitReview">Submit Review</button>
        </div>
    </div> -->
    <br><br><br><br>
    <?php include 'app/views/footerView.php';?>

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