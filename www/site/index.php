<?php
include ("inc/header.php");

    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
    } else { 
    
    // henter alle alle kolonnene fra member og joiner gender med genderID
    $membersQuery = "SELECT * FROM member JOIN gender ON gender.genderID=member.genderID";
        
    // resultatet fra spørringen over lagres i result variabelen 
    $result = $conn->query($membersQuery);

    // Skriver ut tabellen 
    echo "<div class='container'>
    <table>
    <tr>
        <th>Medlemsnr.</th>
        <th>Navn</th>
        <th>Adresse</th>
        <th>Mobil</th>
        <th>E-post</th>
        <th>Født</th>
        <th>Kjønn</th>
        <th>Medlem siden</th>
        <th>Kontingentstatus</th>
        <th></th>
        <th></th>
    </tr>";

    // radene og kolonnene fylles inn med informasjon fra databasen. De to siste kolonnene er 
    // knapper som redirecter til andre sider og tar med seg memberID gjennom en GET metode
    while ($row = $result->fetch_assoc()){

    echo "<tr>
        <td>" . $row['memberID'] . "</td>
        <td>" . $row['firstName'] . " " . $row['lastName'] . "</td>
        <td>" . $row['address']. ", " . $row['zipCode'] . " " . $row['postAddress'] . "</td>
        <td>" . $row['phone'] . "</td>
        <td>" . $row['email'] . "</td>
        <td>" . $row['born'] . "</td>
        <td>" . $row['gender'] . "</td>
        <td>" . $row['memberSince'] . "</td>
        <td>" . $row['contingentStatus'] . "</td>
        <td><button name='edit'><a href=profile.php?memberID=" . $row['memberID'] . " style='text-decoration: none;'> Profil</a></button></td>
        <td><button name='edit'><a href=edit.php?memberID=" . $row['memberID'] . " style='text-decoration: none;'> Rediger</a></button></td>
    </tr></div>";
    }
    echo "</table>";

    $conn->close();
    }


    include ("inc/footer.php");
?>