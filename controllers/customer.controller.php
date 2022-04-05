<?
require_once 'models/customer.model.php';

class Customer extends SessionController{
    private $user;

    function __construct(){
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    function render(){
        $customerModel = new CustomerModel();

        $this->view->render('customer/index', [
            'user' => $this->user,
            'dates' => $customerModel->getAll()
        ]);
    }

    function newCustomer(){
      
        if(!$this->existPOST(['names', 'lastName', 'lastName2', 'address', 'email'])){
            $this->redirect('customer', ['error' => 'Todos los campos deben de estar llenos']);
            return;
        }

        if($this->user == null){
            $this->redirect('customer', ['error' => 'Error al crear nuevo cliente.']);
            return;
        }

        $customer = new CustomerModel();

        $customer->setNames($this->getPost('names'));
        $customer->setLastName($this->getPost('lastName'));
        $customer->setLastName2($this->getPost('lastName2'));
        $customer->setAddress($this->getPost('address'));
        $customer->setEmail($this->getPost('email'));

        $id = $customer->save();

        echo json_encode([
        'status' => 'success',
        'message' => 'Cliente creado correctamente.',
        'data' => $id
      ]);

        // $this->redirect('customer', ['success' => 'Customer created successfully']);
    }

    // new expense UI
    function create(){
        $this->view->render('customer/create', [
            "user" => $this->user
        ]);
    } 

    function getCustomerById() {
      if(!$this->existPOST(['id'])){
        $this->redirect('customer', ['error' => 'Se require informacion del cliente']);
        return;
      }

      $id = $this->getPost('id');

      if(empty($id)){
          $this->redirect('customer', ['error' => 'El campo id no puede ir vacio']);
          return;
      }

      $data = [];
      
      $customer = new CustomerModel();
      $customer->setId($id);
      
      $customer->getById();
      
      // Check if customer exists
      if($customer == null){
        $this->redirect('customer', ['error' => 'El cliente no existe']);
        return;
      }

      $data['id'] = $customer->getId();
      $data['names'] = $customer->getNames();
      $data['lastName'] = $customer->getLastName();
      $data['lastName2'] = $customer->getLastName2();
      $data['address'] = $customer->getAddress();
      $data['email'] = $customer->getEmail();

      echo json_encode([
        'status' => 'success',
        'message' => 'Cliente encontrado',
        'data' => $data
      ]);   
    }
    

    function updateCustomer(){
        if(!$this->existPOST(['id', 'names', 'lastName', 'lastName2', 'address', 'email'])){
            $this->redirect('customer', ['error' => 'Todos los campos deben de estar llenos']);
            return;
        }

        if($this->user == null){
            $this->redirect('customer', ['error' => 'Error al crear nuevo cliente.']);
            return;
        }

        $customer = new CustomerModel();

        $customer->setId($this->getPost('id'));
        $customer->setNames($this->getPost('names'));
        $customer->setLastName($this->getPost('lastName'));
        $customer->setLastName2($this->getPost('lastName2'));
        $customer->setAddress($this->getPost('address'));
        $customer->setEmail($this->getPost('email'));

        $customer->update();

        echo json_encode([
          'status' => 'success', 
          'message' => 'Cliente actualizado correctamente.'
        ]);
    }



    function delete(){
        if(!$this->existPOST(['id'])){
            $this->redirect('customer', ['error' => 'Se require informacion del cliente']);
            return;
        }

        if($this->user == null){
            $this->redirect('customer', ['error' => 'Error al crear nuevo cliente.']);
            return;
        }

        $id = $this->getPost('id');

        if(empty($id)){
            $this->redirect('customer', ['error' => 'El campo id no puede ir vacio']);
            return;
        }

        $customer = new CustomerModel();
        $customer->setId($id);
        
        $res = $customer->delete();

        if($res){
            echo json_encode([
              'status' => 'success', 
              'message' => 'Cliente eliminado correctamente.'
            ]);
        }else{
            echo json_encode([
                'status' => 'error',
                'message' => 'Error al eliminar el cliente.'
            ]);
        }
    }

}