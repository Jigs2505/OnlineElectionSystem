<html>
    <?php
    include_once 'Connection.php';
    session_start();
    if (!(isset($_SESSION['SocialSecNumber']))) {
        if ($_SESSION['SocialSecNumber'] != 'Admin') {
            header("Location:UnExpected.php?msg=Page is not available for you");
        }
    }
    ?>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <div class = "MenuBar">
        <ul>
            <li><div><a href="home.php"><label>Home</label></a></div></li>
            <li><a href="Login.php"><label>Logout</label></a></li>
        </ul>
    </div>
    <div class="text">
        <label class="t1">
            Admin User
        </label>
        <label class="t2">
            <br/>All the Administrative steps can be taken from here.<br/>This page provides following facilities:
        </label>
    </div>
    <div class="options">
        <ul>
            <li>
                <a><label>Edit Election</label></a>
                <ul>
                    <li>
                        <a href="SetElection.php"><label>Set Election</label></a>
                    </li>
                    <li>
                        <a href="End_Election.php"><label>End Election</label></a>
                    </li>
                    <li>
                        <a href="Show_All_Elections.php"><label>Show All Elections</label></a>
                    </li>
                </ul>
            </li>
            <li>
                <a><label>Edit Candidates</label></a>
                <ul>
                    <li>
                        <a href="RegisterCandidate.php"><label>Register Candidate</label></a>
                    </li>
                    <li>
                        <a href="Remove_Candidate.php"><label>Remove Candidate</label></a>
                    </li>
                    <li>
                        <a href="Show_All_Candidates.php"><label>Show All Candidates</label></a>
                    </li>
                </ul>
            </li>
            <li>
                <a><label>Edit Party</label></a>
                <ul>
                    <li>
                        <a href="RegisterParty.php"><label>Register Party</label></a>
                    </li>
                    <li>
                        <a href="Remove_Party.php"><label>Remove Party</label></a>
                    </li>
                    <li>
                        <a href="Show_All_Parties.php"><label>Show All Parties</label></a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>

</html>