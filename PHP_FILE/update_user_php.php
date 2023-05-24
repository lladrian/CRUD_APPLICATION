<?php



// Create a connection to the MySQL database
$servername = "localhost";
$username = "id17963706_root";
$password = "@LuckyMe11";
$dbname = "id17963706_lab_info";
$conn = new mysqli($servername, $username, $password, $dbname);

// Get the POST data
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$id = $_POST['id'];

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


 if ($fullname==="" || $email==="" || $password==="" || $id==="") {
       echo "Fill in the blanks!";
 } else {
        $sql = "SELECT * FROM java_users2 WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "User already exist!";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "Invalid Email Address";
            } else {
                    $sql = "UPDATE java_users2 SET fullname='$fullname', password='$password', email='$email' WHERE id='$id'";
                    if ($conn->query($sql) === TRUE) {
                        echo "User updated successfully!";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
            }
          
        }
 }
// Close the database connection
$conn->close();
?>