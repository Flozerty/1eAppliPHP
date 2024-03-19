<?php
session_start();
ob_start();

$title = "Panier";
$activePage = "panier";
?>

<main class="container d-flex flex-column align-items-center">
  <?php
    if(!isset($_SESSION["products"]) || empty($_SESSION["products"])) {
      echo "<p class='text-center mt-4'>Aucun produit en session.</p>";
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
            <th class="text-end">
            
              <a href="traitement.php?action=clear">
                <button type="button" class="btn btn-danger">Supprimer tout</button>
              </a>
            </th>
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
          
          <td class='text-end'>
            ".number_format($product['price'], 2, ".", "&nbsp;")."&nbsp;€
          </td>

          <td class='d-flex w-100'>
            <a href='traitement.php?action=down-qtt&product=".$index."' class='me-auto'>
              <button type='button' class='btn btn-secondary'>-</button>
            </a>
            ".$product['qtt']."
            <a href='traitement.php?action=up-qtt&product=".$index."' class='ms-auto'>
              <button type='button' class='btn btn-secondary'>+</button>
            </a>
          </td>

          <td class='text-end'>
            ".number_format($product['total'], 2, ".", "&nbsp;")."&nbsp;€
          </td>

          <td class='text-end'>
            <a href='traitement.php?action=delete&product=".$index."'>
              <button type='button' class='btn btn-danger'>x</button>
            </a> 
            </td>
        </tr>";
        
  /*  number_format(
      variable à modifier,
      nombre de décimales souhaité,
      caractère séparateur décimal,
      caractère séparateur de milliers (&nbsp = espace)
      );
  */
          $totalGeneral += $product["total"];
      }

  echo" <tr>
          <td colspan=4>Total :</td>
          <td colspan=1 class='text-end'><strong>".number_format($totalGeneral, 2, ".", "&nbsp;")."&nbsp;€</strong></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  ";
    }
  echo "<div class='container w-100 d-flex justify-content-center'>";
    if(isset($_SESSION['supprMessage'])) {
      echo $_SESSION['supprMessage'];
      unset($_SESSION['supprMessage']);
    }
  echo "</div>";
    ?>

</main>

<?php $content = ob_get_clean();
require_once "template.php"; 
?>