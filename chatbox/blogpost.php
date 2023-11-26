<?php
include('header.php');
include('config.php');
?>

<div class="container mt-5">
    <h2>Blog Page</h2>

    <a href="add/add_blog.php" class="btn btn-primary mt-3">Add Blog</a>

    <?php
    $query = "SELECT * FROM posts";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        foreach ($result as $row) {
            echo "<div class='card mt-3'>";
            echo "<img src='" . $row['image'] . "' class='card-img-top' alt='Image'>";
            echo "<div class='card-body'>";
            echo $row['image'];
            echo "<h5 class='card-title'>" . $row['title'] . "</h5>";
            echo "<p class='card-text'>" . $row['content'] . "</p>";
            echo "<a href='comment.php?id=" . $row['id'] . "' class='btn btn-primary'>View Comments</a>";
            echo "</div></div>";
        }
    } else {
        echo "<p>Here is no blog!</p>";
    }
    ?>
    
</div>

<?php
include('footer.php');
mysqli_close($con);
?>