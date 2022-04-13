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

    <div class="container mt-5">
    <div class="col-6 mx-auto">
        <div class="card">
          <div class="card-header">
            Nuevo Cliente
          </div>
          <div class="card-body">
            <div><?php echo $this->message ?  $this->message : '' ?></div>

            <form id="add-form" method="POST">
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

              <button type="submit" class="btn btn-success">Registrar Cliente</button>
            </form>
          </div>
        </div>
      </div>
  </div>

  <script>
    const d = document,
      $addForm = d.getElementById('add-form')
      // $addInputs = d.querySelectorAll('#add-form input')

    $addForm.addEventListener('submit', e => {
      e.preventDefault()

      let names = e.target.names.value,
        lastName = e.target.lastName.value,
        lastName2 = e.target.lastName2.value,
        address = e.target.address.value,
        email = e.target.email.value

        console.log(e.target);


      if (
        names === '' ||
        lastName === '' ||
        lastName2 === '' ||
        address === '' ||
        email === ''
      ) {
        alert('Todos los campos son obligatorios')
        return
      }

      fetch('http://localhost:8080/practice/customer/newCustomer', {
        method: 'POST',
        body: new FormData(e.target)
      })
        .then(res => (res.ok ? res.json() : Promise.reject(res)))
        .then(json => {
          console.log(json)

          // if (json.status === 'success') {

            
          // }

          // $addForm.reset()
        })
        .catch(err => {
          console.log(err)
          const message =
            err.statusText || 'There was an error sending, please try again'

          //$response.innerHTML = `<p>Error ${err.status}: ${message}</p>`;
        })
        .finally(() => {
          // setTimeout(() => {
          //   $response.classList.add('none');
          //   $response.innerHTML = '';
          // }, 3000)
        })
  })
  </script>
</body>
</html>