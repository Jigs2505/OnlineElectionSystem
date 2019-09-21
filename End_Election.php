<html>
    <?php
    error_reporting(0);
    session_start();
    if (!(isset($_SESSION['SocialSecNumber']))) {
        if ($_SESSION['SocialSecNumber'] != 'Admin') {
            header("Location:UnExpected.php?msg=Page is not available for you");
        }
    }
    if (isset($_POST['End'])) {
        include_once'Connection.php';
        $EID = $_POST['Id'];
        $query = "select * from history where Id = $EID and Current < '2'";
        $q = $dbhandler->query($query);
        if ($q->rowCount() == 0) {
            echo 'Any Live or waiting Election not found on this party ID';
        } else {
            $query = "UPDATE `history` SET `Current` = '2' WHERE `history`.`Id` = " . $EID;
            $q = $dbhandler->query($query);
            echo 'Election polls ended Successfully!';
        }
    }
    ?>
    <body>
    <center>
        <h1>End Election</h1>
        <form action="" method="post">
            Enter Election Id:<input type="number" name="Id">
            <input type="submit" value="End" name="End" /><br/>
            <?php
            include './Show_All_Elections.php';
            ?>
        </form>
    </center>
</body>
</html>