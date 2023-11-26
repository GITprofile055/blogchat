<?php
include('header.php');
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM users WHERE email=?";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if (password_verify($password, $row['password'])) {
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['email'] = $row['email'];
                        header("Location:blogpost.php");
                        exit();
                    } else {
                        echo '<script> alert("Incorrect password.");</script>';
                    }
                }
            } else {
                echo '<script> alert("User not found.");</script>';
            }
        } else {
            echo "Error: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing SQL statement: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

<div class="container mt-5" style="width:30%;">
    <h2 class="text-center">Login</h2>
    <form method="POST" >
        <div class="form-group mb-3">
            <label for="email">Email:</label>
            <input type="email" class="form-control " id="email" name="email" placeholder="Enter the email.." required>
        </div>
        <div class="form-group mb-3">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter the password.." required>
        </div>
        <button type="submit" class="btn btn-primary">Sign In</button>
    </form>
</div>

<?php
include('footer.php');
?>
