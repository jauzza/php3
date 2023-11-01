<?php
require 'vendor/autoload.php';

use Carbon\Carbon;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "comments";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["naam"])) {

    $name = $_POST["naam"];
    $email = $_POST["email"];
    $text = htmlspecialchars($_POST["tekts"]);
    $date = time();

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";

        $insertionquery = "INSERT INTO comments (naam, email, datum, tekts) VALUES ('$name', '$email', '$date', '$text')";

        if (mysqli_query($conn, $insertionquery)) {
            // echo "Error: " . $insertionquery . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "<br>De email die je hebt ingevoerd is onjuist<br><br>";
    }
}

?>

<iframe width="520" height="315" src="https://www.youtube.com/embed/Q10tVT5aF2Y"></iframe>

<form action="http://localhost/school/2023%202024/php3/" method="post">

    Name: <input type="text" name="naam"><br>

    E-mail: <input type="text" name="email"><br>

    Commentaar: <input type="text" name="tekts"><br>

    <input type="submit">

</form>

<br><br>

Comments:

<br><br>

<?php

$sql = "SELECT * FROM comments";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ago = Carbon::createFromTimeStamp($row["datum"])->diffForHumans();
        echo $row["naam"] . " | " . $ago . "<br>" . $row["tekts"] . "<br>";
    }
} else {
    echo "Er zijn op dit moment geen comments, wees de eerste om te commenten!";
}

mysqli_close($conn);

?>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>


<!-- ls /Applications/XAMPP/xamppfiles/bin -->