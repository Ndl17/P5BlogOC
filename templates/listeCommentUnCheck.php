<?php ob_start(); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <?php if ($commentsLeft == 0) { ?>
    <div class="alert alert-success" role="alert"> <?php echo $_SESSION['user']; ?>👋, Tous les commentaires ont été modérés! </div>

  <?php }else {?>
    <div class="alert alert-warning" role="alert"> <?php echo $_SESSION['user']; ?>👋, il reste <?php echo $commentsLeft; ?> commentaire(s) à moderer ! </div>

  <?php } ?>
  <?php foreach ($commentUnCheckeds as $commentUnChecked){ ?>
    <!-- comment Card  -->
    <div class="card mb-4">

      <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Commentaires</h6>
      </div>

      <div class="card-body">


        <div class="card mb-4 comment">
          <div class="card-header">
            <h6 class="card-title">Publié par : <strong><?php echo $commentUnChecked['pseudo']; ?></strong> </h6>
            <h6 class="card-title">Sur l'article : <strong><?php echo $commentUnChecked['titreArticle']; ?></strong> </h6>
            <hr>
          </div>
          <div class="card-body">
            <p class="card-content"> <?php echo $commentUnChecked['contentCom']; ?></p>
          </div>
          <div class="card-footer">
            <hr>
            <h6 class="card-title">Publié le : <?php echo $commentUnChecked['dateComment']; ?></h6>
            <a href="index.php?action=article&id=<?= urlencode($commentUnChecked['idArticle']) ?>"  class="btn btn-info btn-icon-split">Voir l'article</a>
          <a href="index.php?action=submitComment&id=<?= urlencode($commentUnChecked['idComment']) ?>"  class="btn btn-success btn-icon-split" onclick="refreshPage()">Valider</a>
          <a href="index.php?action=deleteComment&id=<?= urlencode($commentUnChecked['idComment']) ?>"  class="btn btn-danger btn-icon-split" onclick="refreshPage()">Supprimer</a>

          </div>
        </div>

      </div>

    </div>

  <?php } ?>




</div>


<script>
function refreshPage(){
  window.location.reload();
}
</script>

<!-- End of Main Content -->
<?php $content = ob_get_clean();?>
<?php require('layout.php') ?>
