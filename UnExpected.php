<html>
    <body><center>
        <?php
        echo $_GET['msg'];
        echo '<br/>You will be redirected to our Home page in a short amount of time.';
        echo "<script>setTimeout(\"location.href = 'home.php';\",7500);</script>";
        ?></center>
    </body>
</html>