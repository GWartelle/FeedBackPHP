<?php
/* ----------- File upload ---------- */

$allowed_ext = array('png', 'jpg', 'jpeg', 'gif');
$message = '';

if (isset($_POST['submit'])) {
    // Check if file was uploaded
    if (!empty($_FILES['upload']['name'])) {
        $file_name = $_FILES['upload']['name'];
        $file_size = $_FILES['upload']['size'];
        $file_tmp = $_FILES['upload']['tmp_name'];
        $target_dir = "../uploads/$file_name";

        // Get file extension
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        // Validate file type/extension
        if (in_array($file_ext, $allowed_ext)) {
            // Validate file size
            if ($file_size <= 1000000) { // 1000000 bytes = 1MB
                // Upload file
                if (move_uploaded_file($file_tmp, $target_dir)) {
                    // Success message
                    $message = '<p style="color: green;">File uploaded!</p>';
                    $uploaded_file_path = $target_dir; // Store path to display the image
                } else {
                    $message = '<p style="color: red;">Failed to upload file!</p>';
                }
            } else {
                $message = '<p style="color: red;">File too large!</p>';
            }
        } else {
            $message = '<p style="color: red;">Invalid file type!</p>';
        }
    } else {
        $message = '<p style="color: red;">Please choose a file</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>

<body>
    <?php echo $message ?? null; ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
        Select image to upload:
        <br>
        <input type="file" name="upload">
        <br>
        <input type="submit" value="Submit" name="submit">
    </form>

    <?php
    // Display uploaded image if it exists
    if (!empty($uploaded_file_path)) {
        echo "<h3>Uploaded Image:</h3>";
        echo "<img src='$uploaded_file_path' alt='Uploaded Image' style='max-width: 500px; margin-top: 20px;'>";
    }
    ?>
</body>

</html>