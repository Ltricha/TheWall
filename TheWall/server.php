<?php
session_start();
$username = "";
$email = "";
$errors = array();

//connectie maken met database
$dbc = mysqli_connect('localhost','root', '', 'thewallaccounts') or die('error connecting');


//REGISTREER GEBRUIKER, maar eerst kijken of er problemen zijn
if(isset($_POST['reg_user'])){
    //haal gegevens uit de post array
    $username = mysqli_real_escape_string($dbc, $_POST['username']);
    $email = mysqli_real_escape_string($dbc, $_POST['email']);
    $password_1 = mysqli_real_escape_string($dbc, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($dbc, $_POST['password_2']);

    //Kijk of de formulier correct is ingevuld
    //Bij het toevoegen van (array_push()) bij fouten
    if(empty($username)){ array_push($errors, "Voer een gebruikersnaam in");}
    if(empty($email)){ array_push($errors, "Voer een emailadres in");}
    if(empty($password_1)){ array_push($errors, "Voer een wachtwoord in");}
    if($password_1 != $password_2){
        array_push($errors, "De wachtwoorden komen niet overeen.");
    }
    //Checkt de database om te kijken of er al een gebruiker bestaat met de
    //zelfde gebruikersnaam en/of emailadres
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    //User check uitvoeren
    $result = mysqli_query($dbc, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if($user){//Als gebruiker bestaat
        if($user['username'] === $username){
            array_push($errors, "Deze gebruikersnaam bestaat al");
        }

        if($user['email'] === $email){
            array_push($errors, "Deze emailadres bestaat al");
        }
    }
    //Registreer de gebruiker als er geen errors zijn in het formulier
	//Nu kunnen we de gebruiker eindelijk zonder problemen aan de database toevoegen
    if(count($errors) == 0){
        $password = hash('sha512', $password_1);//Hasht wachtwoord voor veiligheid

        //opdracht query schrijven voor de database
        $query = "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$password')";
        //query uitvoeren
        mysqli_query($dbc, $query) or die("error querying");

        $_SESSION['username'] = $username;
        $_SESSION['succes'] = "U bent nu ingelogd";
		//verstuur naar de homepage :)
        header('location: homepage/index.php');
    }
}

    //Kijkt of er problemen zijn
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($dbc, $_POST['username']);
    $password = mysqli_real_escape_string($dbc, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Voer een gebruikersnaam in");
    }
    if (empty($password)) {
        array_push($errors, "Voer een wachtwoord in");
    }
		//zonder problemen inloggen :D
    if (count($errors) == 0) {
        $password = hash('sha512', $password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($dbc, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "U bent nu ingelogd.";

            header('location: homepage/index.php');

			//een hacker mag nooit weten of de gebruikersnaam of wachtwoord fout is
        }else {
            array_push($errors, "Verkeerde gebruikersnaam/wachtwoord combinatie");
        }
    }
}


//FOTO UPLOADEN
if(isset($_POST['submit_image'])) {

    $imageTitle = $_POST['title'];
    $imageDes = $_POST['description'];


    $target_dir = 'images/';
    $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $imageTarget = $target_file;

    //kijkt of het een afbeelding is
    $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
    if ($check !== false) {
        echo "Dit is een foto";
        $uploadOk = 1;
    } else {
        echo "Dit is niet een foto";
        $uploadOk = 0;
    }


    if (file_exists($target_file)) {
        echo "Sorry, dit bestand bestaat al.";
        $uploadOk = 0;
    }

    if ($_FILES['fileToUpload']['size'] >= 10000000) {
        echo "Sorry, dit bestand is te groot.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, alleen JPG, PNG, JPEG en GIF zijn toegestaan.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, uw bestand kon niet upgeloaden worden.";
    } else {
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
            //include('homepage/index.php');
            echo "Het bestand " . basename($_FILES['fileToUpload']['name']) . " is geupload.";
            $_SESSION['image'] = $target_file;
            header('location: index.php');
            $query = "INSERT INTO images VALUES(0,'$imageTitle', '$imageDes', '$imageTarget')";
            mysqli_query($dbc, $query) or die("error querying");
        } else {
            echo 'Sorry, er was een fout bij het upload van uw bestand';
        }
    }
}


?>

