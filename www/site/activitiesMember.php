<?php
include ("inc/header.php");

    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
    } else { 
    
    $activitiesMemberQuery = "SELECT * FROM activities";
        
    $result = $conn->query($activitiesMemberQuery);

    echo "<div class='container'>
    <table>
    <tr>
        <th>AktivitetsNr.</th>
        <th>Aktivitet</th>
        <th>Ansvarlig</th>
        <th>Dato</th>
        <th>Start kl.</th>
        <th>Slutt kl.</th>
        <th></th>
    </tr>";

    while ($row = $result->fetch_assoc()){

    echo "<tr>
        <td>" . $row['activityID'] . "</td>
        <td>" . $row['activity'] . "</td>
        <td>" . $row['responsible'] . "</td>
        <td>" . $row['date'] . "</td>
        <td>" . $row['start'] . "</td>
        <td>" . $row['end'] . "</td>
        <td><button name='join'><a href=activitiesJoin.php?activityID=" . $row['activityID'] . 
        " style='text-decoration: none;'> Legg til medlem</a></button></td>
    </tr></div>";
    }
    echo "</table>";

    $conn->close();
    }


    include ("inc/footer.php");
?>

