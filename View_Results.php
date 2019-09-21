<?php

include_once'Connection.php';

$Areas = array(
    array("Gujarat", "Bhavnagar", "Rajkot", "Gandhinagar"),
    array("Maharashtra", "Mumbai", "Pune", "Nashik"),
    array("Rajasthan", "Udaipur", "Jodhpur", "Ajmer")
);
$f = 0;
for ($i = 0; $i < 3; $i++) {
    $q1 = "select * from candidate where Region='" . $Areas[$i][0] . "'";
    $que1 = $dbhandler->query($q1);
    if ($que1->rowCount() != 0) {
        for ($j = 1; $j < 4; $j++) {
            $flag = 0;
            $q2 = "select * from candidate where Region='" . $Areas[$i][$j] . "' order by Votes desc";
            $que2 = $dbhandler->query($q2);
            if ($que2->rowCount() != 0) {
                while ($r = $que2->fetch()) {

                    $q7 = "select * from history where Current=2";
                    $que7 = $dbhandler->query($q7);
                    $r3 = $que7->fetch();
                    if ($r3['Result'] == 'NULL') {
                        $que3 = "select * from candidate where Region='" . $r['Under'] . "' and PartyId=" . $r['PartyId'];
                        $q3 = $dbhandler->query($que3);
                        if ($q3->rowCount() == 0) {
                            echo'there is no candidate for this state';
                        } else if ($q3->rowCount() == 1) {
                            $r1 = $q3->fetch();
                            $vote = $r1['Votes'];
                            $vote += $r['Votes'];
                            $q4 = "update candidate set Votes=$vote where PartyId='" . $r1['PartyId'] . "' and HierarchyLevel='" . $r1['HierarchyLevel'] . "' and Region='" . $r1['Region'] . "'";
                            $que4 = $dbhandler->query($q4);
                            # echo"<div class='h1'>other candidate of Region=".$r['Region']." are</div>";
                            # echo'update state candidate successfully';
                        } else {
                            echo'there is more than one candidate for this state';
                        }
                    }
                }
                echo'</table></div>';
            }
        }
    } else {
        echo'invalid ooooooo';
    }
}
$f = 1;
$flag = 0;
$q5 = "select * from candidate where Under='India' order by Votes desc";
$que5 = $dbhandler->query($q5);
while ($r = $que5->fetch()) {
    $q6 = "select * from party where PartyId=" . $r['PartyId'];
    $que6 = $dbhandler->query($q6);
    $r2 = $que6->fetch();
    if ($flag == 0) {
        $flag = 1;

        echo'<div class="h2">';
        echo"<h2>Party " . $r2['PartyName'] . " is won with" . $r['Votes'] . " votes</h2>";
        echo"<h3>" . $r['FirstName'] . " " . $r['LastName'] . "</h3></div>";
        echo'<div class="extra">
                 <table><tr><th>Others</th></tr>
                <tr><th>PartyName</th>
                    <th>PartyId</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Region</th>
                    <th>Votes</th>
                </tr>';
        $q8 = "select * from history where Current=2";
        $que8 = $dbhandler->query($q8);
        $r4 = $que8->fetch();
        if ($r4['Result'] == 'NULL') {
            $q9 = "update history set Result='" . $r2['PartyName'] . "'where Id=" . $r4['Id'];
            $que9 = $dbhandler->query($q9);
        }
    } else {

        echo "<tr><td>" . $r2['PartyName'] . "</td><td>  " . $r['PartyId'] . "</td><td>  " . $r['FirstName'] . "</td><td>  " . $r['LastName'] . "</td><td>  " . $r['Region'] . "</td><td>  " . $r['Votes'] . "</td></tr><br>";
    }
}
echo'</table></div></body></html>';





for ($i = 0; $i < 3; $i++) {
    $q1 = "select * from candidate where Region='" . $Areas[$i][0] . "'";
    $que1 = $dbhandler->query($q1);
    if ($que1->rowCount() != 0) {
        for ($j = 1; $j < 4; $j++) {
            $flag = 0;
            $q2 = "select * from candidate where Region='" . $Areas[$i][$j] . "' order by Votes desc";
            $que2 = $dbhandler->query($q2);
            if ($que2->rowCount() != 0) {
                while ($r = $que2->fetch()) {
                    if ($flag == 0) {
                        $flag = 1;
                        echo'<html>';
                        echo' <link rel="stylesheet" type="text/css" href="CSS/style_result.css">';
                        echo'<body>';
                        echo'<div class="h1">';
                        echo"Winner in " . $r['Region'] . "</div>";
                        echo'<div class="header">';
                        $q6 = "select * from party where PartyId=" . $r['PartyId'];
                        $que6 = $dbhandler->query($q6);
                        $r2 = $que6->fetch();
                        echo"<h1> candidate with party " . $r2['PartyName'] . "  " . $r['FirstName'] . "  " . $r['LastName'] . "  is won with " . $r['Votes'] . "  votes.</h1>";
                        echo'</div>';
                        echo'<div class="extra">';
                        echo' <table><tr><th>Others</th></tr>
                                    <tr><th>HierarchyLevel</th>
                                    <th>PartyId</th>
                                    <th>FirstName</th>
                                    <th>LastName</th>
                                    <th>Region</th>
                                   <th>Votes</th>
                                     </tr>';
                    } else {

                        echo "<tr><td>" . $r['HierarchyLevel'] . "</td><td>  " . $r['PartyId'] . "</td> <td> " . $r['FirstName'] . "</td><td>  " . $r['LastName'] . "</td><td>  " . $r['Region'] . "</td><td>  " . $r['Votes'] . "</td></tr><br>";
                    }
                }
                echo'</table></div>';
            }
        }
    }
}
?>