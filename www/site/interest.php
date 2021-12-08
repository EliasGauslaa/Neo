<?php
include ("inc/header.php");

    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
    } else { 
    
    $interestQuery = "SELECT * FROM interests";
        
    $result = $conn->query($interestQuery);

    echo "<div class='container'>
    <table>
    <tr>
        <th>InteresseID</th>
        <th>Interesse</th>
        <th></th>
    </tr>";

    while ($row = $result->fetch_assoc()){

    echo "<tr>
        <td>" . $row['interestID'] . "</td>
        <td>" . $row['interest'] . "</td>
        <td><button name='intAdd'><a href=interestJoin.php?interestID=" . $row['interestID'] . 
        " style='text-decoration: none;'> Legg til medlem</a></button></td>
    </tr></div>";
    }
    echo "</table>";

    $conn->close();
    }


    include ("inc/footer.php");
?>