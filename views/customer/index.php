<?php
  // $user = $this->data['user'];
  $customers = $this->data['dates'];  
?>

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

  <div class="container mt-4">
      <h1 class="text-center">Customers List</h1>
      <button type="submit" class="btn btn-success mb-2 btn-create" data-bs-toggle="modal" data-bs-target="#addModal">Nuevo cliente</button>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellido Paterno</th>
            <th scope="col">Apellido Materno</th>
            <th scope="col">Domicilio</th>
            <th scope="col">Correo</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody id="customer-list">
          <?php 
            foreach ($customers as $customer) {
              echo '<tr  data-id='. $customer->getId() .'>';
              echo '<td>' . $customer->getId() . '</td>';
              echo '<td>' . $customer->getNames() . '</td>';
              echo '<td>' . $customer->getLastName() . '</td>';
              echo '<td>' . $customer->getLastName2() . '</td>';
              echo '<td>' . $customer->getAddress() . '</td>';
              echo '<td>' . $customer->getEmail() . '</td>';
              echo '<td>';
              echo '<button type="button" class="btn btn-link btn-edit" data-bs-toggle="modal" data-bs-target="#editModal">Editar</button>';
              echo '<button type="button" class="btn btn-link text-danger btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar</button></td>';
              echo '</td>';    
              echo '</tr>';
            }
          ?>
        </tbody>
      </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="add-form">
              <input type="hidden" id="id" name="id">
              <div class="mb-3">
                <label for="names" class="col-form-label">Nombres:</label>
                <input type="text" class="form-control" id="names" name="names">
              </div>
              <div class="mb-3">
                <label for="lastName" class="col-form-label">Apellido Paterno:</label>
                <input type="text" class="form-control" id="lastName" name="lastName">
              </div>
              <div class="mb-3">
                <label for="lastName2" class="col-form-label">Apellido Materno:</label>
                <input type="text" class="form-control" id="lastName2" name="lastName2">
              </div>
              <div class="mb-3">
                <label for="address" class="col-form-label">Domicilio:</label>
                <input type="text" class="form-control" id="address" name="address">
              </div>
              <div class="mb-3">
                <label for="email" class="col-form-label">Correo electronico:</label>
                <input type="email" class="form-control" id="email" name="email">
              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Agregar Cliente</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="edit-form">
              <input type="hidden" id="id" name="id">
              <div class="mb-3">
                <label for="names" class="col-form-label">Nombres:</label>
                <input type="text" class="form-control" id="names" name="names">
              </div>
              <div class="mb-3">
                <label for="lastName" class="col-form-label">Apellido Paterno:</label>
                <input type="text" class="form-control" id="lastName" name="lastName">
              </div>
              <div class="mb-3">
                <label for="lastName2" class="col-form-label">Apellido Materno:</label>
                <input type="text" class="form-control" id="lastName2" name="lastName2">
              </div>
              <div class="mb-3">
                <label for="address" class="col-form-label">Domicilio:</label>
                <input type="text" class="form-control" id="address" name="address">
              </div>
              <div class="mb-3">
                <label for="email" class="col-form-label">Correo electronico:</label>
                <input type="email" class="form-control" id="email" name="email">
              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Modificar Cliente</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>
    

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Esta seguro que desea eliminar?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary">Eliminar</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="public/js/customer.js"></script>
  </body>
</html>