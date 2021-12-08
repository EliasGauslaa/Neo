<?php
include ("inc/header.php");
?>
<div class="profile">

<?php
$memberID = $_GET['memberID'];


echo '<img src="img/' . $memberID. '.png" alt="default">';

$memberSelect = $conn->query("SELECT * FROM member WHERE memberID=$memberID");
$interestsSelect = $conn->query("SELECT * FROM interests JOIN memberinterests 
ON memberinterests.interestID=interests.interestID WHERE memberID=$memberID");
$rolesSelect = $conn->query("SELECT * FROM role JOIN memberroles 
ON memberroles.roleID=role.roleID WHERE memberID=$memberID");

$memberRows = $memberSelect->fetch_assoc();

$name = $memberRows['firstName'] . " " . $memberRows['lastName'];
$born = $memberRows['born'];
$memberSince = $memberRows['memberSince'];
$contingent = $memberRows['contingentStatus'];

echo "<header>$name</header>";
echo "<div class='born'>$born</div>";

while ($roleRows = $rolesSelect->fetch_assoc()) {
    $array = array(
        "Roller" => $roleRows['role']
    );
    foreach ($array as $x => $value) {
        echo "<div class='role'>- ". $value . " - </div>";
    }
    
}

echo "<br><div class='membersince'>Medlem siden:</div>";
echo $memberSince;

echo "<br><br><div class='contingent'>Kontingentstatus:</div>";
echo $contingent;

echo "<div class='interests'><br><b>Interesser: </b><br></div>";
while ($interestRows = $interestsSelect->fetch_assoc()) {
    $array = array(
        "Interesser" => $interestRows['interest']
    );
    foreach ($array as $x => $value) {
        echo "<font color=\"white\">". $value . " </font><br>";
    }
    
}

?>
</div>



<?php
include "inc/footer.php";
?>