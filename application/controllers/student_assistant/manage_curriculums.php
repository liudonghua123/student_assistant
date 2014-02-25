<?php
/*
 * Manage_curriculums Controller
 */
class Manage_curriculums extends CI_Controller {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('date', 'language', 'account/ssl', 'url', 'student_assistant/utils'));
        $this->load->library(array('account/authentication', 'account/authorization'));
        $this->load->model(array('account/account_model', 'account/account_details_model', 'student_assistant/school_model', 'student_assistant/institute_model', 'student_assistant/curriculum_model'));
        $this->load->language(array('general', 'student_assistant/curriculum'));
    }

    /**
     * Manage Roles
     */
    function index($school_id, $institute_id) {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'account/manage_roles'));
        }

        //    // Redirect unauthorized users to account profile page
        //    if ( ! $this->authorization->is_permitted('retrieve_roles'))
        //    {
        //      redirect('account/account_profile');
        //    }
        // Retrieve sign in user
        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

        $data['school'] = $this->school_model->get_by_id($school_id);
        $data['institute'] = $this->institute_model->get_by_id($institute_id);
        $data['curriculums'] = $this->curriculum_model->get_by_institute_id($institute_id);

        // Load manage roles view
        $this->load->view('student_assistant/manage_curriculums', $data);
    }


}


/* End of file manage_roles.php */
/* Location: ./application/account/controllers/manage_roles.php */
