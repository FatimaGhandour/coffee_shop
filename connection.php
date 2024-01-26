<?php
define("db_SERVER", "localhost");
define("db_USER", "root");
define("db_PASSWORD", "");
define("db_DATABASE", "fusion_cafe");
$con =  mysqli_connect(db_SERVER, db_USER, db_PASSWORD, db_DATABASE);
if(!$con){
    die('Could not connect: ' . mysql_error());
}
// Function to get items for the about page
function getItemsForAboutPage() {
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