<?php
/*
 * Manage_courses Controller
 */
class Manage_courses extends CI_Controller {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('date', 'language', 'account/ssl', 'url', 'student_assistant/utils'));
        $this->load->library(array('account/authentication', 'account/authorization'));
        $this->load->model(array('account/account_model', 'account/account_details_model', 'student_assistant/school_model', 'student_assistant/institute_model', 'student_assistant/major_model', 'student_assistant/teacher_model', 'student_assistant/course_model', 'student_assistant/course_type_model'));
        $this->load->language(array('general', 'student_assistant/course'));
    }

    /**
     * Manage Roles
     */
    function index($school_id = NULL, $institute_id = NULL) {
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

        $data['school'] = NULL;
        $data['institute'] = NULL;
        if (isset($school_id) && !isset($institute_id)) {
            $data['school'] = $this->school_model->get_by_id($school_id);
            $data['institutes'] = $this->institute_model->get_by_school_id($school_id);
            $data['courses'] = $this->course_model->get_by_school_id($institute_id);
        } else if (isset($school_id) && isset($institute_id)) {
            $data['school'] = $this->school_model->get_by_id($school_id);
            $data['institute'] = $this->institute_model->get_by_id($institute_id);
            $data['courses'] = $this->course_model->get_by_institute_id($institute_id);
        } else {
            $data['schools'] = $this->school_model->get();
            $data['institutes'] = $this->institute_model->get();
            $data['courses'] = $this->course_model->get();
        }

        $data['institutes'] = $this->institute_model->get_by_school_id($school_id);
        $data['institutes_map'] = utils::create_js_map_string($data['institutes'], institute_model::$institute_table_column_id, institute_model::$institute_table_column_institute_name);

        $data['majors'] = $this->major_model->get_by_institute_id($institute_id);
        $data['majors_map'] = utils::create_js_map_string($data['majors'], major_model::$major_table_column_id, major_model::$major_table_column_name);

        $data['teachers'] = $this->teacher_model->get_by_institute_id($institute_id);
        $data['teachers_map'] = utils::create_js_map_string($data['teachers'], teacher_model::$teacher_table_column_id, teacher_model::$teacher_table_column_teacher_name);

        $data['course_types'] = $this->course_type_model->get_by_school_id($school_id);
        $data['course_types_map'] = utils::create_js_map_string($data['course_types'], course_type_model::$course_type_table_column_id, course_type_model::$course_type_table_column_course_type);
        // Load manage roles view
        $this->load->view('student_assistant/manage_courses', $data);
    }


}


/* End of file manage_roles.php */
/* Location: ./application/account/controllers/manage_roles.php */
