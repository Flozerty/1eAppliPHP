<?php
session_start();
ob_start();

$title = "Ajout produit";
$active = "main"
?>


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
        Prix du produit en € :
        <input type="number" id="price" min="0" step="0.01" name="price" class="ms-3 form-control">
      </label>
    </div>

    <div class="mb-3">
      <label for="qtt" class="form-label">
        Quantité désirée :
        <input type="number" id="qtt" name="qtt" min="1" value="1" class="ms-3 form-control">
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

<?php 

$content = ob_get_clean();

require_once "template.php"; ?>