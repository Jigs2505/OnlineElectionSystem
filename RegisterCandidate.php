<?php
include_once'Connection.php';
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

if (isset($_POST['submit1'])) {
    $QUE = "select * from party where PartyId = " . $_POST['PartyID'];
    $query = $dbhandler->query($QUE);
    if ($query->rowCount() == 0)
        echo 'This party does not exist,Data is not inserted.';
    else {

        if (isset($_POST['District'])) {
            $DT = $_POST['District'];
        }
        if (isset($_POST['State'])) {
            $ST = $_POST['State'];
        }
        if (isset($_POST['HierarchyLevel'])) {
            $HL = $_POST['HierarchyLevel'];
        }
        if (isset($_POST['FName'])) {
            $FN = $_POST['FName'];
        }
        if (isset($_POST['LName'])) {
            $LN = $_POST['LName'];
        }
        if (isset($_POST['PartyID'])) {
            $PID = $_POST['PartyID'];
        }

        if (!empty($_FILES["myFile"]["name"])) {

            $target_location = "C:/xampp/htdocs/img/candidate/" . $_FILES["myFile"]["name"];
            $FirstName = $_POST['FName'];
            $LastName = $_POST['LName'];
            $ext = pathinfo($target_location, PATHINFO_EXTENSION);
            if ($ext == "jpg") {
                if (!(move_uploaded_file($_FILES["myFile"]["tmp_name"], $target_location)))
                    echo "Error: " . $_FILES["myFile"]["error"] . "<br>";
                else {
                    //echo basename($target_location); 
                    //echo ($ext);
                    $new = "C:/xampp/htdocs/img/candidate/" . $FirstName . $LastName . "." . $ext;
                    //echo $new;
                    rename($target_location, $new);
                    //header("Location:index.php?msg=Congrats $username, Your File is Successfully Uploaded.");
                }
                if ($HL == "District") {
                    $QUE = "select * from candidate where PartyId = '" . $_POST['PartyID'] . "' && Region = '" . $DT . "' && hierarchylevel = '" . $HL . "'";
                    $query = $dbhandler->query($QUE);
                    if ($query->rowCount() > 0) {
                        echo 'This Candidate already exist, Your data is not inserted';
                    } else {
                        $sql = "insert into candidate values ('$HL','$PID','$FN','$LN','$FirstName" . $LastName . "','$DT','$ST',0)";
                        $query = $dbhandler->query($sql);
                        echo "Data is inserted successfully";
                        
                    }
                }
                if ($HL == "State") {
                    $QUE = "select * from candidate where PartyId = '" . $_POST['PartyID'] . "' && Region = '" . $ST . "' && hierarchylevel = '" . $HL . "'";
                    $query = $dbhandler->query($QUE);
                    if ($query->rowCount() > 0) {
                        echo 'This Candidate already exist, Your data is not inserted';
                    } else {
                        $sql = "insert into candidate values ('$HL','$PID','$FN','$LN','$FirstName" . $LastName . "','$ST','India',0)";
                        $query = $dbhandler->query($sql);
                        echo "Data is inserted successfully";
                    }
                }
                if ($HL == "Center") {
                    $QUE = "select * from candidate where PartyId = '" . $_POST['PartyID'] . "' && Region = 'India' && hierarchylevel = '" . $HL . "'";
                    $query = $dbhandler->query($QUE);
                    if ($query->rowCount() > 0) {
                        echo 'This Candidate already exist, Your data is not inserted';
                    } else {
                        $sql = "insert into candidate values ('$HL','$PID','$FN','$LN','$FirstName" . $LastName . "','India','" . NULL . "',0)";
                        $query = $dbhandler->query($sql);
                        echo "Data is inserted successfully";
                        //echo $FirstName . $LastName;
                        //echo'.jpg" alt = "Image here">';
                    }
                }
            } else {
                echo 'Image is not jpg, Record not inserted';
            }
        }
    }
}
?>
<html>
    <body><center>
        <form action="" method="POST">
            <h1>Hierarchy Level of Candidate</h1>
            Select Level:
            <select name="HierarchyLevel">
                <option value="Center" <?php
                if (isset($_POST['HierarchyLevel'])) {
                    if ($_POST['HierarchyLevel'] == 'Center') {
                        echo 'selected';
                    }
                }
                ?> onclick= this.form.submit()>
                    Center
                </option>
                <option value="State" <?php
                if (isset($_POST['HierarchyLevel'])) {
                    if ($_POST['HierarchyLevel'] == 'State') {
                        echo 'selected';
                    }
                }
                ?> onclick= this.form.submit()>
                    State
                </option>
                <option value="District" <?php
                if (isset($_POST['HierarchyLevel'])) {
                    if ($_POST['HierarchyLevel'] == 'District') {
                        echo 'selected';
                    }
                }
                ?> onclick= this.form.submit()>
                    District
                </option>
            </select>
        </form>
        <?php
        if (isset($_POST['HierarchyLevel'])) {
            $HL = $_POST['HierarchyLevel'];
            if ($HL == "State" || $HL == "District") {
                echo '<form action="" method="POST">';
                echo "<input type='hidden' name='HierarchyLevel' value='$HL'>";
                echo 'Select State:<select name="State">';
                for ($i = 0; $i < 3; $i++) {
                    $temp = $Areas[$i][0];
                    echo "<option value='$temp'";
                    if (isset($_POST['State'])) {
                        if ($_POST['State'] == $temp) {
                            echo 'selected';
                        }
                    }
                    echo " onclick=this.form.submit()>" . $temp . "</option>";
                }
                echo "</select>";
                echo '</form>';
            }

            if ($HL == "District" && isset($_POST['State'])) {
                $ST = $_POST['State'];
                echo '<form action="" method="POST">';
                echo "<input type='hidden' name='HierarchyLevel' value='$HL'>";
                echo "<input type='hidden' name='State' value='$ST'>";
                for ($i = 0; $i < 3; $i++) {
                    if ($Areas[$i][0] == $_POST['State']) {
                        break;
                    }
                }
                echo 'Select District:<select name="District">';
                for ($j = 1; $j < 4; $j++) {
                    $temp = $Areas[$i][$j];
                    echo "<option value=$temp";
                    if (isset($_POST['District'])) {
                        if ($_POST['District'] == $temp) {
                            echo ' selected ';
                        }
                    } echo " onclick=this.form.submit()>$temp</option>";
                }
                echo "</select>";

                echo '</form>';
            }
            if (($HL == "State" && isset($_POST['State'])) || ($HL == "District" && isset($_POST['District'])) || $HL == "Center") {
                echo '<form action="" method="POST" enctype="multipart/form-data">';
                if (isset($_POST['District'])) {
                    $DT = $_POST['District'];
                    echo "<input type='hidden' name='District' value='$DT'>";
                }
                echo "<input type='hidden' name='HierarchyLevel' value='$HL'>";
                if (isset($_POST['State'])) {
                    $ST = $_POST['State'];
                    echo "<input type='hidden' name='State' value='$ST'>";
                }
                echo "First Name:   <input type='text' name='FName' required=''><br/>
                      Last Name:    <input type='text' name='LName' required=''><br/>
                      Party ID:    <input type='number' name='PartyID' required=''><br/>
                      Passport Size photo:  <input type='file' name='myFile' id='myFile'><br/>
                      <input type='submit' value='submit1' name='submit1'></table>
                      </form>";
            }
        }
        ?>
            <a href="SuperUser.php"><input type="button" value="Back to Main Menu" name="Back to Main Menu" /></a>
    </center>
</body>
</html>
