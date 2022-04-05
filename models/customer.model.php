<?

class CustomerModel extends Model implements IModel
{

  private $id;
  private $names;
  private $lastName;
  private $lastName2;
  private $address;
  private $email;

  public function __construct()
  {
    parent::__construct();
    $this->names = '';
    $this->lastName = '';
    $this->lastName2 = '';
    $this->address = '';
    $this->email = '';
  }

  public function save()
  {
    try {
      $query = $this->prepare('CALL addCustomer(:names, :lastName, :lastName2, :address, :email)');
      $query->execute([
        'names'     => $this->names, 
        'lastName'  => $this->lastName,
        'lastName2' => $this->lastName2,
        'address'   => $this->address,
        'email'     => $this->email
      ]);

      // get last customer inserted
      $id = $query->fetch(PDO::FETCH_ASSOC);
     
      return $id;

    } catch (PDOException $e) {
      return false;
    }
  }

  public function getAll() {
    $items = [];
    try {
      $query = $this->query('SELECT * FROM customers');

      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $item = new CustomerModel();
        
        $item->id         = $row['id'];
        $item->names      = $row['names'];
        $item->lastName   = $row['last_name'];
        $item->lastName2  = $row['last_name2'];
        $item->address    = $row['address'];
        $item->email      = $row['email'];

        array_push($items, $item);
      }

      return $items;
    } catch (PDOException $e) {}
  }

  public function getById() {

    try {
      $query = $this->prepare('SELECT * FROM customers WHERE id = :id');
      $query->execute([
        'id' => $this->id
      ]);

      $customer = $query->fetch(PDO::FETCH_ASSOC);

      $this->id = $customer['id'];
      $this->names = $customer['names'];
      $this->lastName = $customer['last_name'];
      $this->lastName2 = $customer['last_name2'];
      $this->address = $customer['address'];
      $this->email = $customer['email'];


      return $this;
    } catch (PDOException $e) {
      return null;
    }
  }

  public function delete() {    
    try {
      $query = $this->prepare('DELETE FROM customers WHERE id = :id');
      $query->execute([
        'id' => $this->id
      ]);

      return true;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function update() {
    try {
      $query = $this->prepare('UPDATE customers SET names = :names, last_name = :lastName, last_name2 = :lastName2, address = :address, email = :email WHERE id = :id');
      $query->execute([
        'names'     => $this->names, 
        'lastName'  => $this->lastName,
        'lastName2' => $this->lastName2,
        'address'   => $this->address,
        'email'     => $this->email,
        'id'        => $this->id
      ]);

      return true;
    } catch (PDOException $e) {
      echo $e;
      return false;
    }
  }

  // Getters and setters
  public function setId($id){$this->id = $id;}
  public function setNames($names){$this->names = $names;}
  public function setLastName($lastName){$this->lastName = $lastName;}
  public function setLastName2($lastName2){$this->lastName2 = $lastName2;}
  public function setAddress($address){$this->address = $address;}
  public function setEmail($email){$this->email = $email;}

  public function getId(){return $this->id;}
  public function getNames(){ return $this->names;}
  public function getLastName(){return $this->lastName;}
  public function getLastName2(){return $this->lastName2;}
  public function getAddress(){return $this->address;}
  public function getEmail(){return $this->email;}


}