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



$id = $_GET['id'];



// لو الفورم اتبعت (POST)

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];

    $age = $_POST["age"];

    $phone = $_POST["phone"];



    $conn->query("UPDATE students SET name='$name', age=$age WHERE student_id=$id");



    // لو الطالب له رقم تليفون موجود نحدثه، لو مش موجود ندخله

    $check = $conn->query("SELECT * FROM st_phones WHERE student_id=$id");

    if ($check->num_rows > 0) {

        $conn->query("UPDATE st_phones SET phone_number='$phone' WHERE student_id=$id");

    } else {

        $conn->query("INSERT INTO st_phones (student_id, phone_number) VALUES ($id, '$phone')");

    }



    echo "Student updated successfully! <a href='index.php'>Back to list</a>";

    exit;

}



// هات بيانات الطالب الحالي

$result = $conn->query("SELECT s.name, s.age, p.phone_number 

                        FROM students s 

                        LEFT JOIN st_phones p ON s.student_id = p.student_id 

                        WHERE s.student_id=$id");

$row = $result->fetch_assoc();

?>



<h2>Edit Student</h2>

<form method="post" action="">

    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>

    Age: <input type="number" name="age" value="<?php echo $row['age']; ?>" required><br><br>

    Phone: <input type="text" name="phone" value="<?php echo $row['phone_number']; ?>"><br><br>

    <input type="submit" value="Update Student">

</form>


