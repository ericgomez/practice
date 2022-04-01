<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= constant('URL'); ?>/public/css/login.css">
</head>

<body>

    <?php require 'views/header.php'; ?>
    <?php $this->showMessages();?>

    <div class="container mt-5">
    <div class="col-6 mx-auto">
        <div class="card">
          <div class="card-header">
            Login
          </div>
          <div class="card-body">
            <form action="<?= constant('URL'); ?>/login/authenticate" method="POST">
              <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>
              <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" name="username" id="username">
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" name="password" id="password">
              </div>

              <button type="submit" class="btn btn-success">Login</button>
            </form>
          </div>
        </div>
      </div>
  </div>
</body>

</html>