<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter produit</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
  <div id="wrapper" class="">
    <header>

      <nav>
        <ul class="navbar-nav container navbar mt-2 d-flex flex-column gap-1 flex-md-row justify-content-center">

          <li id="ajouter" class="nav-item">
            <a class="btn btn-primary"> Ajouter produit </a>
          </li>

          <li id="panier" class="nav-item">

            <a href="recap.php" class="btn btn-light text-primary position-relative">
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

    <main class="mt-2 d-flex flex-column gap-5 flex-md-column justify-content-center align-items-center">
      <h1 class="mt-5 text-primary">Ajouter produit</h1>

      <form action="traitement.php?action=add" method="post" class="d-flex flex-column mb-3">
        <div class="mb-3">
          <label for="name" class="form-label">
            Nom du produit :
            <input type="text" id="name" name="name" class="ms-3 form-control">
          </label>
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">
            Prix du produit :
            <input type="number" id="price" step="any" name="price" class="ms-3 form-control">
          </label>
        </div>

        <div class="mb-3">
          <label for="qtt" class="form-label">
            Quantité désirée :
            <input type="number" id="qtt" name="qtt" value="1" class="ms-3 form-control">
          </label>
        </div>

        <input type="submit" name="submit" value="Ajouter le produit" class="btn btn-primary align-self-center">

      </form>

      <?php  
    if(isset($_SESSION['validatorMessage'])) {
      echo $_SESSION['validatorMessage'];
      unset($_SESSION['validatorMessage']);
    }
    ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
  </div>
</body>


</html>


<?php ;