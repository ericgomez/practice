<?
class Login extends SessionController
{

  public function __construct(){
    parent::__construct();
    $this->view->message = "";

  }

  public function render(){
    $this->view->render('login/index');
  }

  function authenticate(){
    if ($this->existPOST(['username', 'password'])) {
      $username = $this->getPost('username');
      $password = $this->getPost('password');

      //validate data
      if ($username == '' || empty($username) || $password == '' || empty($password)) {
        $this->view->message = "Los campos no pueden estar vacios";
        $this->render();
        return;
      }

      $user = $this->model->login($username, $password);

      if ($user != null) {
        $this->initialize($user);
      } else {
        $this->view->message = "Usuario o contraseña incorrectos";
        $this->render();
        return;
      }
    } else {
      $this->view->message = "Todos los campos son obligatorios";
      $this->render();
    }
  }

}
