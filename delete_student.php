<?php

$servername = "localhost";

$username = "abdo";

$password = "123456";

$dbname = "applicationDB";



$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}



$id = $_GET['id'];



// الأول نتحقق إن الطالب موجود

$result = $conn->query("SELECT * FROM students WHERE student_id=$id");

if ($result->num_rows > 0) {

    // بسبب الـ FOREIGN KEY مع ON DELETE CASCADE

    // لما نمسح الطالب → كل أرقامه هتتمسح أوتوماتيك

    $conn->query("DELETE FROM students WHERE student_id=$id");

    echo "Student deleted successfully! <a href='index.php'>Back to list</a>";

} else {

    echo "Student not found! <a href='index.php'>Back to list</a>";

}



$conn->close();

?>


