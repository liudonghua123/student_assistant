<?php
/*
 * Manage_rooms Controller
 */
class Manage_rooms extends CI_Controller {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('date', 'language', 'account/ssl', 'url', 'student_assistant/utils'));
        $this->load->library(array('account/authentication', 'account/authorization'));
        $this->load->model(array('account/account_model', 'account/account_details_model', 'student_assistant/school_model', 'student_assistant/room_model'));
        $this->load->language(array('general', 'student_assistant/room'));
    }

    /**
     * Manage Roles
     */
    function index($school_id = NULL) {
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

        if (isset($school_id)) {
            $data['rooms'] = $this->room_model->get_by_school_id($school_id);
            $data['school'] = $this->school_model->get_by_id($school_id);
        } else {
            // Retrieve all rooms
            $data['rooms'] = $this->room_model->get();
            $data['school'] = NULL;
        }
        $data['schools'] = $this->school_model->get();
        $data['schools_map'] = utils::create_js_map_string($data['schools'], school_model::$school_table_column_id, school_model::$school_table_column_school_name);

        // Load manage roles view
        $this->load->view('student_assistant/manage_rooms', $data);
    }


}


/* End of file manage_roles.php */
/* Location: ./application/account/controllers/manage_roles.php */
