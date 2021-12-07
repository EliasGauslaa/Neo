<?php

include("inc/header.php");

$membersQuery = "SELECT * FROM member";

$result = $conn->query($membersQuery);



if (isset($_POST['add'])) {

    $activity_ID = $_GET['activityID'];
    $member_ID = $row['memberID'];

    $sql = "INSERT INTO `memberactivities`(`memberID`, `activityID`) VALUES ('$member_ID','$activity_ID')";

    mysqli_query($conn, $sql);

    echo " lagt til";
    }



echo "<div class='container'>
<table>
<tr>
    <th>Medlemsnr.</th>
    <th>Fornavn</th>
    <th>Etternavn</th>
    <th></th>
    </tr>";

    while ($row = $result->fetch_assoc()){
    
        echo "<tr>
        <td>" . $row['memberID'] . "</td>
        <td>" . $row['firstName'] . "</td>
        <td>" . $row['lastName'] . "</td>
        <form method='POST'>
        <td><button type='submit' name='add'><a " . " style='text-decoration: none;'>Legg til</a></button></td>
        </form>
        
    </tr></div>";

    // if (isset($_POST['add'])) {

    //     $activity_ID = $_GET['activityID'];
    //     $member_ID = $row['memberID'];
    
    //     $sql = "INSERT INTO `memberactivities`(`memberID`, `activityID`) VALUES ('$member_ID','$activity_ID')";
    
    //     mysqli_query($conn, $sql);
    
    //     echo " lagt til";
    //     }

    }
    echo "</table>";


?>

<?php

include("inc/footer.php");

?>
