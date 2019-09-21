<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
   <head>
        <script>
            var hov = new Audio();
            hov.src = 'hover.mp3';
        </script>
        <script>
            var cli = new Audio();
            cli.src = 'click.mp3';
        </script>
        <link rel="stylesheet" type="text/css" href="CSS/style_home.css">
    </head>
    
    <div class = "MenuBar">
        <ul>
            <li><div class="active"><a><label>Home</label></a></div></li>
            <li><a href="Login.php" onmouseover="hov.play();" onmousedown="cli.play()"><label>Login</label></a></li>
            <li><a href="RegisterCitizen.php" onmouseover="hov.play();" onmousedown="cli.play()"><label>Sign Up</label></a></li>
            <?php
            include_once'Connection.php';
            $query = $dbhandler->query("select * from history where current = '2'");
            if ($query->rowCount() == 1) {
                echo '<li><a href="View_Results.php" onmouseover="hov.play();" onmousedown="cli.play()"><label>Results</label></a></li>';
            }
            ?>
        </ul>
    </div>
    <div class = "CenterText">
        <span class = "CenterText1">
            <label> Welcome to</label>
        </span>
        <span class = "CenterText2">
            <label>Online Voting Portal</label>
        </span>
    </div>
    <audio src="Welcome.mp3" autoplay=""></audio>
</html> 