<?php
  require '../partials/header.php';
?>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
  <main class="form-signin w-100 m-auto">
    <form action="/register" method="POST">
      <h1 class="h3 mb-3 fw-normal">Registro</h1>
      <?php if (isset($registrationError)): ?>
          <p style="color: red;"><?php echo $registrationError; ?></p>
      <?php endif; ?>
      <div class="form-floating">
        <input type="name" class="form-control" id="name" placeholder="name@example.com" name="name">
        <label for="floatingInput">Nombre</label>
      </div>
      <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
        <label for="floatingInput">Correo</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
        <label for="floatingPassword">Contraseña</label>
      </div>
      <button class="btn btn-primary w-100 py-2" type="submit">Registrarse</button>
      <p class="mt-5 mb-3 text-body-secondary">© 2017–2024</p>
    </form>
    <footer class="footer mt-auto py-3 bg-body-tertiary">
      <div class="container-footer">
        <span class="text-body-secondary">{Prueba Tecnica}.</span>
      </div>
    </footer>
  </main>
<?php
  require '../partials/footer.php';
?>
