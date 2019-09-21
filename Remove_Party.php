<html>
    <body>
    <center>
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
            $query = "select * from party where PartyId = " . $_POST['PartyId'];
            $q = $dbhandler->query($query);
            if ($q->rowCount() == 0) {
                echo 'Party not found';
            } else {
                $query = "delete from candidate where PartyId = " . $_POST['PartyId'];
                $q = $dbhandler->query($query);
                $query = "delete from party where PartyId = " . $_POST['PartyId'];
                $q = $dbhandler->query($query);
                echo 'Party removed!';
            }
        }
        ?>
        <h1>Remove party</h1>
        Removing a party will remove all of the associated candidates.
        <form action="" method="post">
            Enter a Party Id to remove party:<input type="number" name="PartyId"/>
            <input type="submit" value="Remove" name="Remove" />
        </form>
        <?php
        include './Show_All_Parties.php';
        ?>
    </center>
</body>
</html>
