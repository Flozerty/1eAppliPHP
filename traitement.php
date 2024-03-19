<?php

session_start();


$id = isset($_GET['product']) ? $_GET['product'] : null;
$message = "";
$type = "";

if(isset($_GET['action'])){

  switch($_GET['action']) {
    case 'add': {
      $name = filter_input(INPUT_POST,'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
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
    
        $type = "success";
        $message = 'Votre produit a bien été ajouté au panier.';
      } else {
        $type = "danger";
        $message = "Un problème est survenu lors de la récupération des articles. Veuillez réessayer.";
      }
    
      $_SESSION['validatorMessage'] = '
      <div class="alert alert-'.$type.' alert-dismissible align-self-center w-50" role="alert">
        <p>'.$message.'</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

      header('Location:index.php');
      break;
    };
        
    case'up-qtt': {
      $_SESSION["products"][$id]['qtt'] +=1;
      $_SESSION["products"][$id]['total'] += $_SESSION["products"][$id]['price'];
      
      header('Location:recap.php');
      break;
    };
    
    case'down-qtt': {
      if ($_SESSION["products"][$id]['qtt'] > 1) {

        $_SESSION["products"][$id]['qtt'] -=1;
        $_SESSION["products"][$id]['total'] -= $_SESSION["products"][$id]['price'];

        header('Location:recap.php');
        break;
      } ;
    };
    
    case'delete': {
      
      $_SESSION['supprMessage'] = '
      <div class="alert alert-danger alert-dismissible align-self-center w-50" role="alert">
        <p>Votre article '.$_SESSION["products"][$id]['name']." a bien été supprimé du panier.<p>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      
      unset($_SESSION["products"][$id]);
      header('Location:recap.php');
      break;
    };

    case'clear': {
      unset($_SESSION["products"]);
      header('Location:recap.php');
      break;
    };
  }
}