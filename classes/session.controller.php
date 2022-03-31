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
}


  function logout(){
      $this->session->closeSession();
  }
}