<?

class UserModel extends Model implements IModel
{

  private $id;
  private $username;
  private $password;

  public function __construct()
  {
    parent::__construct();
    $this->username = '';
    $this->password = '';
  }

  

  public function getById($id) {
    $this->setId($id);

    try {
      $query = $this->prepare('SELECT * FROM users WHERE id = :id');
      $query->execute([
        'id' => $this->id
      ]);

      $user = $query->fetch(PDO::FETCH_ASSOC);

      $this->setId($user['id']);
      $this->setUsername($user['username']);
      $this->setPassword($user['password'], false);

      return $this;
    } catch (PDOException $e) {}
  }

  public function comparePassword($password, $id) {
    try {
      $user = $this->getById($id);

      return password_verify($password, $user->getPassword());
    } catch (PDOException $e) {
      return false;
    }
  }

  private function getHashedPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
  }

  public function save() {}
  public function getAll() {}
  public function delete($id) {}
  public function update() {}

  // Getters and setters

  public function setId($id) {             $this->id = $id; }
  public function setUsername($username) { $this->username = $username; }
  public function setPassword($password, $hash = true) { 
    if ($hash) {
      $this->password = $this->getHashedPassword($password); 
    } else {
      $this->password = $password;
    }
  }


  public function getId() {         return $this->id; }
  public function getUsername() {   return $this->username; }
  public function getPassword() {   return $this->password; }


}