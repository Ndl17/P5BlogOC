<!-- Begin Page Content -->
<?php if(!empty($_SESSION['message'])): ?>
  <div class="alert alert-success" role="alert">
    <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
  </div>
<?php endif; ?>
<div class="container-fluid">
  <div class="card">
    <h5 class="card-header">Liste des Articles à modérer</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>Titre</th>
            <th>Chapô</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php foreach ($articles as $article): ?>
            <tr>
              <td><?php echo $article->title; ?></td>
              <td><?php echo substr($article->chapo,0,25).'...'; ?></td>
              <td><?php echo substr($article->date,0,10);; ?></td>
              <td> <a class="btn btn-primary" href="/article/detail/<?php echo $article->id ?>">Consulter</a> </td>
              <td> <a class="btn btn-danger" href="/admin/deleteArticle/<?php echo  $article->id?>">Supprimer</a> </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
function refreshPage(){
  window.location.reload();
}
</script>

<!-- End of Main Content -->
