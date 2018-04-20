<?php
session_start();

if(!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "Je moet eerst inloggen";
    header('location: ../login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../login.php");
}

$dbc = mysqli_connect('localhost','root','','thewallaccounts');
//$query = "SELECT imageTitle, imageDes, imageTarget FROM images";
$query = "SELECT imageTitle, imageDes, imageTarget FROM images ORDER BY idImage";

$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<h1 style="text-align:center;">The Wall</h1>
	</header>
	<nav>
		<ul id="nav">
		  <li><a href="homepage.html">Home</a></li>
		  <li><a href="news.html">News</a></li>
		  <li><a href="contact.html">Contact</a></li>
		  <li><a href="about.html">About</a></li>
		  
		  <?php  if (isset($_SESSION['username'])) : ?>
		  <a href="index.php?logout='1'"><img src="icons/logout.png" class="icons" title="Uitloggen"></a>
		  <p style="display: inline; margin-left: 150px; color: rgb(99, 33, 255);">Welkom <strong><?php echo $_SESSION['username']; ?> </strong></p>
		  <?php endif ?>
		  
		  <img href="profile.html" src="icons/viewprofile.png" class="icons">
		  <a href="upload.php"><img src="icons/addphoto.png" class="icons"></a>
		</ul>
	</nav>
	
	
	<!--Voorbeeld-->
	<section id="images">
        <div>       <?php //var_dump($result);
        while($row = $result->fetch_assoc()){
            //echo $imgSrc = $row['imageTarget'];
            /*echo '<div id="myImage"></div>';
            echo '<div class="myImage" style="background-image:url(\'<?php echo rowhttp://placehold.it/1900x1080&text=Slide One\');"></div>'*/;

            $image = $row['imageTarget'];
            $imageData = base64_encode(file_get_contents($image));
            echo '<img id="myImage" src="data:image/jpeg;base64,'.$imageData.'">';
        }


        ?> </div>
	</section>
	
	
	
	
	<!--<a href="profiel.html">
	  <img src="images/profileicon.png" alt="Profiel" style="float:right; width:75px; height:75px;">
	</a>

	<a href="fotomaken
	.html">
	  <img src="images/camera.png" alt="Profiel" style="float:right; width:75px; height:75px;">
	</a>-->

	<script>

        var myImage = document.getElementById("myImage");
		window.onscroll = function() {myFunction()};


		var nav = document.getElementById("nav");


		var myOffset = nav.offsetTop;


		function myFunction() {
		  if (window.pageYOffset >= myOffset) {
			nav.classList.add("sticky")
		  } else {
			nav.classList.remove("sticky");
		  }
		}


		var img = document.getElementById();

	</script>

	<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
            <h3>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
   
    
     
    <?php endif ?>
	</div>
</body>
</html>
