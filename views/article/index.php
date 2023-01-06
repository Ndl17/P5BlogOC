
<!-- Begin Page Content -->
<div class="container-fluid">
  <?php foreach ($articles as $article): ?>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <div class="row">
          <div class="col-6">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $article->title; ?> </h6>

          </div>
          <div class="col-6">
            <h6 class="m-0 font-weight-bold  text-primary" style="text-align:end;"> Date: <?php echo substr($article->date,0,10); ?></h6>

          </div>
        </div>

      </div>
      <div class="card-body">
        <p style="font-weight:bold"><?php echo $article->chapo; ?></p>
        <a href="article/detail/<?php echo $article->id; ?>"class="btn btn-info btn-icon-split">
          <span class="icon text-white-50">
            <i class="fas fa-info-circle"></i>
          </span>
          <span class="text">En savoir plus</span>
        </a>
        <a href="/article/modifier/<?php echo $article->id; ?>" class="btn btn-warning btn-icon-split">
          <span class="icon text-white-50">
            <i class="fas fa-info-circle"></i>
          </span>
          <span class="text">Modifier</span>
        </a>

      </div>
    </div>
  <?php endforeach; ?>
</div>


<!-- End of Main Content -->
