<html>
    <link rel="stylesheet" type="text/css" href="CSS/Show_All_Style.css">
    <body><center>
        <?php
        include_once'Connection.php';
        session_start();
        if (!(isset($_SESSION['SocialSecNumber']))) {
            if ($_SESSION['SocialSecNumber'] != 'Admin') {
                header("Location:UnExpected.php?msg=Page is not available for you");
            }
        }
        $query = "select * from candidate order by PartyId";
        $q = $dbhandler->query($query);
        ?>
        <header><h1><b>Registered candidates are :</b></h1></header>
        <table>
            <tr><th>HierarchyLevel</th>
                <th>PartyId</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Region</th>
                <th>PartyId</th>
                <th>Under</th>
                <th>Votes</th>
            </tr>
            <?php
            while ($r = $q->fetch()) {
                echo"<tr><td>"
                . $r['HierarchyLevel'] . "</td><td>" . $r['PartyId'] . "</td><td>" . $r['FirstName'] . "</td><td>" . $r['LastName'] . "</td><td>"
                . $r['Region'] . "</td><td>" . $r['PartyId'] . "</td><td>" . $r['Under'] . "</td><td>" . $r['Votes'] . "</td></tr>";
            }
            ?>

        </table><div class="footer">
        <a href="Remove_Candidate.php"><input type="button" value="Remove a Candidate" name="Remove a Candidate" /></a>
        <a href="SuperUser.php"><input type="button" value="Back to Main Menu" name="Back to Main Menu" /></a></div>
    </center>
</body>
</html>