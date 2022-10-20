


<style>



</style>


<?php ob_start(); ?>


<div class="card">
  <?php  if (isset($_SESSION['user'])) {
    ?>
    <div class="alert alert-success" role="alert">Bienvenue <?php echo $_SESSION['user']; ?> 👋, passez une bonne journée ! </div>


  <?php } ?>
  <div class="card-body">

    <h5 class="card-title" style="text-align:center;">Présentation</h5>
    <h6 class="card-subtitle text-muted" style="text-align:center;">Créateur du Site</h6>
  </div>
  <img class="img-fluid" id="imgHome" src="../assets/img/avatars/undraw_profile_2.svg" alt="Card image cap" />
  <div class="card-body" id="textCard">
    <h7 class="card-text">Julien Nadal</h7><br>
    <h7 class="card-text">étudiant développeur PHP / Symfony chez OpenClassrooms</h7><br>
    <a href="javascript:void(0);" class="card-link">Mon CV</a>
  </div>
</div>




<div class="card" id="contactCard">

  <div class="card-body">

    <form>
      <div class="mb-3">
        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
        <div class="input-group input-group-merge">
          <span id="basic-icon-default-fullname2" class="input-group-text"
          ><i class="bx bx-user"></i
            ></span>
            <input
            type="text"
            class="form-control"
            id="basic-icon-default-fullname"
            placeholder="John Doe"
            aria-label="John Doe"
            aria-describedby="basic-icon-default-fullname2"
            />
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-icon-default-email">Email</label>
          <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-envelope"></i></span>
            <input
            type="text"
            id="basic-icon-default-email"
            class="form-control"
            placeholder="john.doe"
            aria-label="john.doe"
            aria-describedby="basic-icon-default-email2"
            />
            <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
          </div>
          <div class="form-text">You can use letters, numbers & periods</div>
        </div>
        <div class="mb-3">
          <label class="form-label" for="basic-icon-default-message">Message</label>
          <div class="input-group input-group-merge">
            <span id="basic-icon-default-message2" class="input-group-text"
            ><i class="bx bx-comment"></i
              ></span>
              <textarea
              id="basic-icon-default-message"
              class="form-control"
              placeholder="Hi, Do you have a moment to talk Joe?"
              aria-label="Hi, Do you have a moment to talk Joe?"
              aria-describedby="basic-icon-default-message2"
              ></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Send</button>
        </form>
      </div>
    </div>






    <?php $content = ob_get_clean();?>
    <?php require('layout.php') ?>
    </html>
