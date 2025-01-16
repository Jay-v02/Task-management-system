<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'config.php';

    session_start();

    $title = $_POST['title'];
    $desc = $_POST['description'];
    $priority = $_POST['priority'];
    $date = $_POST['deadline'];
    $status = $_POST['status'];
    $assignedto = $_POST['assignedTo'];
    $createdby = $_SESSION["id"];

    $query = "INSERT INTO `task`(`title`, `description`, `priority`, `deadline`, `task_status`, `assigned_to`, `created_by`, `created_at`) VALUES ('$title','$desc','$priority','$date','$status','$assignedto','$createdby',current_timestamp())";
    $result = mysqli_query($conn, $query);

    $mailSMTPresult = mysqli_query($conn, "SELECT * FROM users WHERE id = $assignedto");
    $num =  mysqli_num_rows($mailSMTPresult);
    if ($num = 1) {
        while ($row = mysqli_fetch_assoc($mailSMTPresult)) {
            print_r($row);
            try {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'vizion.jayv@gmail.com';                     //SMTP username
                $mail->Password   = 'czomfhjvolxuvixf';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('vizion.jayv@gmail.com',);
                $mail->addAddress($row['email'], $row['name']);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'New task assign to you';
                $mail->Body    = "name: $assignedto</br> title: $title </br> description: $desc</br>DeadLine: $date ";

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }

    // if ($result) {

    //     header("Location: ../../task.php");
    // } else {
    //     echo ' error';
    // }
}
