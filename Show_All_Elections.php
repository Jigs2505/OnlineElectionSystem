<html>
    <body><center>
        <link rel="stylesheet" type="text/css" href="CSS/Show_All_Style.css">
        <?php
        include_once'Connection.php';
        session_start();
        if (!(isset($_SESSION['SocialSecNumber']))) {
            if ($_SESSION['SocialSecNumber'] != 'Admin') {
                header("Location:UnExpected.php?msg=Page is not available for you");
            }
        }
        $query = "select * from history order by Id DESC";
        $q = $dbhandler->query($query);
        ?>
        <header><h1><b>Registered elections are :</b></h1></header>
        <table>
            <tr>
                <th>Id</th>
                <th>Start</th>
                <th>End</th>
                <th>Status</th>
                <th>Result</th>
                
            </tr>
            <?php
                while($r=$q->fetch())
                {
                    if($r['Current'] == 1)
                    {
                        echo"<tr><td>".$r['Id']."</td><td>".$r['Start']."</td><td>".$r['End']."</td><td>Live</td><td>".$r['Result']."</td></tr>";
                    }
                    else if($r['Current'] == 0)
                    {
                        echo"<tr><td>".$r['Id']."</td><td>".$r['Start']."</td><td>".$r['End']."</td><td>Waiting</td><td>".$r['Result']."</td></tr>";
                    }
                    if($r['Current'] == 2)
                    {
                        echo"<tr><td>".$r['Id']."</td><td>".$r['Start']."</td><td>".$r['End']."</td><td>Recently die and result ready</td><td>".$r['Result']."</td></tr>";
                    }
                    if($r['Current'] == 3)
                    {
                        echo"<tr><td>".$r['Id']."</td><td>".$r['Start']."</td><td>".$r['End']."</td><td>Over and Result not available</td><td>".$r['Result']."</td></tr>";
                    }
                }
            ?>
            
        </table><div class="footer"><a href="End_Election.php"><input type="button" value="End Election" name="End Election" /></a>
            <a href="SuperUser.php"><input type="button" value="Back to Main Menu" name="Back to Main Menu" /></a></div></center>
    </body>
</html>