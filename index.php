<?php
echo "<h1>Hello from App1</h1>";

$servername = "172.25.250.10";
$username = "abdo";
$password = "123456";
$dbname = "applicationDB";

$conn = mysqli_init();
$conn->ssl_set(NULL, NULL, NULL, NULL, NULL);

if (!$conn->real_connect($servername, $username, $password, $dbname)) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT s.student_id, s.name, s.age, p.phone_number
        FROM students s
        LEFT JOIN st_phones p ON s.student_id = p.student_id";
$result = $conn->query($sql);

echo "<h2>Students & Phones</h2>";

echo "<a href='add_student.php'>➕ Add New Student</a><br><br>";



if ($result->num_rows > 0) {

    echo "<table border='1' cellpadding='5'>

            <tr><th>ID</th><th>Name</th><th>Age</th><th>Phone</th><th>Actions</th></tr>";

    while($row = $result->fetch_assoc()) {

        echo "<tr>

                <td>".$row["student_id"]."</td>

                <td>".$row["name"]."</td>

                <td>".$row["age"]."</td>

                <td>".$row["phone_number"]."</td>

                <td>

                    <a href='edit_student.php?id=".$row["student_id"]."'>Edit</a> |

                    <a href='delete_student.php?id=".$row["student_id"]."'>Delete</a>

                </td>

              </tr>";

    }

    echo "</table>";

} else {

    echo "No students found.";

}



$conn->close();

?>


