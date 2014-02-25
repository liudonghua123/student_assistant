<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * course_type
 *
 * @package        CodeIgniter
 * @subpackage    Student Assistant
 * @category    Controller
 * @author        LiuDonghua
 */
class Course_type_mgmt extends REST_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('language', 'url', 'student_assistant/utils'));
        $this->load->model(array('student_assistant/course_type_model'));
        $this->load->language(array('general', 'student_assistant/course_type'));
    }

    /**
     * Get a course_type
     */
    function course_type_get() {
        $id = $this->get(course_type_model::$course_type_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $course_type = $this->course_type_model->get_by_id($id);

        if ($course_type) {
            $message = utils::make_response_result(course_type_model::$model_name, $course_type);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(course_type_model::$model_name, $course_type, false, 'course_types could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Get all course_types
     */
    function course_types_get() {
        $school_id = $this->get(course_type_model::$course_type_table_column_school_id);

        if ($school_id) {
            $course_types = $this->course_type_model->get_by_school_id($school_id);
        } else {
            $course_types = $this->course_type_model->get();
        }

        if ($course_types) {
            $message = utils::make_response_result(course_type_model::$models_name, $course_types);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(course_type_model::$models_name, $course_types, false, 'course_types could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Add a course_type
     */
    function course_type_put() {
        $course_type = $this->course_type_model->create($this->get(course_type_model::$course_type_table_column_school_id), $this->get(course_type_model::$course_type_table_column_course_type), $this->get(course_type_model::$course_type_table_column_course_type_description));

        $message = utils::make_response_result(course_type_model::$model_name, $course_type);

        $this->response($message, 200);
    }

    /**
     *  Update a course_type
     */
    function course_type_post() {
        $id = $this->get(course_type_model::$course_type_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $request_keys = array(course_type_model::$course_type_table_column_school_id, course_type_model::$course_type_table_column_course_type, course_type_model::$course_type_table_column_course_type_description);
        $attribute = Utils::create_request_attribute($this, $request_keys);

        $course_type = $this->course_type_model->update($id, $attribute);

        $message = utils::make_response_result(course_type_model::$model_name, $course_type);

        $this->response($message, 200);
    }

    /**
     *  Delete a course_type
     */
    function course_type_delete() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
        }

        $this->course_type_model->delete($id);

        $message = utils::make_response_result(false, false);

        $this->response($message, 200);
    }

}