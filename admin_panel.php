<?php
session_start();
include 'connection.php';

// Check if the admin is logged in
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Handle item management actions (add, edit, delete)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        switch ($_POST["action"]) {
            case "add":
                addItem($_POST["name"], $_POST["description"], $_FILES["image"]);
                break;
            case "edit":
                // Display the edit form
                $editItem = getItemById($_POST["id"]);
                break;
            case "update":
                // Update the item
                editItem($_POST["id"], $_POST["name"], $_POST["description"], $_FILES["image"]);
                break;
            case "delete":
                deleteItem($_POST["id"]);
                break;
        }
    }
}

// Fetch items from the database
$items = getItems();

// Function to get an item by ID
function getItemById($id) {
    global $con;

    $query = "SELECT * FROM items WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $editItem = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    return $editItem;
}

// Functions for item management
function addItem($name, $description, $image) {
    global $con;

    // Handle image upload
    $targetDir = "images/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

    $query = "INSERT INTO items (name, description, image) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, "sss", $name, $description, $targetFile);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function editItem($id, $name, $description, $image) {
    global $con;

    // Check if a new image is provided
    if (!empty($_FILES["image"]["name"])) {
        // Handle image upload for editing
        $targetDir = "images/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);

        // Check for errors during file upload
        if ($_FILES["image"]["error"] != UPLOAD_ERR_OK) {
            echo "File upload error: " . $_FILES["image"]["error"];
            return;
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;
        } else {
            echo "Error moving uploaded file.";
            return;
        }
    } else {
        // No new image provided, keep the existing image path
        $imagePath = $image;
    }

    $query = "UPDATE items SET name=?, description=?, image=? WHERE id=?";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, "sssi", $name, $description, $imagePath, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


function deleteItem($id) {
    global $con;

    $query = "DELETE FROM items WHERE id=?";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function getItems() {
    global $con;

    $query = "SELECT * FROM items";
    $result = mysqli_query($con, $query);

    $items = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }

    return $items;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css" />
    <title>Admin Panel</title>
</head>

<body>
<div class="login_title"> 
    <h2>Welcome, Admin!</h2>
</div>

    <!-- Add Item Form -->
    
    <form class="feedback-form" method="post" action="" enctype="multipart/form-data">
    <div class="added_title"> <h3>Add Item</h3></div>
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="description">Description:</label>
        <input type="text" name="description" required>

        <label for="image">image:</label>
        <input type="file" name="image" accept="images/*" required>

        <input type="hidden" name="action" value="add">
        <button type="submit">Add Item</button>
    </form>

    <!-- Display Items -->
    <div class="added_title">
    <h3>Items in Stock</h3></div>
   
    <table class="added_item">
        <tr>
            <th class="items" >ID</th >
            <th class="items">Name</th >
            <th class="items">Description</th >
            <th class="items">image</th >
            <th class="items">Action</th >
        </tr>
        <?php foreach ($items as $item) : ?>
            <tr>
                <td class="items"><?= $item["id"] ?></td>
                <td class="items"><?= $item["name"] ?></td>
                <td class="items"><?= $item["description"] ?></td>
                <td class="items"><img src="<?= $item["image"] ?>" alt="<?= $item["name"] ?>"></td>
                <td class="items">
                    <!-- Edit Item Form -->
                    <form class= "admin-added-form " method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $item["id"] ?>">
                        <input type="hidden" name="action" value="edit">
                        <button type="submit">Edit</button>
                    </form>

                    <!-- Delete Item Form -->
                    <form class="admin-added-form" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $item["id"] ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Edit Item Form -->
    <?php if (isset($editItem)) : ?>
    <div class="added_title">

        <h3>Edit Item</h3></div>
        <form class="feedback-form" method="post" action="" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?= $editItem["name"] ?>" required>

            <label for="description">Description:</label>
            <input type="text" name="description" value="<?= $editItem["description"] ?>" required>

            <label for="image">Image:</label>
        <img src="<?= $editItem["image"] ?>" alt="<?= $editItem["name"] ?>" style="max-width: 100px;">
        <input type="file" name="image" accept="images/*">

            <input type="hidden" name="id" value="<?= $editItem["id"] ?>">
            <input type="hidden" name="action" value="update">
            <button type="submit">Update Item</button>
        </form>
    <?php endif; ?>
<?php include "footer.php";?>

</body>

</html>
