
<?php include 'app/views/navbarView.php'; ?>
<h2>DoIndie Home Page</h2>

<h1>Hello, <?php 

 if ($data['is_logged_in']) {
    ;
    echo $data['user_info']['username'];
} else {
    echo 'Guest!';
}
 ?></h1>



