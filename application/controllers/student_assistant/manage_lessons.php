<?php
/*
 * Manage_lessons Controller
 */
class Manage_lessons extends CI_Controller {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('date', 'language', 'account/ssl', 'url', 'student_assistant/utils'));
        $this->load->library(array('account/authentication', 'account/authorization'));
        $this->load->model(array('account/account_model', 'account/account_details_model', 'student_assistant/school_model', 'student_assistant/institute_model', 'student_assistant/lesson_model', 'student_assistant/course_model', 'student_assistant/room_model', 'student_assistant/teacher_model', 'student_assistant/schedule_time_model', 'student_assistant/curriculum_model', 'student_assistant/curriculum_lesson_model'));
        $this->load->language(array('general', 'student_assistant/lesson'));
    }

    /**
     * Manage Roles
     */
    function index($school_id, $institute_id, $curriculum_id = NULL) {
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
        $data['lessons'] = isset($curriculum_id) ? $this->lesson_model->get_by_curriculum_id($curriculum_id) : $this->lesson_model->get_by_institute_id($institute_id);
        $data['curriculum'] = isset($curriculum_id) ? $this->curriculum_model->get_by_id($curriculum_id) : NULL;

        $data['courses'] = $this->course_model->get_by_institute_id($institute_id);
        $data['courses_map'] = utils::create_js_map_string($data['courses'], course_model::$course_table_column_id, course_model::$course_table_column_course_name);

        $data['rooms'] = $this->room_model->get_by_school_id($school_id);
        $data['rooms_map'] = utils::create_js_map_string($data['rooms'], room_model::$room_table_column_id, room_model::$room_table_column_name);

        $data['lesson_week_map'] = utils::create_js_week_map_string();
        $data['lesson_day_map'] = utils::create_js_day_map_string();

        $data['schedule_times'] = $this->schedule_time_model->get_by_institute_id($institute_id);
        $data['schedule_times_map'] = utils::create_js_map_string2($data['schedule_times'], schedule_time_model::$schedule_time_table_column_id, schedule_time_model::$schedule_time_table_column_schedule_no, schedule_time_model::$schedule_time_table_column_start_time, schedule_time_model::$schedule_time_table_column_end_time);
        // Load manage roles view
        $this->load->view('student_assistant/manage_lessons', $data);
    }


}


/* End of file manage_roles.php */
/* Location: ./application/account/controllers/manage_roles.php */
