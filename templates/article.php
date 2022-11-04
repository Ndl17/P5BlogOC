

<style>
.comment{
  background: linear-gradient(114deg, rgb(95 97 230 / 16%) 0%, rgb(231 107 107 / 28%) 100%);
}

hr{
  margin-top: 8px !important;
  margin-bottom: 8px !important;
  border: 0 !important;
  height: 1px !important;
  background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0))!important;
}
</style>


<?php ob_start(); ?>
<!-- Begin Page Content -->




<!-- article Card  -->
<div class="card  mb-4">




    <div class="card-header py-3">

      <h6 class="m-0 font-weight-bold text-primary"><?php echo $articleId["title"]; ?></h6>
      <h8 class="m-0 font-weight-bold text"><?php echo $articleId["chapo"]; ?></h8>
    </div>


    <div class="card-body">
      <p style="font-weight:bold"><?php echo $articleId["content"]; ?></p>
    </div>


    <div class="card-body">
      <h6>Publié le: <?php echo $articleId["date"]; ?></h6>
        <h6 class="card-title">Ecrit par: <?php echo $articleAuthor[0]['pseudo']; ?></h6>
    </div>
    </div>




<!-- comment Card  -->
<div class="card mb-4">

  <div class="card-header">
    <h6 class="m-0 font-weight-bold text-primary">Commentaires</h6>
  </div>
  <div class="card-body">
    <?php foreach ($commentId as $comment): ?>
      <div class="card mb-4 comment">
        <div class="card-header">
          <h6 class="card-title">Publié par : <strong><?php echo $comment['pseudo']; ?></strong> </h6>
          <hr>
        </div>
        <div class="card-body">
          <p class="card-content"> <?php echo $comment['contentCom']; ?></p>
        </div>
        <div class="card-footer">
          <hr>
          <h6 class="card-title">Publié le : <?php echo $comment['dateComment']; ?></h6>
        </div>
      </div>


    <?php endforeach; ?>
  </div>

</div>


<!-- add comment Card  -->
<?php  if (isset($_SESSION['user'])) { ?>
  <?php if ($_SESSION['typeUser'] =='Admin'||$_SESSION['typeUser'] =='User') {  ?>

<div class="card mb-4">

  <div class="card-header">
    <h6 class="m-0 font-weight-bold text-primary">Publier un commentaire</h6>
  </div>
  <div class="card-body">

    <form action="index.php?action=addComment&id=<?= $articleId['idArticle'] ?>" method="post">
      <div class="mb-3">
        <label class="form-label" for="basic-icon-default-fullname">Pseudo</label>
        <div class="input-group input-group-merge">
          <span id="basic-icon-default-fullname2" class="input-group-text"
          ><i class="bx bx-user"></i
            ></span>
            <input
            type="text"
            class="form-control"
            id="author"
            name="author"
            aria-describedby="basic-icon-default-fullname2"
            readonly="readonly"
            value="<?php echo $_SESSION['user']; ?>"
            />
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-icon-default-message">Message</label>
          <div class="input-group input-group-merge">
            <span id="basic-icon-default-message2" class="input-group-text"
            ><i class="bx bx-comment"></i
              ></span>
              <textarea
              id="comment"
              name="comment"
              class="form-control"
              placeholder="Tapez votre texte ici !"
              aria-label="Hi, Do you have a moment to talk Joe?"
              aria-describedby="basic-icon-default-message2"
              ></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Valider</button>
        </form>


      </div>

    </div>

<?php } ?>
<?php } ?>


    <!-- End of Main Content -->
    <?php $content = ob_get_clean();?>
    <?php require('layout.php') ?>
    </html>
