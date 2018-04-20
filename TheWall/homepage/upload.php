<?php
/*
if(!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "Je moet eerst inloggen";
    header('location: ../login.php');
}
*/
?>

<!DOCTYPE html>
<html>
<head>
    <title>The Wall/Upload</title>
</head>
<body>

   <form method="post" enctype="multipart/form-data">
       <?php include ('../server.php') ?>
       <label>Een foto upoaden:<input type="file" name="fileToUpload" id="fileToUpload"></label><br><br>
       <label>Titel:<input name="title" id="title"/></label><br><br>
       <label>Beschrijving:<input id="description" name="description"/></label><br><br>
       <input type="submit" name="submit_image" id="submit_image" value="Bestand uploaden"/>
   </form>
    <script src="script.js"></script>
</body>
</html>



