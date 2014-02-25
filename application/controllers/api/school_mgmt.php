<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * School
 *
 * @package        CodeIgniter
 * @subpackage    Student Assistant
 * @category    Controller
 * @author        LiuDonghua
 */
class School_mgmt extends REST_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('language', 'url', 'student_assistant/utils'));
        $this->load->model(array('student_assistant/school_model'));
        $this->load->language(array('general', 'student_assistant/school'));
    }

    /**
     * Get a school
     */
    function school_get() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
        }

        $school = $this->school_model->get_by_id($id);

        if ($school) {
            $message = utils::make_response_result(school_model::$model_name, $school);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(school_model::$model_name, $school, false, 'Schools could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Get all schools
     */
    function schools_get() {
        $schools = $this->school_model->get();

        if ($schools) {
            $message = utils::make_response_result(school_model::$models_name, $schools);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(school_model::$models_name, $schools, false, 'Schools could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Add a school
     */
    function school_put() {
        $school = $this->school_model->create($this->get(school_model::$school_table_column_school_name), $this->get(school_model::$school_table_column_description), $this->get(school_model::$school_table_column_homepage));

        $message = utils::make_response_result(school_model::$model_name, $school);

        $this->response($message, 200);
    }

    /**
     *  Update a school
     */
    function school_post() {
        $id = $this->get(school_model::$school_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $request_keys = array(school_model::$school_table_column_school_name, school_model::$school_table_column_description, school_model::$school_table_column_homepage);
        $attribute = Utils::create_request_attribute($this, $request_keys);

        $school = $this->school_model->update($id, $attribute);

        $message = utils::make_response_result(school_model::$model_name, $school);

        $this->response($message, 200);
    }

    /**
     *  Delete a school
     */
    function school_delete() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
        }

        $this->school_model->delete($id);

        $message = utils::make_response_result(false, false);

        $this->response($message, 200);
    }

}