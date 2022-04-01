<?

require_once('classes/session.php');

class SessionController extends Controller {
  private $session;
  private $user;

  public function __construct() {
    parent::__construct();
    $this->init();
  }

  public function init() {
    $this->session = new Session();

    $this->validateSession();
  }

  public function validateSession() {
    $currentURL = $this->getCurrentPage();

    // check if session exists
    if ($this->existsSession()) {
      if ($currentURL !== 'customer') {
        header('Location: '. constant('URL') .'/customer');
      } 
    } else {
      if ($currentURL === 'customer') {
      // not exists session
      header('Location: '. constant('URL') . '');
      } 
    }
  }

  public function getCurrentPage() {
    $actualLink = trim($_SERVER['REQUEST_URI']);
    $url = explode('/', $actualLink);

    return $url[2];
  }

  public function existsSession() {
    if (!$this->session->exists()) return false;
    if ($this->session->getCurrentUser() == null) return false;
    
    $userId = $this->session->getCurrentUser();

    if ($userId) return true;

    return false;
  }

  public function getUserSessionData() {
    $id = $this->session->getCurrentUser();

    $this->user = new UserModel();
    $this->user->getById($id);

    return $this->user;
  }

  public function initialize($user){
    $this->session->setCurrentUser($user->getId());

    $this->redirect('customer', []);
}


  function logout(){
      $this->session->closeSession();
  }
}