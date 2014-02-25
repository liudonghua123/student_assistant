<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * institute
 *
 * @package        CodeIgniter
 * @subpackage    Student Assistant
 * @category    Controller
 * @author        LiuDonghua
 */
class Institute_mgmt extends REST_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('language', 'url', 'student_assistant/utils'));
        $this->load->model(array('student_assistant/institute_model'));
        $this->load->language(array('general', 'student_assistant/institute'));
    }

    /**
     * Get a institute
     */
    function institute_get() {
        $id = $this->get(institute_model::$institute_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $institute = $this->institute_model->get_by_id($id);

        if ($institute) {
            $message = utils::make_response_result(institute_model::$model_name, $institute);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(institute_model::$model_name, $institute, false, 'Institute could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Get all institutes
     */
    function institutes_get() {
        $institutes = $this->institute_model->get();

        if ($institutes) {
            $message = utils::make_response_result(institute_model::$models_name, $institutes);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(institute_model::$models_name, $institutes, false, 'institutes could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Add a institute
     */
    function institute_put() {
        $institute = $this->institute_model->create($this->get(institute_model::$institute_table_column_institute_name), $this->get(institute_model::$institute_table_column_school_id), $this->get(institute_model::$institute_table_column_institute_description), $this->get(institute_model::$institute_table_column_institute_homepage));

        $message = utils::make_response_result(institute_model::$model_name, $institute);

        $this->response($message, 200);
    }

    /**
     *  Update a institute
     */
    function institute_post() {
        $id = $this->get(institute_model::$institute_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $request_keys = array(institute_model::$institute_table_column_institute_name, institute_model::$institute_table_column_school_id, institute_model::$institute_table_column_institute_description, institute_model::$institute_table_column_institute_homepage);
        $attribute = Utils::create_request_attribute($this, $request_keys);

        $institute = $this->institute_model->update($id, $attribute);

        $message = utils::make_response_result(institute_model::$model_name, $institute);

        $this->response($message, 200);
    }

    /**
     *  Delete a institute
     */
    function institute_delete() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
        }

        $this->institute_model->delete($id);

        $message = utils::make_response_result(false, false);

        $this->response($message, 200);
    }

}