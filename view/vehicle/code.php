<?php
$connection= mysqli_connect("localhost","root","","project");

if (isset($_POST['addCart'])) {
    $ref = $_POST['edit_id'];
    $sql = "SELECT * FROM vehicle WHERE ref = '$ref'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $product_data = $result->fetch_assoc();

        // Now, you have the product information, and you can proceed to insert it into the order table.
    } else {
        echo "Product not found.";
    }

// Assuming you have the product information in $product_data
    if ($product_data) {
        $product_ref = $product_data['ref'];
        $product_name = $product_data['name'];
        $product_type = $product_data['type'];
        $product_caract = $product_data['caract'];
        $product_details = $product_data['details'];
        $product_state = $product_data['state'];
        $product_img = $product_data['img'];
        $product_prixM = $product_data['prixM'];
        $product_idL = $product_data['idL'];
        $product_idC = $product_data['idC'];

        // Insert the product information into the order table
        $sql_insert = "INSERT INTO cart (ref, name, type, img,caract, details, state, prixM, idL, idC) 
               VALUES ('$product_ref', '$product_name', '$product_type','$product_img', '$product_caract', '$product_details', '$product_state', '$product_prixM', 0, 0)";

        if ($connection->query($sql_insert) === TRUE) {
            echo "Product added to the order successfully.";
            echo "<script>window.location.href = '../../index.php?controller=vehicle&action=getVehicles';</script>";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $connection->error;
            echo "<script>window.location.href = '../../index.php?controller=vehicle&action=getVehicles';</script>";
        }
    }


}
// Delete Admin profile
if (isset($_POST['delete_product_btn'])){
    $product_ref = $_POST['ref'];

    $query="DELETE FROM `cart` WHERE `cart`.`ref` ='$product_ref'";

    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        echo "<script>window.location.href = '../../index.php?controller=user&action=cart';</script>";
    } else {
        echo "<script>window.location.href = '../../index.php?controller=user&action=cart';</script>";
    }
}

?>