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
            'customers' => $customerModel->getAll()
        ]);
    }

    function newCustomer(){
        if(!$this->existPOST(['names', 'lastName', 'lastName2', 'address', 'email'])){
						echo json_encode([
							'status' => 'error', 
							'message' => 'Todos los campos son obligatorios'
						]);
            return;
        }

        if($this->user == null){
					echo json_encode([
						'status' => 'error', 
						'message' => "Debe iniciar sesión para poder crear un cliente"
					]); 
          return;
        }

        if (!filter_var($this->getPost('email'), FILTER_VALIDATE_EMAIL)) {
          echo json_encode([
            	'status' => 'error', 
              'message' => "El email no es valido"
            ]);
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
    }

    // new expense UI
    // function create(){
    //     $this->view->render('customer/create', [
    //         "user" => $this->user
    //     ]);
    // } 

    function getCustomerById() {
      if(!$this->existPOST(['id'])){
        echo json_encode([
          'status' => 'error', 
          'message' => 'No se ha enviado el id del cliente'
        ]);
        return;
      }

      $id = $this->getPost('id');

      if(empty($id)){
				echo json_encode([
          'status' => 'error', 
          'message' => 'El id no puede estar vacio.'
        ]);
        return;
      }

      $data = [];
      
      $customer = new CustomerModel();
      $customer->setId($id);
      
      $customer->getById();
      
      // Check if customer exists
      if($customer == null){
        echo json_encode([
        	'status' => 'error', 
          'message' => "Debe iniciar sesión para poder actualizar un cliente"
        ]);
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
        'message' => 'Cliente obtenido correctamente.',
        'data' => $data
      ]);   
    }
    

    function updateCustomer(){
        if(!$this->existPOST(['id', 'names', 'lastName', 'lastName2', 'address', 'email'])){
						echo json_encode([
            	'status' => 'error', 
              'message' => "Todos los campos son obligatorios"
            ]);
            return;
        }

        if($this->user == null){
						echo json_encode([
            	'status' => 'error', 
              'message' => "Debe iniciar sesión para poder actualizar un cliente"
            ]);
            return;
        }

        if (!filter_var($this->getPost('email'), FILTER_VALIDATE_EMAIL)) {
          echo json_encode([
            	'status' => 'error', 
              'message' => "El email no es valido"
            ]);
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
						echo json_encode([
            	'status' => 'error', 
              'message' => "Todos los campos son obligatorios"
            ]);
            return;
        }

        $id = $this->getPost('id');

        if(empty($id)){
						echo json_encode([
            	'status' => 'error', 
              'message' => "El id no puede estar vacio"
            ]);
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