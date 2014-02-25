<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * schedule_profile
 *
 * @package        CodeIgniter
 * @subpackage    schedule_profile Assistant
 * @category    Controller
 * @author        LiuDonghua
 */
class Schedule_profile_mgmt extends REST_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('language', 'url', 'student_assistant/utils'));
        $this->load->model(array('student_assistant/schedule_profile_model'));
        $this->load->language(array('general', 'student_assistant/schedule_profile'));
    }

    /**
     * Get a schedule_profile
     */
    function schedule_profile_get() {
        $id = $this->get(schedule_profile_model::$schedule_profile_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $schedule_profile = $this->schedule_profile_model->get_by_id($id);

        if ($schedule_profile) {
            $message = utils::make_response_result(schedule_profile_model::$model_name, $schedule_profile);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(schedule_profile_model::$model_name, $schedule_profile, false, 'schedule_profile could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Get all schedule_profiles by institute id
     */
    function schedule_profiles_get() {
        $institute_id = $this->get(schedule_profile_model::$schedule_profile_table_column_institute_id);

        if ($institute_id) {
            $schedule_profiles = $this->schedule_profile_model->get_by_institute_id($institute_id);
        } else {
            $schedule_profiles = $this->schedule_profile_model->get();
        }

        if ($schedule_profiles) {
            $message = utils::make_response_result(schedule_profile_model::$models_name, $schedule_profiles);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(schedule_profile_model::$models_name, $schedule_profiles, false, 'schedule_profiles could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Add a schedule_profile
     */
    function schedule_profile_put() {
        // create($schedule_profile_id, $start_time, $end_time, $schedule_no)
        $schedule_profile = $this->schedule_profile_model->create($this->get(schedule_profile_model::$schedule_profile_table_column_school_id), $this->get(schedule_profile_model::$schedule_profile_table_column_institute_id), $this->get(schedule_profile_model::$schedule_profile_table_column_schedule_profile_name), $this->get(schedule_profile_model::$schedule_profile_table_column_schedule_profile_description));

        $message = utils::make_response_result(schedule_profile_model::$model_name, $schedule_profile);

        $this->response($message, 200);
    }

    /**
     *  Update a schedule_profile
     */
    function schedule_profile_post() {
        $id = $this->get(schedule_profile_model::$schedule_profile_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        // $schedule_profile_id, $start_time, $end_time, $schedule_no
        $request_keys = array(schedule_profile_model::$schedule_profile_table_column_school_id, schedule_profile_model::$schedule_profile_table_column_institute_id, schedule_profile_model::$schedule_profile_table_column_schedule_profile_name, schedule_profile_model::$schedule_profile_table_column_schedule_profile_description);
        $attribute = Utils::create_request_attribute($this, $request_keys);

        $schedule_profile = $this->schedule_profile_model->update($id, $attribute);

        $message = utils::make_response_result(schedule_profile_model::$model_name, $schedule_profile);

        $this->response($message, 200);
    }

    /**
     *  Delete a schedule_profile
     */
    function schedule_profile_delete() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
        }

        $this->schedule_profile_model->delete($id);

        $message = utils::make_response_result(false, false);

        $this->response($message, 200);
    }


}