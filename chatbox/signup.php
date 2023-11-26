<?php
include('header.php');
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists.')</script>";
        header("Refresh: 1; url=signup.php");
        exit();
    }

    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    
    // Check if the query is successful
    
    if ($con) {
        $result = mysqli_query($con, $query);

        if ($result) {
            header("Location: signin.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error connecting to the database.";
    }
}

mysqli_close($con);
?>

<div class="container mt-5" style="width:30%;">
    <h2>Register</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="enter the name.." required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="enter the email.." required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="enter the password.." required>
        </div>
        <button type="submit" class="btn btn-primary">signup</button>
    </form>
</div>

<?php
include('footer.php');
?>