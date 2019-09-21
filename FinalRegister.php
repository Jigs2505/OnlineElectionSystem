<html>

    <head>
        <title>Sending HTML email using PHP</title>
    </head>

    <body>

        <?php
        session_start();
        include_once'Connection.php';
        $email = $_SESSION["Email"];
        $passw = $_SESSION["Pass"];
        $veri_code = $_POST["code"];
        if ($_SESSION['random'] == $veri_code) {
            $SSN = $_SESSION['SSN'];
            $UN = $_SESSION['UN'];
            $Pass = $_SESSION['Pass'];
            $Email = $_SESSION['Email'];
            $Reg = $_SESSION['Reg'];
            $sql = "INSERT INTO `citizen` (`SocialSecNumber`, `UserName`, `Password`, `Email`, `Region`, `Voted`) VALUES ('$SSN', '$UN', '$Pass', '$Email', '$Reg', '0');";
            $query = $dbhandler->query($sql);

            echo"Successfully Registered";
            include ('Login.php');
        } else {
            echo "You have entered something wrong";
        }
        ?>

    </body>
</html>						