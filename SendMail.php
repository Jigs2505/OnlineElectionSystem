<html>

    <head>
        <title>Sending HTML email</title>
    </head>

    <body>

        <?php
        session_start();


        $a = rand(100, 999999);
        //echo $a;
        $_SESSION["random"] = $a;
        $email = $_SESSION['Email'];
        require 'phpmailer/PHPMailerautoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'pmpparmar1133@gmail.com';
        $mail->Password = 'Parth@1234';
        $mail->setFrom('pmpparmar1133@gmail.com');
        $mail->addAddress($email);
        $mail->addReplyTo('pmpparmar1133@gmail.com');
        $mail->isHTML(false);
        $mail->Subject = "Online Voting Verification";
        $mail->Body = "Your OTP is: $a, Please do not share with anyone.";
        if (!$mail->send()) {
            echo 'Message could not be sent!';
        } else {
            echo 'Mail sent';
            include './VerifyEmail.php';
        }
        ?>

    </body>
</html>				