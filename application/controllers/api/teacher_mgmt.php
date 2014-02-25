<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * teacher
 *
 * @package        CodeIgniter
 * @subpackage    teacher Assistant
 * @category    Controller
 * @author        LiuDonghua
 */
class Teacher_mgmt extends REST_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('language', 'url', 'student_assistant/utils'));
        $this->load->model(array('student_assistant/teacher_model'));
        $this->load->language(array('general', 'student_assistant/teacher'));
    }

    /**
     * Get a teacher
     */
    function teacher_get() {
        $id = $this->get(teacher_model::$teacher_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $teacher = $this->teacher_model->get_by_id($id);

        if ($teacher) {
            $message = utils::make_response_result(teacher_model::$model_name, $teacher);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(teacher_model::$model_name, $teacher, false, 'Teacher could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Get all teachers by institute id
     */
    function teachers_get() {
        $institute_id = $this->get(teacher_model::$teacher_table_column_institute_id);

        if ($institute_id) {
            $teachers = $this->teacher_model->get_by_institute_id($institute_id);
        } else {
            $teachers = $this->teacher_model->get();
        }

        if ($teachers) {
            $message = utils::make_response_result(teacher_model::$models_name, $teachers);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(teacher_model::$models_name, $teachers, false, 'Teachers could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Add a teacher
     */
    function teacher_put() {
        // create($institute_id, $teacher_name, $teacher_gender, $teacher_research_area = NULL)
        $teacher = $this->teacher_model->create($this->get(teacher_model::$teacher_table_column_school_id), $this->get(teacher_model::$teacher_table_column_institute_id), $this->get(teacher_model::$teacher_table_column_teacher_name), $this->get(teacher_model::$teacher_table_column_teacher_gender), $this->get(teacher_model::$teacher_table_column_teacher_research_area));

        $message = utils::make_response_result(teacher_model::$model_name, $teacher);

        $this->response($message, 200);
    }

    /**
     *  Update a teacher
     */
    function teacher_post() {
        $id = $this->get(teacher_model::$teacher_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $request_keys = array(teacher_model::$teacher_table_column_school_id, teacher_model::$teacher_table_column_institute_id, teacher_model::$teacher_table_column_teacher_name, teacher_model::$teacher_table_column_teacher_gender, teacher_model::$teacher_table_column_teacher_research_area);
        $attribute = Utils::create_request_attribute($this, $request_keys);

        $teacher = $this->teacher_model->update($id, $attribute);

        $message = utils::make_response_result(teacher_model::$model_name, $teacher);

        $this->response($message, 200);
    }

    /**
     *  Delete a teacher
     */
    function teacher_delete() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
        }

        $this->teacher_model->delete($id);

        $message = utils::make_response_result(false, false);

        $this->response($message, 200);
    }


}