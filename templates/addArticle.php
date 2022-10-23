

<style>
#title{
  height:38px;
}

#chapo{
  height:38px;
}

#content{
  height:180px;
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
    <form action="index.php?action=addArticle" method="post">
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
            aria-label="John Doe"
            aria-describedby="basic-icon-default-fullname2"
            value="<?php echo $_SESSION["user"];  ?>"
            readonly="readonly"
            />

          </div>
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-icon-default-message">Titre</label>
          <div class="input-group input-group-merge">
            <span id="basic-icon-default-title" class="input-group-text"
            ><i class="bx bx-comment"></i
              ></span>
              <textarea
              id="title"
              name="title"
              class="form-control text"
              placeholder="Saisissez votre titre"
              aria-describedby="basic-icon-default-message2"
              required
              ></textarea>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-message">Chapô</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-chapo" class="input-group-text"
              ><i class="bx bx-comment"></i
                ></span>
                <textarea
                id="chapo"
                name="chapo"
                class="form-control text"
                placeholder="Saisissez un chapô"
                aria-describedby="basic-icon-default-message2"
                required
                ></textarea>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label" for="basic-icon-default-message">Contenu</label>
              <div class="input-group input-group-merge">
                <span id="basic-icon-default-content" class="input-group-text"
                ><i class="bx bx-comment"></i
                  ></span>
                  <textarea
                  id="content"
                  name="content"
                  class="form-control text"
                  placeholder="Saisissez votre contenu"
                  aria-describedby="basic-icon-default-message2"
                  required
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
