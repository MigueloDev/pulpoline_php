<?php
  require '../partials/header.php';
  require '../partials/dashboard_header.php'
?>
<body>
<div class="container">
  <div class="pb-3 mb-4 border-bottom">
    <a href="/create-token" class="btn btn-dark d-flex align-items-center text-body-emphasis text-decoration-none">
      <span class="fs-4 text-white">Crear Tokens</span>
    </a>
  </div>
  <div class="row">
      <div class="col-12">
          <h1 class="h3 mb-3">Tokens</h1>
          <div class="table-responsive">
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Token</th>
                          <th scope="col">Symbol</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($tokens as $token) : ?>
                          <tr>
                              <td><?= $token['tokenId'] ?></td>
                              <td><?= $token['name'] ?></td>
                              <td><?= $token['symbol'] ?></td>
                          </tr>
                      <?php endforeach; ?>
                      <?php if (empty($tokens)) : ?>
                          <tr>
                              <td colspan="3">No hay tokens</td>
                          </tr>
                      <?php endif; ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>
  <?php
    require '../partials/footer.php';
  ?>