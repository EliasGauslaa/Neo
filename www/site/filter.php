<?php
include ("inc/header.php");

    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
    } else {}

    echo "<h2>Sorter medlemmer etter ønskede kriterier</h2>";

    // Henter interesser og aktiviteter fra databasen og plasserer dem i dropdowns
    $interestSelect = $conn->query("SELECT interest FROM interests");
    $activitiesSelect = $conn->query("SELECT activity FROM activities");
    
    if(isset($_POST['sort'])){

        // Henter verdien fra dropdowns
        $interestValue = $_REQUEST['interest'];
        $activityValue = $_REQUEST['activities'];
        $contingentValue = $_REQUEST['contingent'];
        
        // En matrise for interesser og aktiviteter som blir lagt til i SQL-spørringen dersom
        // dropdownen ikke er tom 
        $joinQuery = array();
        if (!empty($interestValue)) {
            $joinQuery[] = " JOIN memberinterests ON memberinterests.memberID=member.memberID 
            JOIN interests ON interests.interestID=memberinterests.interestID ";
        }
        if (!empty($activityValue)) {
            $joinQuery[] = " JOIN memberactivities ON memberactivities.memberID=member.memberID 
            JOIN activities ON activities.activityID=memberactivities.activityID ";
        }

        // Matrise med WHERE-statements som blir lagt til dersom dropdownen ikk er tom
        $whereQuery = array();
        if (!empty($interestValue)) {
            $whereQuery[] = "interest LIKE '%$interestValue%'";
        }

        if (!empty($activityValue)) {
            $whereQuery[] = "activity LIKE '%$activityValue%'";
        }

        if (!empty($contingentValue)) {
            $whereQuery[] = "contingentStatus LIKE '%$contingentValue%'";
        }

        // Spørringen hvor JOIN og WHERE legges til avhengig om de har en verdi
        $query = "SELECT firstName, lastName, address, zipCode, postAddress, phone, email FROM member"
        . join($joinQuery) ."
        WHERE " . join(' and ', $whereQuery) . " ORDER BY firstName ASC";

        $result = $conn->query($query);
        
        // Viser brukeren hva den har søkt på
        echo "Ditt søk: <br><br>";

        if (!empty($interestValue)) {
            echo "<b>Interesse: </b>" . $interestValue . "<br>";
        }
        if (!empty($activityValue)) {
            echo "<b>Aktivitet: </b>" . $activityValue . "<br>";
        }
        if (!empty($contingentValue)) {
            echo "<b>Kontingentstatus: </b>" . $contingentValue . "<br>";
        }

        // Skriver ut tabellen
    echo "<div class='container'>
        <table>
        <tr>
            <th>Medlem</th>
            <th>Adresse</th>
            <th>Mobil</th>
            <th>E-post</th>
        </tr>";
        
        while ($row = $result->fetch_assoc()){
        
        echo "<tr>
            <td>" . $row['firstName'] . " " . $row['lastName'] . "</td>
            <td>" . $row['address'] . ", " . $row['zipCode'] . " " . $row['postAddress'] . "</td>
            <td>" . $row['phone'] . "</td>
            <td>" . $row['email'] . "</td>
        </tr></div>";
        }
        echo "</table>";
        
        $conn->close();
        }


    include "inc/footer.php";
?>
<br><div class="filter">
    <form action="filter.php" method="post">
        <label for="interest">Interesser</label>
        <select name="interest">
            <option></option>
            <?php
            while ($rows = $interestSelect->fetch_assoc()){
                $interest = $rows['interest'];
                echo "<option value='$interest'>$interest</option>";
            }
            ?>  
        </select>

        <label for="activities">Aktiviteter</label>
        <select name="activities">
            <option></option>
            <?php
            while ($rows = $activitiesSelect->fetch_assoc()){
                $activity = $rows['activity'];
                echo "<option value='$activity'>$activity</option>";
            }
            ?>  
        </select>

        <label for="contingent">Kontingentstatus</label>
        <select name="contingent">
            <option></option>
            <option value="Betalt">Betalt</option>
            <option value="Ikke betalt">Ikke betalt</option>
        </select>

        <input type="submit" name="sort" value="Sorter">
        
    </form>
</div>