<?php

session_start();
include('../../config/function.php');

if(!isset($_SESSION['productItems'])){
    $_SESSION['productItems'] = [];
}
if(!isset($_SESSION['productItemsIds'])){
    $_SESSION['productItemsIds'] = [];
}

if(isset($_POST['addItem'])){
    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']);

    $checkProduct = mysqli_query($conn, "SELECT * FROM products WHERE id='$productId' LIMIT 1");
    if($checkProduct && mysqli_num_rows($checkProduct) > 0){
        
        $row = mysqli_fetch_assoc($checkProduct);
        if ($quantity > $row['quantity']) {
            redirect('orders-create.php', 'Only ' . $row['quantity'] . ' quantity available!');
        }

        $productData = [
            'product_id' => $row['id'],
            'name' => $row['name'],
            'image' => $row['image'],
            'price' => $row['price'],
            'quantity' => $quantity,
        ];

            if(!in_array($row['id'], $_SESSION['productItemsIds'])){

                array_push($_SESSION['productItemsIds'], $row['id']);
                array_push($_SESSION['productItems'], $productData);
            }else{

                foreach($_SESSION['productItems'] as $key => $prodSessionItem){
                    if($prodSessionItem['product_id'] == $row['id']){

                        $newQuantity = $prodSessionItem['quantity'] + $quantity;

                        $productData = [
                            'product_id' => $row['id'],
                            'name' => $row['name'],
                            'image' => $row['image'],
                            'price' => $row['price'],
                            'quantity' => $newQuantity,
                        ];
                        $_SESSION['productItems'][$key] = $productData;
                    }    
                }     
            }
            redirect('orders-create.php', 'Product Added Successfully! ' .$row['name']);
            
         }else{
            redirect('orders-create.php', 'Product Not Found!');
         } 
        
    }else{
        redirect('orders-create.php', 'Something Went Wrong!');
        }

if(isset($_POST['productIncDec'])) {

    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']);
    
    $flag = false;
    foreach($_SESSION['productItems'] as $key => $item) {
        if($item['product_id'] == $productId){

            $flag = true;        
            $_SESSION['productItems'][$key]['quantity'] = $quantity;
        }
    }
    
    if($flag){

        jsonResponse(200, 'success', 'Product Quantity Updated Successfully!');
    }else{

        jsonResponse(500, 'error', 'Something Went Wrong. Plese re-fresh the page!');
    }
}
        
?>