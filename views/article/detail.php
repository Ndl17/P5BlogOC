
<style>
.comment{
  background: linear-gradient(114deg, rgb(95 97 230 / 16%) 0%, rgb(231 107 107 / 28%) 100%);
}

.com{
  margin-top: 8px !important;
  margin-bottom: 8px !important;
  border: 0 !important;
  height: 1px !important;
  background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0))!important;
}


.art1{
  margin-bottom: -6px;
margin-top: -11px;
}

.art2{
  margin-bottom: -6px;
margin-top: -11px;
}

.artFoot {
   margin-top: -13px;
}

#artContent{
  padding-top: 10px !important;
  border: 2px solid #f2f2f2;
  background-color: #f5f5f9;
  /* border-block-style: initial; */
  /* border: inset; */
  padding: inherit;
  border-radius: 8px;
  box-shadow: -1px 7px 11px -6px #00000029;
}

button.btn.btn-primary {
    margin-top: 8px;
}
</style>


<!-- Begin Page Content -->

<!-- article Card  -->

<?php if(!empty($_SESSION['message'])): ?>
  <div class="alert alert-success" role="alert">
    <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
  </div>
<?php endif; ?>

<div class="card  mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"><?php echo $articles->title; ?></h6>
    <h8 class="m-0 font-weight-bold text"><?php echo $articles->chapo; ?></h8>
  </div>
  <hr class="art1">
  <div class="card-body">
    <p  id="artContent" style="font-weight:bold"><?php echo $articles->content; ?></p>
  </div>
    <hr class="art2">
  <div class="card-body">
    <h6>Publié le: <?php echo substr($articles->date,0,10); ?></h6>
    <h6 class="card-title artFoot">Ecrit par: <?php echo $articleAuthor->pseudo; ?></h6>
  </div>
</div>

<!-- comment Card  -->
<div class="card mb-4">
  <div class="card-header">
    <h6 class="m-0 font-weight-bold text-primary">Commentaires</h6>
  </div>
  <div class="card-body">
    <?php foreach ($comments as $comment): ?>
      <div class="card mb-4 comment">
        <div class="card-header">
          <h6 class="card-title">Publié par : <strong><?php echo $comment->pseudo; ?></strong> </h6>
          <hr class="com">
        </div>
        <div class="card-body">
          <p class="card-content"> <?php echo $comment->contentCom; ?></p>
        </div>
        <div class="card-footer">
          <hr class="com">
          <h6 class="card-title">Publié le : <?php echo substr($comment->dateComment,0,10);?></h6>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- add comment Card  -->
<div class="card mb-4">
  <div class="card-header">
    <h6 class="m-0 font-weight-bold text-primary">Publier un commentaire</h6>
  </div>
  <div class="card-body">
    <?php  if (isset($_SESSION['user'])) { ?>
      <?php echo $commentaireForm;?>
    <?php } ?>
    <?php if (empty($_SESSION['user'])) { ?>
      <div class="alert alert-danger" role="alert">
        <strong>Vous devez être connecté(e) pour pouvoir commenter cet article !</strong>
      </div>
    <?php } ?>
  </div>
</div>

<?php// } ?>



<!-- End of Main Content -->
