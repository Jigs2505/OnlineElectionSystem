<?php

include_once'Connection.php';
$dbname = 'election';
session_start();
if (!isset($_SESSION['SocialSecNumber'])) {

    header("Location:UnExpected.php?msg=You should not directly jump to voting polls, instead login first..");
}
$num = $_SESSION['SocialSecNumber'];
# $num=654321;
$q1 = "select * from citizen where SocialSecNumber=" . $num;
$que1 = $dbhandler->query($q1);
try {
    if ($que1->rowCount() == 0) {
        echo'no regin found for this socialsec number.';
    } else {
        $que1->setFetchMode(PDO::FETCH_ASSOC);
        $region = $que1->fetch();
        $q2 = "select * from candidate where Region='" . $region['Region'] . "'";
        $que2 = $dbhandler->query($q2);
        if ($que2->rowCount() == 0) {
            echo'no candidate for' . $region['Region'] . 'region';
        } else {
            $que2->setFetchMode(PDO::FETCH_ASSOC);
            echo'<html>
                     <head>
        <script>
            var hov = new Audio();
            hov.src = "hover.mp3";
        </script>
        <script>
            var cli = new Audio();
            cli.src = "click.mp3";
        </script>
    </head>
                    <link rel="stylesheet" type="text/css" href="CSS/style_voting.css">
                    <body>
                    <div class="header">
                    <label>
                    Voting Poll
                    </label>
                    </div>
                    <form action="" method="POST"><div class = "options">';
            echo'<div class = "SubText"><label>Please select appropriate button for vote the Candidate:</label></div>';
            $count = 1;
            echo '<div class = "tablediv">';
            echo '<table><tr><th>District</th><th>State</th><th>Central</th><th>Party</th><th>Vote</th></tr>';
            while ($r = $que2->fetch()) {

                $q3 = "select * from party where PartyId='" . $r['PartyId'] . "'";
                $party = $dbhandler->query($q3);
                $r2 = $party->fetch();
                if ($r2['PartyId'] == '4') {
                    echo '<tr ><td rowspan = "2" colspan = "4"></td><td rowspan = "2">';
                    echo'<div class = "nota"><button name="b' . $count . '" onmouseover="hov.play();" onmousedown="cli.play()">';
                    echo'<h2>' . $r2['PartyName'] . '</h2>';
                    echo '</div></td></tr>';
                } else {
                    echo "<tr>";
                    echo '<td><img src = "../img/candidate/' . $r['PhotoLink'] . '.jpg" alt = "Image here"></td>';
                    $findState = $r['Under'];
                    $q10 = $dbhandler->query('select * from candidate where PartyId = ' . $r['PartyId'] . ' and Region = "' . $findState . '"');
                    $r10 = $q10->fetch();
                    echo '<td><img src = "../img/candidate/' . $r10['PhotoLink'] . '.jpg" alt = "Image here"></td>';
                    $q11 = $dbhandler->query('select * from candidate where PartyId = ' . $r['PartyId'] . ' and HierarchyLevel = "Center"');
                    $r11 = $q11->fetch();
                    echo '<td><img src = "../img/candidate/' . $r11['PhotoLink'] . '.jpg" alt = "Image here"></td>';
                    $q12 = $dbhandler->query('select * from party where PartyId = ' . $r['PartyId']);
                    $r12 = $q12->fetch();
                    echo '<td><img src = "../img/party/' . $r12['LogoLink'] . '.jpg" alt = "Image here"></td>';
                    echo '<td rowspan = "2">';
                    echo'<button name="b' . $count . '" onmouseover="hov.play();" onmousedown="cli.play()">';
                    echo'<h2>' . $r2['PartyName'] . '</h2>';
                    echo'</button></td></tr>';
                    $count++;
                    echo '<tr>';
                    echo '<td>' . $r['FirstName'] . ' ' . $r['LastName'] . '</td>';
                    echo '<td>' . $r10['FirstName'] . ' ' . $r10['LastName'] . '</td>';
                    echo '<td>' . $r11['FirstName'] . ' ' . $r11['LastName'] . '</td>';
                    echo '<td>' . $r12['PartyName'] . '</td>';
                    echo '</tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>';
                    # echo $count.'<br>';
                }
            }

            $q3 = "select * from candidate where Region='" . $region['Region'] . "'";
            $que3 = $dbhandler->query($q3);
            $que3->setFetchMode(PDO::FETCH_ASSOC);
            $count = 1;
            while ($r = $que3->fetch()) {
                if (isset($_POST['b' . $count])) {
                    $vote = $r['Votes'];
                    $vote++;
                    #echo 'votes are'.$vote;
                    $q4 = "update candidate set Votes=$vote where PartyId='" . $r['PartyId'] . "' and HierarchyLevel='" . $r['HierarchyLevel'] . "' and Region='" . $r['Region'] . "'";
                    $que4 = $dbhandler->query($q4);
                    header("Location:Intermediate.php");
                }
                $count++;
            }

            echo' </table> </div></div> </form>
                                </body>
                                </html>';
        }
    }
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>