<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'crud');

//  variabelen die we gebruiken
//  starten bij id 0 

	$name = "";
	$address = "";
    $id = 0;
    $update = false;


// als de input velden ingevuld zijn en er op "save" gedrukt wordt dan wordt er een nieuw record aangemaakt in de database 

	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$address = $_POST['address'];

		mysqli_query($db, "INSERT INTO info (name, address) VALUES ('$name', '$address')"); 
		$_SESSION['message'] = "Address saved"; 
		header('location: index.php');
    }
    
// als de input velden ingevuld zijn en er op "update" gedrukt wordt dan wordt de informatie met het bijbehorende 'id' aangepast (geupdate)

    if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$address = $_POST['address'];

	mysqli_query($db, "UPDATE info SET name='$name', address='$address' WHERE id=$id");
	$_SESSION['message'] = "Address updated!"; 
	header('location: index.php');
    }
    

// men kan er ook voor kiezen om een 'record' te deleten en dat gebeurd met de onderstaande query

    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM info WHERE id=$id");
        $_SESSION['message'] = "Address deleted!"; 
        header('location: index.php');
    }

