<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= BASEURL; ?>assets/css/website.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>assets/css/aboutUs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
    <body>
        <?php include 'app/views/navbarView.php'; ?>

        <!-- About Us -->
        <div class="aboutUsMainHeader">
            <img src="<?= BASEURL; ?>uploads\images\LOGO.png" class="aboutUsMainHeaderLogo" alt="Image">
        </div>

        <div class="aboutUsDivContainer">
            <div>
                <h1 class="center">ABOUT US</h1>
            </div>

            <div>
                <div> 
                <p class="center aboutUsTextCenter">DoIndie is a Filipino-based merchandise distribution website that focuses on offering an (e-commerce) service for both art enthusiasts and artists alike! There are two core ideals that the website proposes towards its users, and one is to be able to cater towards indie artists who are not tech savvy to make their own website from scratch but are still looking for ways to market their creative works. Along with this, the website seeks to give art enthusiasts a way to easily browse and explore any artistic merchandise that piques their interest.</p>
                
                <div class="aboutUsImageBackground center" style="display: none;">
                    <img src="<?= BASEURL; ?>uploads\images\back.png" class="aboutUsImage" alt="Image">
                    <p class="center" style="color: #f4e9dc; font-size: 2.5vw;">DoIndie Homescreen made by Janna Mari Elemen</p>
                </div><br>

                <hr>
                <hr>
                <h1 class="center">MADE BY ARTISTS, FOR ARTISTS</h1>
                <hr>
                <hr>

                <p class="center aboutUsTextJustify">In pursuit of providing service to its users, DoIndie offers a multitude of features that cater each of the individual user's needs. There are tools specifically for artists such as personalized profile portfolios, easily accessible catalogs, and even weekly sales analytics. Meanwhile, art enthusiasts are able to access multiple catalogs of original crafts, conveniently search for their preferred works, and be able to have safe and secure transactions.</p>    
                <p class="center aboutUsTextJustify">The name of the website “DoIndie” comes from the fact that showcasing both indie artists and indie art are its core focus. Filipino culture is showcased throughout the website's use of a branding of a category of Filipino fish dishes called “Daing.” Lastly, catering to the more “geeky” culture of the art world, the name also suggests a play on the acronym “DnD” which is a well-loved board game franchise filled to the brim with creativity.</p>
                <p class="center aboutUsTextJustify">Doindie catches the feeling of being in an art convention like; browsing catalogs of work, artists and fans talking about their fondness of creative content, cultivating a form of camaraderie with each other, etc. All the while the website translates these into the online world, letting its users connect with each other from anywhere at any time.</p> <br>
                
                <span class="aboutUsDevContainer1"></span>
                <span class="aboutUsDevContainer2"></span>
                <span class="aboutUsDevContainer3"></span>
                <span class="aboutUsDevContainer4"></span>
                </div>
            </div>
        </div>

        <div class="reportCenterDiv" style="display: none;">
            <h1 class="center" style="color: #f4e9dc; font-size: min(5vw, 72px);">Any Concerns?</h1>
            <form class="reportFormDiv" id="reportForm" method="post" action="html_homepage.html">
            <div class="row">
                <div style="margin-right: 25px; width: 100%;"> <input type="name" class="reportInput" id="repName" name="reportName" placeholder="Name"></div>
                <div style="width: 100%;"> <input type="email" class="reportInput" id="repEmail" name="reportEmail" placeholder="Email"></div>
            </div>
            <textarea class="reportInput" id="reportDesc" name="reportDescription" rows="5" placeholder="Message"></textarea>
            </form>
                <button class="inputButtonV1" style="font-size: min(3vw, 36px);" onclick="onClickReport()">Send</button>
        </div>

        <?php include 'app/views/footerView.php';?>

    </body>
</html>