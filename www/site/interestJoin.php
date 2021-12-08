<?php

include("inc/header.php");

$interestID = $_GET['interestID'];

$membersSelect = $conn->query("SELECT * FROM member");
$interestSelect = $conn->query("SELECT * FROM interests WHERE interestID = $interestID");

$interestRows = $interestSelect->fetch_assoc();

$interestName = $interestRows['interest'];

echo "<h1>$interestName</h1>";

if(isset($_POST['intadd'])){
    
    $memberID = $_POST['member'];

    $query = "INSERT INTO memberinterests (memberID, interestID)
    VALUES ($memberID, $interestID)";

    if(mysqli_query($conn, $query)){
        echo "<h3>Valgt medlem er tildelt interesse. </h3>"; 
    } else{
        echo "Medlemmet er allerede blitt tildelt denne interessen. ";
    }

    $signedup = "SELECT firstName, lastName FROM member
    JOIN memberinterests ON memberinterests.memberID=member.memberID
    WHERE interestID = $interestID";
        
    $signedupResult = $conn->query($signedup);

    echo "<div class='container'>
    <table>
    <tr>
        <th>Felles interesserte</th>
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

<br><div class="interestsMembers">
    <form action="interestJoin.php?interestID=<?php echo $interestID?>" method="post">
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
        <input type="submit" name="intadd" value="Legg til">
    </form>
    </div>

    <h2>Felles interesserte:</h2><br>

<?php


include "inc/footer.php";
?>