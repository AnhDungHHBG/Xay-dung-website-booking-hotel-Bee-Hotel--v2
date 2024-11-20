<?php 

class SupportController extends BaseController
{
    public $supportModel;
    public function loadModels() {
        $this->supportModel = new Support();
    }

    public function support_list() {
        $data = $this->supportModel->getAllTickets();
        $this->viewApp->requestView('support.list.index', ['data' => $data]);
    }   
    
    public function support_detail() {
        $ticketId = $_GET['id'];
        $ticket = $this->supportModel->getTicketDetail($ticketId);
        $responses = $this->supportModel->getResponsesByTicketId($ticketId);
        $data = [
            'ticket' => $ticket,
            'responses' => $responses,
        ];
        $this->viewApp->requestView('support.detail.index', ['data' => $data]);
    }  

    public function support_response_post() {
        $data = $this->route->form;

        if (is_object($data)) {
            $data = (array) $data;
        }
        $this->supportModel->sendResponse($data);
        $this->route->redirectAdmin('support-list');
    }

     
}