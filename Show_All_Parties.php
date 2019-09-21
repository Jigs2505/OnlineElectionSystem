<html>
    <link rel="stylesheet" type="text/css" href="CSS/Show_All_Style.css">
    <body>
        <center>
        <?php
        include_once'Connection.php';
        session_start();
        if (!(isset($_SESSION['SocialSecNumber']))) {
            if ($_SESSION['SocialSecNumber'] != 'Admin') {
                header("Location:UnExpected.php?msg=Page is not available for you");
            }
        }
        $query = "select * from party";
        $q = $dbhandler->query($query);
        ?>
        <header><h1><b>Registered parties are :</b></h1></header>
        <table>
            <tr>
                <th>PartyId</th>
                <th>PartyName</th>
                <th>Motto</th>
                
            </tr>
            <?php
                while($r=$q->fetch())
                {
                    echo"<tr><td>".$r['PartyId']."</td><td>".$r['PartyName']."</td><td>".$r['Motto']."</td></tr>";
                }
            ?>
            
        </table><div class="footer">
        <a href="Remove_Party.php"><input type="button" value="Remove Party" name="Remove Party" /></a>
            <a href="SuperUser.php"><input type="button" value="Back to Main Menu" name="Back to Main Menu" /></a></div>
        </center>
    </body>
</html>