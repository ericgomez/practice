<?

class View
{
  public function __construct()
  {
  }

  public function render($view, $data = [])
  {
    $this->data = $data;


    $this->handleMessages();

    // it is not required to validate if the file exists because 
    // the validation is done by the router (app)
    require 'views/' . $view . '.php';
  }

  private function handleMessages()
  {
    if (isset($_GET['success'])) {
      $this->data['success'] = $_GET['success'];
    } else if (isset($_GET['error'])) {
      $this->data['error'] = $_GET['error'];
    }
  }

  public function showMessages()
  {
    $this->showErrors();
    $this->showSuccess();
  }

  public function showErrors()
  {
    error_log('showErrors!'); // Logging to file
    if (array_key_exists('error', $this->data)) {
      echo '<div class="alert alert-danger" role="alert">'.$this->data['error'] .'</div>';
    }
  }

  public function showSuccess()
  {
    if (array_key_exists('success', $this->data)) {
      echo '<div class="alert alert-success" role="alert">'.$this->data['success'] .'</div>';
    }
  }
}
