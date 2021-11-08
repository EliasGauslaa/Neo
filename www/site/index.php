<?php
include ("inc/header.php");

    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
    } else { 
    
    $membersQuery = "SELECT * FROM member JOIN gender ON gender.genderID=member.genderID";
        
    $result = $conn->query($membersQuery);

    echo "<div class='container'>
    <table>
    <tr>
        <th>Medlemsnr.</th>
        <th>Fornavn</th>
        <th>Etternavn</th>
        <th>Adresse</th>
        <th>Postnummer</th>
        <th>Poststed</th>
        <th>Mobil</th>
        <th>E-post</th>
        <th>Født</th>
        <th>Kjønn</th>
        <th>Medlem siden</th>
        <th>Kontingentstatus</th>
        <th></th>
    </tr>";

    while ($row = $result->fetch_assoc()){

    echo "<tr>
        <td>" . $row['memberID'] . "</td>
        <td>" . $row['firstName'] . "</td>
        <td>" . $row['lastName'] . "</td>
        <td>" . $row['address'] . "</td>
        <td>" . $row['zipCode'] . "</td>
        <td>" . $row['postAddress'] . "</td>
        <td>" . $row['phone'] . "</td>
        <td>" . $row['email'] . "</td>
        <td>" . $row['born'] . "</td>
        <td>" . $row['gender'] . "</td>
        <td>" . $row['memberSince'] . "</td>
        <td>" . $row['contingentStatus'] . "</td>
        <td><button name='edit'><a href=edit.php?memberID=" . $row['memberID'] . " style='text-decoration: none;'> Rediger</a></button></td>
    </tr></div>";
    }
    echo "</table>";

    $conn->close();
    }


    include ("inc/footer.php");
?>