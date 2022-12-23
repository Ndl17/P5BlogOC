<!-- Begin Page Content -->



<div class="container-fluid">

  <?php if(!empty($_SESSION['message'])): ?>
    <div class="alert alert-success" role="alert">
      <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
    </div>
  <?php endif; ?>
  
  <?php if ($countComments == 0) { ?>
    <div class="alert alert-success" role="alert"> <?php echo $_SESSION['user']['pseudo']; ?>👋, Tous les commentaires ont été modérés! </div>

  <?php }else {?>
    <div class="alert alert-warning" role="alert"> <?php echo $_SESSION['user']['pseudo']; ?>👋, il reste <?php echo $countComments ?> commentaire(s) à moderer ! </div>

  <?php } ?>
  <?php foreach ($comments as $comment){ ?>
    <!-- comment Card  -->
    <div class="card mb-4">

      <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Commentaires</h6>
      </div>

      <div class="card-body">


        <div class="card mb-4 comment">
          <div class="card-header">
            <h6 class="card-title">Publié par : <strong><?php echo $comment->pseudo; ?></strong> </h6>
            <h6 class="card-title">Sur l'article : <strong><?php echo $comment->title; // echo $commentUnChecked['titreArticle']; ?></strong> </h6>

            <hr>
          </div>
          <div class="card-body">
            <p class="card-content"> <?php echo $comment->contentCom; ?></p>
          </div>
          <div class="card-footer">
            <hr>
            <h6 class="card-title">Publié le : <?php echo $comment->dateComment;; ?></h6>
            <a href="/article/detail/<?php echo $comment->idArticle; ?>"  class="btn btn-info btn-icon-split">Voir l'article</a>
            <a href="/admin/checkComment/<?php echo $comment->idComment; ?>"  class="btn btn-success btn-icon-split" onclick="refreshPage()">Valider</a>
            <a href="/admin/deleteComment/<?php echo $comment->idComment; ?>"  class="btn btn-danger btn-icon-split" onclick="refreshPage()">Supprimer</a>

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
