<html>
    <link rel="stylesheet" type="text/css" href="CSS/style_RegCit.css">
    <body>
        <?php
        session_start();
        if (!(isset($_SESSION['SocialSecNumber']))) {
            if ($_SESSION['SocialSecNumber'] != 'Admin') {
                header("Location:UnExpected.php?msg=Page is not available for you");
            }
        }
        $Areas = array(
            array("Gujarat", "Bhavnagar", "Rajkot", "Gandhinagar"),
            array("Maharashtra", "Mumbai", "Pune", "Nashik"),
            array("Rajasthan", "Udaipur", "Jodhpur", "Ajmer")
        );
        
        if (isset($_POST['submit'])) {
            include_once'Connection.php';
            $check = 0;
            foreach ($Areas as $SpecificArea) {
                foreach ($SpecificArea as $value) {
                    if ($value == $_POST['Reg']) {
                        $check = 1;
                    }
                }
            }
            if ($check == 1) {
                session_start();
                $SSN = $_POST['SSN'];
                $UN = $_POST['UName'];
                $Pass = $_POST['UPass'];
                $Email = $_POST['email'];
                $Reg = $_POST['Reg'];
                $QUE = "select * from citizen where socialsecnumber = " . $_POST['SSN'];
                $query = $dbhandler->query($QUE);
                if ($query->rowCount() > 0)
                    echo 'This Social security number is already a registered citizen.';
                else {
                    $_SESSION['SSN'] = $SSN;
                    $_SESSION['UN'] = $UN;
                    $_SESSION['Pass'] = $Pass;
                    $_SESSION['Email'] = $Email;
                    $_SESSION['Reg'] = $Reg;
                    header("Location:SendMail.php");
                    //echo "The image is<br/>";
                    //echo '<img src = "../img/party/' . $PartyName . '.jpg" alt = "Image here">';
                }
            } else {
                echo 'Region not found check spelling and try again, contact administrators if required';
            }
        }
        ?>
    <center>
        <div class = "main">
            <div class="Heading">
                <h1>Citizen Registration</h1>
            </div>
            <form action='' method="post">
                <div class="container">
                    <h1>Sign Up</h1>
                    <p>Please fill in this form to register yoursSelf.</p>
                    <hr>
                    <label for="ssn"><b>Social Security Number:</b></label>
                    <input type="text" placeholder="Enter Social Security Number" name='SSN' required="">
                    <label for="name"><b> Name:</b></label>
                    <input type="text" placeholder="Enter Name" name='UName' required="">
                    <label for="pass"><b>Password:</b></label>
                    <input type="password" placeholder="Enter Password" name='UPass' required="">

                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" required>

                    <label for="region"><b>Region:</b></label>
                    <input type="text" placeholder="Enter Region" name='Reg' required="">
                    <div class="clearfix">
                        <a href="home.php"><button type="button" class="cancelbtn">Cancel</button></a>
                        <button type="submit" class="signupbtn" name="submit">Sign Up</button>
                    </div>

                </div>
            </form>
        </div>
    </center>
</body>
</html>