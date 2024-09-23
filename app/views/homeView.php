<?php 
$logged = $data['is_logged_in'] //just to shorten
?>

<?php include 'app/views/navbarView.php'; ?>
<h2>DoIndie Home Page</h2>

<h1>Hello, <?php 

 if ($logged) {
    $user_info = $data['user_info'];
    echo $user_info['username'];
} else {
    echo 'Guest!';
}
 ?></h1>



