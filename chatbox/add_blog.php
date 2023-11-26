<?php
include('../header.php');
include('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Handle file upload
    $targetDirectory = "images/"; // Set the directory where you want to store uploaded images

    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true); // Create the directory if it doesn't exist
    }

    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if the file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (adjust as needed)
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // File has been uploaded successfully, now insert information into the database
            $image_url = $targetFile;
            $admin_id = $_SESSION['id'];

            $query = "INSERT INTO posts (title, content, image, admin_id) VALUES ('$title', '$content', '$image_url', '$admin_id')";
            $result = mysqli_query($con, $query);

            if ($result) {
                header("Location: blogpost.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

?>

<div class="container mt-5" style="width:30%;">
    <h2>Add a New Blog</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group mb-3">
            <label for="title">Blog Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group mb-3">
            <label for="content">Blog Content:</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="image">Image:</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php
include('../footer.php');
?>
