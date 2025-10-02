<?php
$servername = "172.25.250.10";
$username = "abdo";
$password = "123456";
$dbname = "applicationDB";

$conn = mysqli_init();
$conn->ssl_set(NULL, NULL, NULL, NULL, NULL);

if (!$conn->real_connect($servername, $username, $password, $dbname)) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];

    $age = $_POST["age"];

    $phone = $_POST["phone"];



    // أدخل الطالب

    $sql = "INSERT INTO students (name, age) VALUES ('$name', $age)";

    if ($conn->query($sql) === TRUE) {

        $student_id = $conn->insert_id;



        // أدخل رقم التليفون

        if (!empty($phone)) {

            $sql_phone = "INSERT INTO st_phones (student_id, phone_number) VALUES ($student_id, '$phone')";

            $conn->query($sql_phone);

        }



        echo "Student added successfully! <a href='index.php'>Back to list</a>";

    } else {

        echo "Error: " . $conn->error;

    }

}

?>



<h2>Add New Student</h2>

<form method="post" action="">

    Name: <input type="text" name="name" required><br><br>

    Age: <input type="number" name="age" min="1" required><br><br>

    Phone: <input type="text" name="phone"><br><br>

    <input type="submit" value="Add Student">

</form>


