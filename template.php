<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
  <div id="wrapper">

    <header>
      <nav>
        <ul class="navbar-nav container navbar mt-2 d-flex flex-column gap-1 flex-md-row justify-content-center">

          <li id="ajouter" class="nav-item w-auto">
            <a href="index.php" class="btn btn-primary"> Ajouter produit </a>
          </li>

          <li id="panier" class="nav-item w-auto">

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

    <?= $content ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>

</html>