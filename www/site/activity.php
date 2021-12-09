<?php

include("inc/header.php");

// gets activityID from the table
$activityID = $_GET['activityID'];

// retrieves data from the database
$membersSelect = $conn->query("SELECT * FROM member");
$activitiesSelect = $conn->query("SELECT * FROM activities WHERE activityID = $activityID");

//retrieves values from the inputs and places them in variables
$activitiesRows = $activitiesSelect->fetch_assoc();

$activity = $activitiesRows['activity'];
$responsible = $activitiesRows['responsible'];
$date = $activitiesRows['date'];
$start = $activitiesRows['start'];
$end = $activitiesRows['end'];

//echos info about the activity
echo "<h1>". $activity . " , " . $date . " kl. ". substr($start,0,5) . " - " . substr($end,0,5) . "</h1>";
echo "<h2>Ansvarlig: $responsible </h2>";

if(isset($_POST['add'])){
    
    // memberID hentes fra valgt medlem i dropdown
    $memberID = $_POST['member'];

    //puts chosen memberID and activityID into memberactivities
    $query = "INSERT INTO memberactivities (memberID, activityID)
    VALUES ($memberID, $activityID)";

    //if else to check if member was assigned or if he/she already was
    if(mysqli_query($conn, $query)){
        echo "<h3>Valgt medlem er nå påmeldt. </h3>"; 
    } else{
        echo "Medlemmet er allerede påmeldt. ";
    }

    //select statement to get all members that are assigned to one activity
    $signedup = "SELECT firstName, lastName FROM member
    JOIN memberactivities ON memberactivities.memberID=member.memberID
    WHERE activityID = $activityID";
        
    $signedupResult = $conn->query($signedup);

    // echos the table
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