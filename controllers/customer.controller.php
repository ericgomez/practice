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
        if(!$this->existPOST(['names', 'paternalSurname', 'maternalSurname', 'domicile', 'email'])){
            $this->redirect('customer', ['error' => 'Todos los campos deben de estar llenos']);
            return;
        }

        if($this->user == null){
            $this->redirect('customer', ['error' => 'Error al crear nuevo cliente.']);
            return;
        }

        $customer = new CustomerModel();

        $customer->setNames($this->getPost('names'));
        $customer->setPaternalSurname((float)$this->getPost('paternalSurname'));
        $customer->setMaternalSurname($this->getPost('maternalSurname'));
        $customer->setDomicile($this->getPost('domicile'));
        $customer->setEmail($this->getPost('email'));

        $customer->save();

        echo json_encode(['success' => 'Cliente creado correctamente.']);

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
      
      $customer = new CustomerModel();

      $customer->setId($id);
      
      
        echo json_encode($customer->getById($id));
    }
    

    function updateCustomer(){
        if(!$this->existPOST(['names', 'paternalSurname', 'maternalSurname', 'domicile', 'email'])){
            $this->redirect('customer', ['error' => 'Todos los campos deben de estar llenos']);
            return;
        }

        if($this->user == null){
            $this->redirect('customer', ['error' => 'Error al crear nuevo cliente.']);
            return;
        }

        $customer = new CustomerModel();

        $customer->setNames($this->getPost('names'));
        $customer->setPaternalSurname((float)$this->getPost('paternalSurname'));
        $customer->setMaternalSurname($this->getPost('maternalSurname'));
        $customer->setDomicile($this->getPost('domicile'));
        $customer->setEmail($this->getPost('email'));

        $customer->update();

        echo json_encode(['success' => 'Cliente actualizado correctamente.']);
        // $this->redirect('customer', ['success' => 'Customer created successfully']);
    }



    function delete($params){
        
        if($params === null) $this->redirect('', ['error' => 'Los campos no pueden ir vacios']);
        $id = $params[0];
        $res = $this->model->delete($id);

        if($res){
            echo json_encode(['success' => 'Cliente eliminado correctamente.']);
            // $this->redirect('', ['success' => 'El empleado fue eliminado correctamente.']);
        }else{
            echo json_encode(['error' => 'Error al eliminar el cliente.']);
            //$this->redirect('', ['error' => 'No se pudo eliminar el cliente']);
        }
    }

}