

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

<?php         var_dump($_SESSION['user']['id']);
 ?>
<!-- Begin Page Content -->
<div class="card mb-4">
  <div class="card-header">
    <h6 class="m-0 font-weight-bold text-primary">Ajouter un nouvel article</h6>
  </div>
  <div class="card-body">
    <?php echo $addArticleForm;  ?>
  </div>
</div>

<!-- End of Main Content -->
