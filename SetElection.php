<html>
    <body>
    <center>

        <?php
        session_start();
        if (!(isset($_SESSION['SocialSecNumber']))) {
            if ($_SESSION['SocialSecNumber'] != 'Admin') {
                header("Location:UnExpected.php?msg=Page is not available for you");
            }
        }
        include_once'Connection.php';
        date_default_timezone_set('Asia/Kolkata');
        if (isset($_POST['submit'])) {
            $chg = 0;
            date_default_timezone_set('Asia/Kolkata');
            $today = date("d-m-y H:i:s");
            $pattern = "/^([0-9][0-9])-([0-9][0-9])-([0-9][0-9]) ([0-9][0-9]):([0-9][0-9]):([0-9][0-9])$/";
            preg_match_all($pattern, $today, $match1);
            
        $current_result = $dbhandler->query("select * from history where current < 2");
        while ($r = $current_result->fetch()) {
            $end = $r['End'];
            $pattern = "/^[0-9][0-9]([0-9][0-9])-([0-9][0-9])-([0-9][0-9]) ([0-9][0-9]):([0-9][0-9]):([0-9][0-9])$/";
            preg_match_all($pattern, $end, $match2);
           if ($match2[3][0] <= $match1[1][0]) {
                if ($match2[3][0] < $match1[1][0]) {
                    $chg = 1;
                    $dbhandler->query("UPDATE `history` SET `Current` = '3' WHERE `history`.`Id` = " . $r['Id']);
                } else {
                    if ($match2[2][0] <= $match1[2][0]) {
                        if ($match2[2][0] < $match1[2][0]) {
                            $chg = 1;
                            $dbhandler->query("UPDATE `history` SET `Current` = '3' WHERE `history`.`Id` = " . $r['Id']);
                        } else {
                            if ($match2[1][0] <= $match1[3][0]) {
                                if ($match2[1][0] <= $match1[3][0]) {
                                    $chg = 1;
                                    $dbhandler->query("UPDATE `history` SET `Current` = '3' WHERE `history`.`Id` = " . $r['Id']);
                                } else {
                                    if ($match2[4][0] <= $match1[4][0]) {
                                        if ($match2[4][0] <= $match1[4][0]) {
                                            $chg = 1;
                                            $dbhandler->query("UPDATE `history` SET `Current` = '3' WHERE `history`.`Id` = " . $r['Id']);
                                        } else {
                                            if ($match2[5][0] <= $match1[5][0]) {
                                                if ($match2[5][0] <= $match1[5][0]) {
                                                    $chg = 1;
                                                    $dbhandler->query("UPDATE `history` SET `Current` = '3' WHERE `history`.`Id` = " . $r['Id']);
                                                } else {
                                                    if ($match2[6][0] <= $match1[6][0]) {
                                                        $chg = 1;
                                                        $dbhandler->query("UPDATE `history` SET `Current` = '3' WHERE `history`.`Id` = " . $r['Id']);
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
                    header("Location:SetElection.php");
                }
            }
            $ST = str_replace('T', ' ', $_POST["start"]);
            $ED = str_replace('T', ' ', $_POST["end"]);
            $ST = $ST . ":00";
            $ED = $ED . ":00";
            $sql = "INSERT INTO `history` (`Id`, `Start`, `End`, `Current`, `Result`) VALUES (NULL, '$ST', '$ED', '0', 'NULL');";
            $query = $dbhandler->query($sql);
            echo "Election set successfully.";
        }
        ?>
        <h1>Set an Election from here:</h1>
         Note: Choose your dates so that no two elections overlap.<br/> Overlapping of dates of election will lead to a system inconsistent state.<br/>
        <form action="" method="post">
            Start-Date:<input type="datetime-local" name="start" required=""><br/>
            End-Date:<input type="datetime-local" name="end" required=""><br/>
            <input type="submit" value="Set Election" name="submit"><br/>
           
            <a href="SuperUser.php"><input type="button" value="Back to Main Menu" name="Back to Main Menu" /></a>
            
        </form>
    </center>
</body>
</html>
