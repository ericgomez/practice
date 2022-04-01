<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Customers</title>
</head>
<body>
  <?php require 'header.php'; ?>

  <?php $this->showMessages();?>

    <div class="container mt-5">
    <div class="col-6 mx-auto">
        <div class="card">
          <div class="card-header">
            Nuevo Cliente
          </div>
          <div class="card-body">
            <form action="<?= constant('URL'); ?>/login/authenticate" method="POST">
              <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>
              <div class="mb-3">
                <label for="names" class="col-form-label">Nombres:</label>
                <input type="text" class="form-control" id="names">
              </div>
              <div class="mb-3">
                <label for="paternal" class="col-form-label">Apellido Paterno:</label>
                <input type="text" class="form-control" id="paternal">
              </div>
              <div class="mb-3">
                <label for="maternal" class="col-form-label">Apellido Materno:</label>
                <input type="text" class="form-control" id="maternal">
              </div>
              <div class="mb-3">
                <label for="domicile" class="col-form-label">Domicilio:</label>
                <input type="text" class="form-control" id="domicile">
              </div>
              <div class="mb-3">
                <label for="email" class="col-form-label">Correo electronico:</label>
                <input type="email" class="form-control" id="email">
              </div>

              <button type="submit" class="btn btn-success">Registrar Cliente</button>
            </form>
          </div>
        </div>
      </div>
  </div>
</html>