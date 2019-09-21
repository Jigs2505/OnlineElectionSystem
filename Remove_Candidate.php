<html>
    <body><center>
        <?php
        error_reporting(0);
        session_start();
        if (!(isset($_SESSION['SocialSecNumber']))) {
            if ($_SESSION['SocialSecNumber'] != 'Admin') {
                header("Location:UnExpected.php?msg=Page is not available for you");
            }
        }
        if (isset($_POST['Remove'])) {
            include_once'Connection.php';
            $query = "select * from candidate where Region='" . $_POST['Region'] . "' and PartyId=" . $_POST['PartyId'];
            $q = $dbhandler->query($query);
            if ($q->rowCount() == 0) {
                echo 'Candidate not found';
            } else {
                $query = "delete from candidate where Region='" . $_POST['Region'] . "' and PartyId=" . $_POST['PartyId'];
                $q = $dbhandler->query($query);
                echo 'Canmdidate removed!';
            }
        }
        ?>
        <h1>Remove candidate</h1>
        <form action="" method="post">
            Enter a Candidate PartyId:<input type="number" name="PartyId"/>
            Enter a Region:<input type="text" name="Region"/>
            <input type="submit" value="Remove" name="Remove" />
        </form><br/>
        <?php
        include './Show_All_Candidates.php';
        ?>
    </center>
</body>
</html>

