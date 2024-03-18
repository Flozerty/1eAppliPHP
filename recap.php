<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <title>Récapitulatif des produits</title>
</head>

<body>
  <header>
    <nav>
      <ul class="navbar-nav container navbar mt-2 d-flex flex-column gap-1 flex-md-row justify-content-center">

        <li id="ajouter" class="nav-item">
          <a href="index.php" class="btn btn-light text-primary"> Ajouter produit </a>
        </li>

        <li id="panier" class="nav-item">

          <a href="#" class="btn btn-primary position-relative">
            Panier
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              <?php 
                if(!isset($_SESSION["products"]) || empty($_SESSION["products"])) {
                  echo 0;
                } else {
                  $sum = 0;
                  foreach($_SESSION["products"] as $index => $product) {
                    $sum += $product['qtt'];
                  }
                  $sum >= 100 ? $nbReturn = "99+" : $nbReturn = $sum;
                  echo $nbReturn;
                };
                ?>
            </span>
          </a>
        </li>
      </ul>
    </nav>
  </header>

  <?php
  if(!isset($_SESSION["products"]) || empty($_SESSION["products"])) {
    echo "<p>Aucun produit en session.</p>";
  } else {
  echo'
  <table class="table">
    <thead>
        <tr class="text-center">
          <th>#</th>
          <th>Nom</th>
          <th>Prix</th>
          <th>Quantité</th>
          <th>Total</th>
          <th class="text-end"><button type="button" class="btn btn-danger">Supprimer tout</button></th>
        </tr>
    </thead>
    <tbody>
  ';
  $totalGeneral = 0;
    foreach($_SESSION["products"] as $index => $product) {
      echo"
      <tr>
        <td>$index</td>
        <td>".$product['name']."</td>
        
        <td>
          ".number_format($product['price'], 2, ".", "&nbsp;")."&nbsp;€
        </td>

        <td class='d-flex w-100'>
          <button type='button' class='btn btn-secondary me-auto'>-</button>
          ".$product['qtt'].'
          <button type="button" class="btn btn-secondary align-self-end ms-auto">+</button>
        </td>

        <td class="text-end">'.number_format($product['total'], 2, ".", "&nbsp;")."&nbsp;€</td>

        <td class='text-end'><button type='button' class='btn btn-danger'>x</button></td>
      </tr>
      ";
/*      number_format(
        variable à modifier,
        nombre de décimales souhaité,
        caractère séparateur décimal,
        caractère séparateur de milliers (&nbsp = espace)
        );*/
        $totalGeneral += $product["total"];
    }

echo"
      <tr>
        <td colspan=4>Total :</td>
        <td><strong>".number_format($totalGeneral, 2, ".", "&nbsp;")."&nbsp;€</strong></td>
      </tr>
    </tbody>
  </table>
";
  }
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>

</body>

</html>