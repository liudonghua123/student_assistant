<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * major
 *
 * @package        CodeIgniter
 * @subpackage    Student Assistant
 * @category    Controller
 * @author        LiuDonghua
 */
class Major_mgmt extends REST_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('language', 'url', 'student_assistant/utils'));
        $this->load->model(array('student_assistant/major_model'));
        $this->load->language(array('general', 'student_assistant/major'));
    }

    /**
     * Get a major
     */
    function major_get() {
        $id = $this->get(major_model::$major_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $major = $this->major_model->get_by_id($id);

        if ($major) {
            $message = utils::make_response_result(major_model::$model_name, $major);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(major_model::$model_name, $major, false, 'majors could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Get all majors
     */
    function majors_get() {
        $school_id = $this->get(major_model::$major_table_column_school_id);
        $institute_id = $this->get(major_model::$major_table_column_institute_id);

        if ($school_id) {
            $majors = $this->major_model->get_by_school_and_institute($school_id, $institute_id);
        } else {
            $majors = $this->major_model->get();
        }

        if ($majors) {
            $message = utils::make_response_result(major_model::$models_name, $majors);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(major_model::$models_name, $majors, false, 'majors could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Add a major
     */
    function major_put() {
        $major = $this->major_model->create($this->get(major_model::$major_table_column_name), $this->get(major_model::$major_table_column_school_id), $this->get(major_model::$major_table_column_institute_id), $this->get(major_model::$major_table_column_description));

        $message = utils::make_response_result(major_model::$model_name, $major);

        $this->response($message, 200);
    }

    /**
     *  Update a major
     */
    function major_post() {
        $id = $this->get(major_model::$major_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $request_keys = array(major_model::$major_table_column_name, major_model::$major_table_column_school_id, major_model::$major_table_column_institute_id, major_model::$major_table_column_description);
        $attribute = Utils::create_request_attribute($this, $request_keys);

        $major = $this->major_model->update($id, $attribute);

        $message = utils::make_response_result(major_model::$model_name, $major);

        $this->response($message, 200);
    }

    /**
     *  Delete a major
     */
    function major_delete() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
        }

        $this->major_model->delete($id);

        $message = utils::make_response_result(false, false);

        $this->response($message, 200);
    }

}