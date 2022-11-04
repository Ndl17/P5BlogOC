




<?php ob_start(); ?>
<!-- Begin Page Content -->
<div class="container-fluid">


  <?php foreach ($articles as $article) { ?>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <div class="row">
          <div class="col-6">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $article["title"]; ?> </h6>

          </div>
          <div class="col-6">
            <h6 class="m-0 font-weight-bold  text-primary" style="text-align:end;"> Date: <?php echo substr($article["date"],0,10); ?></h6>

          </div>
        </div>

      </div>
      <div class="card-body">
        <p style="font-weight:bold"><?php echo $article["chapo"]; ?></p>

        <a href="index.php?action=article&id=<?= urlencode($article['idArticle']) ?>" class="btn btn-info btn-icon-split">
          <span class="icon text-white-50">
            <i class="fas fa-info-circle"></i>
          </span>
          <span class="text">En savoir plus</span>
        </a>
        <?php  if (isset($_SESSION['user'])) { ?>
          <?php if ($_SESSION['typeUser'] =='Admin'||$_SESSION['typeUser'] =='User') {  ?>
            <a href="index.php?action=editArticle&id=<?= urlencode($article['idArticle']) ?>" class="btn btn-warning btn-icon-split">
              <span class="icon text-white-50">
                <i class="fas fa-info-circle"></i>
              </span>
              <span class="text">Modifier</span>
            </a>
          <?php  }}?>
          <?php  if (isset($_SESSION['user'])) { ?>
            <?php if ($_SESSION['typeUser'] =='Admin') {  ?>
              <a href="index.php?action=deleteArticle&id=<?= urlencode($article['idArticle']) ?>" class="btn btn-danger btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-info-circle"></i>
                </span>
                <span class="text">Supprimer</span>
              </a>
            <?php  }}?>
          </div>

        </div>

      <?php } ?>




    </div>

    <!-- End of Main Content -->
    <?php $content = ob_get_clean();?>
    <?php require('layout.php') ?>
    </html>
