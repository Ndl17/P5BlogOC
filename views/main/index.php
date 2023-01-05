
<div class="card">
  <?php  if (isset($_SESSION['user'])) {
    ?>
    <div class="alert alert-success" role="alert">Bienvenue <?php echo $_SESSION['user']['pseudo']; ?> 👋, passez une bonne journée ! </div>
  <?php } ?>

  <div class="card-body">
    <h5 class="card-title" style="text-align:center;">Présentation</h5>
    <h6 class="card-subtitle text-muted" style="text-align:center;">Créateur du Site</h6>
  </div>
  <img class="img-fluid" id="imgHome" src="../assets/img/avatars/undraw_profile_2.svg" alt="Card image cap" />
  <div class="card-body" id="textCard">
    <h7 class="card-text">Julien Nadal</h7><br>
    <h7 class="card-text">étudiant développeur PHP / Symfony chez OpenClassrooms</h7><br>
    <a href="/assets/img/illustrations/cv.pdf" class="card-link">Mon CV</a>
  </div>
</div>

<div class="card" id="contactCard">
  <div class="card-body">
    <?php echo $contactForm; ?>
      </div>
    </div>
