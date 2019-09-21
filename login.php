<html>
    <head>
         <script>
            var hov = new Audio();
            hov.src = 'hover.mp3';
        </script>
        <script>
            var cli = new Audio();
            cli.src = 'click.mp3';
        </script>
        <title>Login Form</title>
        <link rel="stylesheet" type="text/css" href="CSS/style_Login.css">
    </head>
    <body>
        <?php
        include_once'Connection.php';



        $QUE = "select * from history where current = '1'";
        $query = $dbhandler->query($QUE);
        if ($query->rowCount() > 1) {
            header("Location:UnExpected.php?msg=Databases are in inconsistent state, Website is not in proper condition to operate.Contact administrator to maintain and service");
        }
        $chg = 0;
        date_default_timezone_set('Asia/Kolkata');
        $today = date("d-m-y H:i:s");
        $pattern = "/^([0-9][0-9])-([0-9][0-9])-([0-9][0-9]) ([0-9][0-9]):([0-9][0-9]):([0-9][0-9])$/";
        preg_match_all($pattern, $today, $match1);
        $waiting_current = $dbhandler->query("select * from history where current = 0");
        while ($r = $waiting_current->fetch()) {
            $start = $r['Start'];

            $pattern = "/^[0-9][0-9]([0-9][0-9])-([0-9][0-9])-([0-9][0-9]) ([0-9][0-9]):([0-9][0-9]):([0-9][0-9])$/";
            preg_match_all($pattern, $start, $match2);
            if ($match2[3][0] <= $match1[1][0]) {
                if ($match2[3][0] < $match1[1][0]) {
                    $chg = 1;
                    $dbhandler->query("UPDATE `history` SET `Current` = '1' WHERE `history`.`Id` = " . $r['Id']);
                } else {
                    if ($match2[2][0] <= $match1[2][0]) {
                        if ($match2[2][0] < $match1[2][0]) {
                            $chg = 1;
                            $dbhandler->query("UPDATE `history` SET `Current` = '1' WHERE `history`.`Id` = " . $r['Id']);
                        } else {
                            if ($match2[1][0] <= $match1[3][0]) {
                                if ($match2[1][0] <= $match1[3][0]) {
                                    $chg = 1;
                                    $dbhandler->query("UPDATE `history` SET `Current` = '1' WHERE `history`.`Id` = " . $r['Id']);
                                } else {
                                    if ($match2[4][0] <= $match1[4][0]) {
                                        if ($match2[4][0] <= $match1[4][0]) {
                                            $chg = 1;
                                            $dbhandler->query("UPDATE `history` SET `Current` = '1' WHERE `history`.`Id` = " . $r['Id']);
                                        } else {
                                            if ($match2[5][0] <= $match1[5][0]) {
                                                if ($match2[5][0] <= $match1[5][0]) {
                                                    $chg = 1;
                                                    $dbhandler->query("UPDATE `history` SET `Current` = '1' WHERE `history`.`Id` = " . $r['Id']);
                                                } else {
                                                    if ($match2[6][0] <= $match1[6][0]) {
                                                        $chg = 1;
                                                        $dbhandler->query("UPDATE `history` SET `Current` = '1' WHERE `history`.`Id` = " . $r['Id']);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if ($chg == 1) {
                $MyQuery1 = $dbhandler->query("UPDATE `candidate` SET `Votes` = '0'");
                $MyQuery1 = $dbhandler->query("UPDATE `citizen` SET `Voted` = '0'");
                $MyQuery1 = $dbhandler->query("UPDATE `history` SET `Current` = '3' WHERE `history`.`Current` = '2'");
                header("Location:Login.php");
            }
        }
        $current_result = $dbhandler->query("select * from history where current = 1");
        while ($r = $current_result->fetch()) {
            $end = $r['End'];
            $pattern = "/^[0-9][0-9]([0-9][0-9])-([0-9][0-9])-([0-9][0-9]) ([0-9][0-9]):([0-9][0-9]):([0-9][0-9])$/";
            preg_match_all($pattern, $end, $match2);
            if ($match2[3][0] <= $match1[1][0]) {
                if ($match2[3][0] < $match1[1][0]) {
                    $chg = 1;
                    $dbhandler->query("UPDATE `history` SET `Current` = '2' WHERE `history`.`Id` = " . $r['Id']);
                } else {
                    if ($match2[2][0] <= $match1[2][0]) {
                        if ($match2[2][0] < $match1[2][0]) {
                            $chg = 1;
                            $dbhandler->query("UPDATE `history` SET `Current` = '2' WHERE `history`.`Id` = " . $r['Id']);
                        } else {
                            if ($match2[1][0] <= $match1[3][0]) {
                                if ($match2[1][0] <= $match1[3][0]) {
                                    $chg = 1;
                                    $dbhandler->query("UPDATE `history` SET `Current` = '2' WHERE `history`.`Id` = " . $r['Id']);
                                } else {
                                    if ($match2[4][0] <= $match1[4][0]) {
                                        if ($match2[4][0] <= $match1[4][0]) {
                                            $chg = 1;
                                            $dbhandler->query("UPDATE `history` SET `Current` = '2' WHERE `history`.`Id` = " . $r['Id']);
                                        } else {
                                            if ($match2[5][0] <= $match1[5][0]) {
                                                if ($match2[5][0] <= $match1[5][0]) {
                                                    $chg = 1;
                                                    $dbhandler->query("UPDATE `history` SET `Current` = '2' WHERE `history`.`Id` = " . $r['Id']);
                                                } else {
                                                    if ($match2[6][0] <= $match1[6][0]) {
                                                        $chg = 1;
                                                        $dbhandler->query("UPDATE `history` SET `Current` = '2' WHERE `history`.`Id` = " . $r['Id']);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if ($chg == 1) {
                header("Location:Login.php");
            }
        }
        if (isset($_POST['SocialSecNumber'])) {
            $SSN = $_POST['SocialSecNumber'];
            if ($SSN == "Admin" && $_POST['password'] == "Admin") {
                session_start();
                $_SESSION['UName'] = $R['UserName'];
                $_SESSION['Region'] = $R['Region'];
                $_SESSION['SocialSecNumber'] = $SSN;
                header("Location:SuperUser.php");
            }


            $QUE = "select * from citizen where SocialSecNumber = $SSN";

            $query = $dbhandler->query($QUE);
            if ($query->rowCount() == 1) {
                $R = $query->fetch();
                $QUE = "select * from history where current = '1'";
                $query = $dbhandler->query($QUE);
                if ($query->rowCount() > 1) {
                    header("Location:UnExpected.php?msg=Databases are in inconsistent state, Website is not in proper condition to operate.Contact administrator to maintain and service");
                } else if ($query->rowCount() == 0) {
                    header("Location:UnExpected.php?msg=There are no currently ongoing elections.");
                } else if ($_POST['password'] == $R['Password']) {
                    session_start();
                    if ($_POST['vercode1'] != $_SESSION['vercode'] OR $_SESSION['vercode'] == '') {
                        echo '<strong>Incorrect verification code.</strong>';
                    } else {
                        // add form data processing code here

                        $q1 = "select * from citizen where SocialSecNumber='" . $SSN . "'";
                        $que1 = $dbhandler->query($q1);
                        $r = $que1->fetch();
                        echo $r['Voted'];
                        if ($r['Voted'] == '0') {
                            $q2 = "update citizen set Voted='0' where SocialSecNumber='" . $SSN . "'";
                            $que2 = $dbhandler->query($q2);
                            session_start();
                            $_SESSION['UName'] = $R['UserName'];
                            $_SESSION['Region'] = $R['Region'];
                            $_SESSION['SocialSecNumber'] = $SSN;
                            header("Location:voting.php");
                        } else {
                            header("Location:UnExpected.php?msg=System shows you have already voted, if not, please contact administrators about this event..");
                        }
                    }
                } else {
                    echo 'Social Sec Number or Password is incorrect.';
                }
            } else {
                echo 'Enter a valid Social security number';
            }
        }
        ?>



        <div class="loginbox">
            <img src="vote.jpg" class="avatar">
            <h1><label>Login</label></h1>    
            <form action="" method="post">
                <p><label>Social Security Number</label></p>
                <input type="Text" name="SocialSecNumber" placeholder="Enter Number" required="">
                <p><label>Password</label></p>
                <input type="password" name="password" placeholder="Enter Password" required="">
                Enter Code <img src="captcha.php">
                <input type="text" name="vercode1" />
                <input type="submit" name="login" value="Login" onmouseover="hov.play();" onmousedown="cli.play()"><br>
                <a href="home.php" onmouseover="hov.play();" onmousedown="cli.play()"><input type="button" value="Home" name="Home" /></a>
            </form>
        </div>


    </body>
</html>
