<link rel="stylesheet" type="text/css" href="css/Bootstrap/bootstrap.css">

<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';

include 'inc/header.php';

// henter alle aktiviteter og bruker disse i dropdown 
$activitiesSelect = $conn->query("SELECT * FROM activities");

if (isset($_POST['send'])){

    // plasserer verdiene fra dropdowns i variabler
    $activityValue = $_REQUEST['activity'];
    $contingentValue = $_REQUEST['contingent'];

    // Spørringer for contingent og aktiviteter som blir lagt til i SQL-spørringen dersom
    // dropdownen ikke er tom 
    if (!empty($activityValue)) {
        $joinQuery[] = "select email from member 
        JOIN memberactivities ON memberactivities.memberID=member.memberID 
        JOIN activities ON activities.activityID=memberactivities.activityID where memberactivities.activityID LIKE '%$activityValue%'";
    }
    if (!empty($contingentValue)) {
        $joinQuery[] = "select email from member where contingentStatus LIKE '%$contingentValue%'";
    }

    // Spørringen som har en verdi blir kjørt
    $member_select = mysqli_query($conn, join($joinQuery));

    while($row = mysqli_fetch_array($member_select))
    {
    $addresses[] = $row['email'];
    }

    $to = implode(", ",$addresses);
    $from = $_POST['sendFrom'];
    $fromName = $_POST['fromName'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'andrhm16@uia.no';                     //SMTP username
    $mail->Password   = 'Kalender12345678910';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($from, $fromName);
    $mail->addAddress($to);     //Add a recipient

    //Attachments

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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