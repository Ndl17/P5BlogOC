




<?php ob_start(); ?>
<!-- Begin Page Content -->
<div class="container-fluid">


  <?php foreach ($articles as $article) { ?>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo $article["title"]; ?></h6>
      </div>
      <div class="card-body">
        <p style="font-weight:bold"><?php echo $article["chapo"]; ?></p>

     <a href="index.php?action=article&id=<?= urlencode($article['idArticle']) ?>" class="btn btn-info btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-info-circle"></i>
        </span>
        <span class="text">En savoir plus</span>
      </a>

    </div>
  </div>

<?php } ?>




</div>

<!-- End of Main Content -->
<?php $content = ob_get_clean();?>
<?php require('layout.php') ?>
</html>
