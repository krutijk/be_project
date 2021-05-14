<?php

$conn = mysqli_connect("localhost", "root", "", "disaster");

$email = trim($_POST['email']);
$password = trim($_POST['password']);

if($email == "" OR $password == ""){
	echo "<script>
			alert('email or Password empty!');
			window.location.href='index.php';
  		  </script>";
}

$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

$query = "SELECT email, password FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);
if(!$result){
	echo "<script>alert('Empty data');
			window.location.href='index.php';
	 	  </script>;";
}
$row = mysqli_fetch_assoc($result);
$role = $row['role'];
if($email != $row['email'] OR $password != $row['password']){
	echo "<script>
			alert('Email and Password Mismatch. Please fill again!');
			window.location.href='index.php';
		  </script>";
}

else{
	header("Location: ./issuegovermentalert.html");
}
?>