<?php
include('header.php');
include('config.php');
session_start();
if (!isset($_SESSION['id'])) {
    // Go back to login.php if not logged in
    header("Location: signin.php");
    exit();
}

// Check if the logged-in user is an admin
$query = "SELECT is_admin FROM posts WHERE id = " . $_SESSION['id'];
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $is_admin = $row['is_admin'];
    
    if (!$is_admin) {
        // Redirect to blogs page if not an admin
        header("Location: blogpost.php");
        exit();
    }
} else {
    // Redirect to login page if user is not found
    header("Location: signin.php");
    exit();
}

?>

<div class="container mt-5">
    <h2>Admin | Panel</h2>

    <?php
    // Displays all the existing blogs
    $query = "SELECT blog_id, title, author_id FROM blog_db";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table class='table'>";
        echo "<thead><tr><th scope='col'>Blog ID</th><th scope='col'>Blog Title</th><th scope='col'>Blog Author</th></tr></thead>";
        echo "<tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['blog_id'] . "</td>";
            echo "<td><a href='comment.php?blog_id=" . $row['blog_id'] . "'>" . $row['title'] . "</a></td>";
            
            // Get the author's names
            $author_id = $row['author_id'];
            $author_query = "SELECT name FROM users WHERE id = $author_id";
            $author_result = mysqli_query($conn, $author_query);

            if ($author_result && mysqli_num_rows($author_result) > 0) {
                $author_row = mysqli_fetch_assoc($author_result);
                echo "<td>" . $author_row['name'] . "</td>";
            } else {
                echo "<td>Unknown</td>";
            }

            echo "</tr>";
        }

        echo "</tbody></table>";

    } else {
        echo "<p>No blogs available.</p>";
    }
    ?>
</div>

<?php
include('footer.php');
mysqli_close($con);
?>