<?php
    require './config/connection.php';

    $order_data = json_decode(file_get_contents("php://input"));

    function debug_to_console($data) {
      $output = $data;
      if (is_array($output))
          $output = implode(',', $output);

      echo "<script>console.log('Debug Objects: " . $output . "' );</script>";

      };

      $arrayProductsId = array();

      $i = 0;
      //Insert all products from the order
      foreach ($order_data->products as $product) {
        $songId = $product->product_id;
        $productName = $product->product_name;
        $productPrice = $product->product_price;
        $productQuantity = $product->product_quantity;
        $sql = "INSERT INTO product (songId, product_name, product_price, product_quantity) VALUES ('$songId','$productName','$productPrice','$productQuantity')";
        $result = mysqli_query($mysqli, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($mysqli), E_USER_ERROR);
        echo $result;
        $currentProductId = mysqli_insert_id($mysqli);
        array_push($arrayProductsId, $currentProductId);
        $i++;
      }

      //Create a new order
      $userId = $order_data->userData[0]->id;
      $userName = $order_data->userData[0]->userName;
      $totalToPay = $order_data->userData[0]->totalPayment;
      $status = "Canceled";

      $sql = "INSERT INTO orders (userId, userName, status, total_to_pay) VALUES ('$userId','$userName','$status','$totalToPay')";
      $result = mysqli_query($mysqli, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($mysqli), E_USER_ERROR);
      echo $result;
      $orderId = mysqli_insert_id($mysqli);

      //insert product and order in order_has_product table which relates them
      foreach ($arrayProductsId as $productId) {
        $currrentProductId = $productId;
        $sql = "INSERT INTO order_has_products (idOrder, idProduct) VALUES ('$orderId','$productId')";
        $result = mysqli_query($mysqli, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($mysqli), E_USER_ERROR);
        echo $result;
        $currentProductId = mysqli_insert_id($mysqli);
        array_push($arrayProductsId, $currentProductId);
      }



 ?>
