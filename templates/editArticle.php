<?php ob_start(); ?>
<!-- Begin Page Content -->






<div class="card mb-4">

  <div class="card-header">
    <h6 class="m-0 font-weight-bold text-primary">Modifier l'article: <?php echo $articleId["title"]; ?></h6>
  </div>
  <div class="card-body">
    <form action="index.php?action=submitEdit&id=<?= urlencode($articleId['idArticle']) ?>" method="post">
        <div class="mb-3">
          <label for="exampleFormControlSelect1" class="form-label">Pseudo</label>
          <select class="form-select" id="authorSelect" aria-label="Default select example" name="author">

            <option selected name='author' value='<?php echo $authorArticles[0]['id']; ?>'  ><?php echo $authorArticles[0]['pseudo']; ?></option>

<?php foreach ($userPseudos as $userPseudo) { ?>


            <option name='author' value="<?php echo $userPseudo['id']; ?>"><?php echo $userPseudo['pseudo']; ?></option>
            <?php }  ?>
          </select>
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
              value=""
              required
              ><?php echo $articleId["title"]; ?></textarea>
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
                ><?php echo $articleId["chapo"]; ?></textarea>
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
                  ><?php echo $articleId["content"]; ?></textarea>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Valider</button>
            </form>


          </div>

        </div>


        <!-- add comment Card  -->




        <!-- End of Main Content -->
        <?php $content = ob_get_clean();?>
        <?php require('layout.php') ?>
