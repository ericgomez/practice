<?

class CustomerModel extends Model implements IModel
{

  private $id;
  private $names;
  private $paternalSurname;
  private $maternalSurname;
  private $domicile;
  private $email;

  public function __construct()
  {
    parent::__construct();
    $this->names = '';
    $this->paternalSurname = '';
    $this->maternalSurname = '';
    $this->domicile = '';
    $this->email = '';
  }

  public function save()
  {
    try {
      $query = $this->prepare('INSERT INTO customers (names, paternal_surname, maternal_surname, domicile, email) VALUES(:names, :paternalSurname, :maternalSurname, :domicile, :email)');
      $query->execute([
        'names' => $this->names, 
        'paternalSurname' => $this->paternalSurname,
        'maternalSurname' => $this->maternalSurname,
        'domicile' => $this->domicile,
        'email' => $this->email
      ]);

      return true;
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
        
        $item->id = $row['id'];
        $item->names = $row['names'];
        $item->paternalSurname = $row['paternal_surname'];
        $item->maternalSurname = $row['maternal_surname'];
        $item->domicile = $row['domicile'];
        $item->email = $row['email'];

        array_push($items, $item);
      }

      return $items;
    } catch (PDOException $e) {}
  }

  public function getById($id) {
    try {
      $query = $this->prepare('SELECT * FROM customers WHERE id = :id');
      $query->execute([
        'id' => $this->id
      ]);

      $customer = $query->fetch(PDO::FETCH_ASSOC);

      $this->id = $customer['id'];
      $this->names = $customer['names'];
      $this->paternalSurname = $customer['paternal_surname'];
      $this->maternalSurname = $customer['maternal_surname'];
      $this->domicile = $customer['domicile'];
      $this->email = $customer['email'];

      return $this;
    } catch (PDOException $e) {}
  }

  public function delete($id) {    
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
      $query = $this->prepare('UPDATE customers SET names = :names, paternal_surname = :paternalSurname, maternalSurname = :maternalSurname, domicile = :domicile, email = :email WHERE id = :id');
      $query->execute([
        'names' => $this->names, 
        'paternalSurname' => $this->paternalSurname,
        'maternalSurname' => $this->maternalSurname,
        'domicile' => $this->domicile,
        'email' => $this->email
      ]);

      return true;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function exists($email){
    try{
      $query = $this->prepare('SELECT name FROM customers WHERE email = :email');
      $query->execute( ['email' => $email]);
            
      if($query->rowCount() > 0){
        error_log('customerModel::exists() => true');
        return true;
      }else{
        error_log('customerModel::exists() => false');
        return false;
      }
    }catch(PDOException $e){
      error_log($e);
      return false;
    }
  }

  // Getters and setters
  public function setId($id){$this->id = $id;}
  public function setNames($names){$this->names = $names;}
  public function setPaternalSurname($paternalSurname){$this->paternalSurname = $paternalSurname;}
  public function setMaternalSurname($maternalSurname){$this->maternalSurname = $maternalSurname;}
  public function setDomicile($domicile){$this->domicile = $domicile;}
  public function setEmail($email){$this->email = $email;}

  public function getId(){return $this->id;}
  public function getNames(){ return $this->names;}
  public function getPaternalSurname(){return $this->paternalSurname;}
  public function getMaternalSurname(){return $this->maternalSurname;}
  public function getDomicile(){return $this->domicile;}
  public function getEmail(){return $this->email;}


}