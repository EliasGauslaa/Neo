<?php

include("inc/header.php");

// henter activityID fra tabellen
$activityID = $_GET['activityID'];

// henter data fra databasen 
$membersSelect = $conn->query("SELECT * FROM member");
$activitiesSelect = $conn->query("SELECT * FROM activities WHERE activityID = $activityID");

// henter verdiene fra radene og plasserer de i variabler
$activitiesRows = $activitiesSelect->fetch_assoc();

$activity = $activitiesRows['activity'];
$responsible = $activitiesRows['responsible'];
$date = $activitiesRows['date'];
$start = $activitiesRows['start'];
$end = $activitiesRows['end'];

// Skriver ut informasjon om aktiviteten
echo "<h1>". $activity . " , " . $date . " kl. ". substr($start,0,5) . " - " . substr($end,0,5) . "</h1>";
echo "<h2>Ansvarlig: $responsible </h2>";

if(isset($_POST['add'])){
    
    // memberID hentes fra valgt medlem i dropdown
    $memberID = $_POST['member'];

    // Legger valgt memberID og activityID inn i memberactivities
    $query = "INSERT INTO memberactivities (memberID, activityID)
    VALUES ($memberID, $activityID)";

    // if else til å sjekke om medlemmet ble meldt på eller om det allerede er påmeldt
    if(mysqli_query($conn, $query)){
        echo "<h3>Valgt medlem er nå påmeldt. </h3>"; 
    } else{
        echo "Medlemmet er allerede påmeldt. ";
    }

    // Select-statement for å hente ut alle medlemmer som er meldt på en viss aktivitet
    $signedup = "SELECT firstName, lastName FROM member
    JOIN memberactivities ON memberactivities.memberID=member.memberID
    WHERE activityID = $activityID";
        
    $signedupResult = $conn->query($signedup);

    // Tabellen skrives ut
    echo "<div class='container'>
    <table>
    <tr>
        <th>Påmeldte</th>
    </tr>";

    while ($row = $signedupResult->fetch_assoc()){

        echo "<tr>
            <td>" . $row['firstName'] . " " . $row['lastName'] . "</td>
        </tr></div>";
    }
    echo "</table>";

    $conn->close();
    

}
?>

<br><div class="activityMembers">
    <form action="activity.php?activityID=<?php echo $activityID?>" method="post">
        <label for="member">Legg til medlemmer</label>
        <select name="member">
            <option></option>
            <?php
            while ($rows = $membersSelect->fetch_assoc()){
                $member = $rows['firstName'] . " " . $rows['lastName'];
                $ID = $rows['memberID'];
                echo "<option value='$ID'>$member</option>";
            }
            ?>  
        </select>
        <input type="submit" name="add" value="Legg til">
    </form>
    </div>

    <h2>Påmeldte:</h2><br>

<?php


include "inc/footer.php";
?>