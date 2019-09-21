<html>
    <body>
        <?php
        session_start();
        if (!(isset($_SESSION['SocialSecNumber']))) {
            if ($_SESSION['SocialSecNumber'] != 'Admin') {
                header("Location:UnExpected.php?msg=Page is not available for you");
            }
        }
        if (!empty($_FILES["myFile"]["name"])) {
            //echo 'Here';
            $target_location = "C:/xampp/htdocs/img/party/" . $_FILES["myFile"]["name"];
            $PartyName = $_POST['PartyName'];
            $ext = pathinfo($target_location, PATHINFO_EXTENSION);
            if ($ext == "jpg") {
                if (!(move_uploaded_file($_FILES["myFile"]["tmp_name"], $target_location)))
                    echo "Error: " . $_FILES["myFile"]["error"] . "<br>";
                else {
                    //echo basename($target_location); 
                    //echo ($ext);
                    $new = "C:/xampp/htdocs/img/party/" . $PartyName . "." . $ext;
                    //echo $new;
                    rename($target_location, $new);
                    //header("Location:index.php?msg=Congrats $username, Your File is Successfully Uploaded.");
                }

                include_once'Connection.php';
                if (isset($_POST['submit'])) {
                    $PID = $_POST['PartyID'];
                    $PN = $_POST['PartyName'];
                    #$PL = $_POST['PartyLogo'];
                    $Mot = $_POST['Motto'];
                    $QUE = "select * from party where PartyId = " . $_POST['PartyID'];
                    $query = $dbhandler->query($QUE);
                    if ($query->rowCount() > 0)
                        echo 'A party with this PartyId already exist,Data is not inserted.';
                    else {
                        $sql = "insert into party values ('$PID','$PN','" . $PartyName . "','$Mot')";
                        $query = $dbhandler->query($sql);
                        echo "Data is inserted successfully";
                        //echo "The image is<br/>";
                        //echo '<img src = "../img/party/' . $PartyName . '.jpg" alt = "Image here">';
                    }
                }
            } 
            else {
                echo 'Image is nots jpg, Record not inserted';
            }
        }
        ?>
        <center>
        <h1>Party Registration</h1><br/>
        <form action='' method="post" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="5900000" />
            <table>
                <tr>
                    <td>PartyID</td>
                    <td>
                        <input type="number" name='PartyID' required="">
                    </td>
                </tr>
                <tr>
                    <td>Name of Party</td>
                    <td>
                        <input type="text" name='PartyName' required="">
                    </td>
                </tr>
                <tr>
                    <td>Party Logo: </td> <td colspan="2"><input type="file" name="myFile" id="myFile"></td>
                </tr>
                <tr>
                    <td>Motto of Party</td>
                    <td>
                        <input type="text" name='Motto' required="">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="submit" name="submit">
                    </td>
                </tr>
            </table>
        </form>
            <a href="SuperUser.php"><input type="button" value="Back to Main Menu" name="Back to Main Menu" /></a>
    </center>
</body>
</html>