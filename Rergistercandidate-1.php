<html>
    <body>
    <?php 
        include_once'Connection.php';
        if(isset($_POST['submit'])){
            $PID = $_POST['PartyID'];
            $PN = $_POST['PartyName'];
            #$PL = $_POST['PartyLogo'];
            $Mot = $_POST['Motto'];
            $sql="insert into party values ('$PID','$PN','Any Logo Link','$Mot')";
            $query=$dbhandler->query($sql);
            echo "Data is inserted successfully";            
        }
        
    ?>
        <h1>Candidate Registration</h1><br/>
        <form action='' method="post"><center>
            <table>
                <tr>
                    <td>PartyID</td>
                    <td>
                        <input type="number" name='PartyID' required="">
                    </td>
                </tr>
                <tr>
                    <td>Hierarchy Level of Candidate</td>
                    <td>
                        <select name="HierarchyLevel">
                            <option value="Center">Center</option>
                            <option value="State">State</option>
                            <option value="District">District</option>
                        </select>
                    </td>
                </tr>
                <!--<tr>
                    <td>Photo-Link</td>
                    <td>
                        <input type="text" name='PartyLogo'>
                    </td>
                </tr>-->
                <tr>
                    <td>First Name</td>
                    <td>
                        <input type="text" name='FName' required="">
                    </td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td>
                        <input type="text" name='LastName' required="">
                    </td>
                </tr>
                <tr>
                    <td>Region</td>
                    <td>
                        <input type="text" name='Region' required="">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="submit" name="submit">
                    </td>
                </tr>
            </table></center>
        </form>
        
    </body>
</html>