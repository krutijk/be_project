<?php

$conn = mysqli_connect("localhost", "root", "", "disaster");

$fname = trim($_POST['fname']);
$email = trim($_POST['email']);

$query = "INSERT INTO subscribers(ID, fname, email) VALUES ('', '$fname', '$email');";
$result = mysqli_query($conn, $query);

if(!$result) {
    echo "<script>alert('Insertion Failed. Please retry!');
          window.location.href='./index.html';
        </script>";
}

else {
    echo "<script>alert('Registered successfully!');
          window.location.href='./index.html';
        </script>";
}
?>