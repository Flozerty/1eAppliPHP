<?php

session_start();

if(isset($_POST['submit'])){

  // $name = filter_input(INPUT_POST,'name', FILTER_SANITIZE_STRING); (deprecated)
  $name = htmlspecialchars($_POST['name']);
  $price = filter_input(INPUT_POST,'price', FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $qtt = filter_input(INPUT_POST,'qtt', FILTER_VALIDATE_INT);

  if($name && $price && $qtt) {
    $product = [
      'name'=> $name,
      'price'=> $price,
      'qtt'=> $qtt,
      'total' => $qtt * $price
    ];

    // initialisation  de la clé "products" si elle est inexistante dans le tableau de $_SESSION, puis, ajoute le "product" dans le tableau.
    $_SESSION['products'][] = $product;
  }
}

header('Location:index.php');