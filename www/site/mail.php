<link rel="stylesheet" type="text/css" href="css/Bootstrap/bootstrap.css">

<?php
include 'inc/header.php';

$activitiesSelect = $conn->query("SELECT * FROM activities");

if (isset($_POST['send'])){

    $activityValue = $_REQUEST['activity'];
    $contingentValue = $_REQUEST['contingent'];

    if (!empty($activityValue)) {
        $joinQuery[] = "select email from member 
        JOIN memberactivities ON memberactivities.memberID=member.memberID 
        JOIN activities ON activities.activityID=memberactivities.activityID where memberactivities.activityID LIKE '%$activityValue%'";
    }
    if (!empty($contingentValue)) {
        $joinQuery[] = "select email from member where contingentStatus LIKE '%$contingentValue%'";
    }

    $member_select = mysqli_query($conn, join($joinQuery));

    while($row = mysqli_fetch_array($member_select))
    {
    $addresses[] = $row['email'];
    }
    
    ini_set("SMTP","ssl://smtp.gmail.com" );
    ini_set("smtp_port","587");
    ini_set('sendmail_from', 'andreashovland96@gmail.com');
    $to = implode(", ", $addresses);
    $from = $_POST['sendFrom'];
    $fromName = $_POST['fromName'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $headers = "From: ". $fromName . "<" . $from . ">" . "\r\n";
    
    if(mail($to, $subject, $message, $headers)){
        echo "Din e-post ble sendt";
    } else {
        echo "Din e-post ble ikke sendt<br>";
        echo "<br>".$to. "<br>";
        echo $fromName. "<br>";
        echo $from. "<br>";
        echo $subject. "<br>";
        echo $message. "<br>";
    }
}
?>
    <div class="container">
        <div class="row">
            <div class="card-header">
                <h3>Send Mail</h3>
            </div>
            <div class="card-body">
<form method="post">
    <p>
        <label for="sendFrom">Send fra</label>
        <input type="text" class="form-control" name="sendFrom" placeholder="e-post" required><br>
        <label for="fromName">Navn på avsender</label>
        <input type="text" class="form-control" name="fromName" placeholder="ditt navn" required><br>
    </p>
    <p>
        <h3>Mailen gjelder for:</h3>
    </p>
    <p>
        

        <label for="contingent">Medlemmer med utestående betaling</label>
        <select name="contingent">
            <option></option>
            <option value="Ikke betalt">Ikke betalt</option>
        </select>

        <label for="activity">Påmeldt aktivitet</label>
        <select name="activity">
            <option></option>
            <?php
            while ($rows = $activitiesSelect->fetch_assoc()){
                $activity = $rows['activity'];
                $ID = $rows['activityID'];
                echo "<option value='$ID'>$activity</option>";
            }
            ?>  
        </select>
        
    </p><br>
    <p>
        <label for="subject">Emne</label>
        <input type="text" name="subject" required><br> 
    </p><br>
    <p>
        <textarea name="message" rows="10" cols="50">
        </textarea>
    </p>
    <p>
        <input type="submit" name="send" value="Send">
    </p>
</form>
            </div>
        </div>
    </div>
<?php
    include 'inc/footer.php';
?>