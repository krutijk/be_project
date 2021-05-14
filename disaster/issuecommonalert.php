<?php
$conn = mysqli_connect("localhost", "root", "", "disaster");
date_default_timezone_set("Asia/Calcutta");
$calamity = trim($_POST['calamity']);
$state = trim($_POST['state']);
$description = trim($_POST['description']);
$entryby = "People";
$date = date("Y/m/d");
$time = date("h:i:sa");

$query = "INSERT INTO alerts(calamity, state, description, entryby, date, time) VALUES ('$calamity', '$state', '$description', '$entryby', '$date', '$time');";
$result = mysqli_query($conn, $query);

if(!$result) {
    echo "<script>alert('Insertion Failed. Please retry!');
          window.location.href='./issuecommonalert.html';
        </script>";
}

else {
    echo "<script>alert('Alert issued successfully!');
          window.location.href='./index.html';
        </script>";
}

    require_once "./PHPMailer/src/Exception.php";
    require_once "./PHPMailer/src/PHPMailer.php";
    require_once "./PHPMailer/src/SMTP.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail  = new PHPMailer(true);
    $addressquery = "SELECT email FROM subscribers";
    $address = mysqli_query($conn, $addressquery);
    $address = mysqli_fetch_assoc($address);
    $body  = 'A Common Alert has been issued. There is a '.$calamity.' occuring in '.$state.'. Take the precautionary measures immediately.';
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'floodforecastingsystem@gmail.com';                     // SMTP username
        $mail->Password   = 'Kruti@32kunverji';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('floodforecastingsystem@gmail.com');
        while (list ($key, $val) = each($address)) {
          foreach ($conn->query($addressquery) as $row) {
            $mail->addBCC($row['email']);
          }
        }
        // $mail->addAddress($email);

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Common Alert';
        $mail->Body    = $body;

        $mail->send();
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
?>