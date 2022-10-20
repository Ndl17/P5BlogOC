

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






<!-- add comment Card  -->

<div class="card mb-4">

  <div class="card-header">
    <h6 class="m-0 font-weight-bold text-primary">Ajouter un nouvel article</h6>
  </div>
  <div class="card-body">

<form action="index.php?" method="post">
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
            placeholder="John Doe"
            aria-label="John Doe"
            aria-describedby="basic-icon-default-fullname2"
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




<!-- End of Main Content -->
<?php $content = ob_get_clean();?>
<?php require('layout.php') ?>
</html>
