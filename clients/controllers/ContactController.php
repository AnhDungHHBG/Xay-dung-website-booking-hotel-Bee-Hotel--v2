
<?php 

class ContactController extends BaseController
{
    public function __construct() {
        parent::__construct(); 
        $this->isLogin();
    }
    public $supportTicket;
    public $supportResponse;
    public function loadModels() {
        $this->supportTicket = new SupportTicket();
        $this->supportResponse = new SupportResponse();
    }


    public function contact() {
        $user_id = $_SESSION['user']['user_id'];  
        $responses = $this->supportResponse->get_ticket_and_responses($user_id);
        $this->viewApp->requestView('contact.index', ['data' => $responses]);
    }
     public function contact_post() {
        $user_id = $_SESSION['user']['user_id'];  
        $object = $this->route->form;  
        $data = (array) $object;
        
        $this->supportTicket->support_send_ticket($user_id,$data);
        $this->route->redirectClient('contact');
    }
}