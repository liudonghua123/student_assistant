<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * schedule_time
 *
 * @package        CodeIgniter
 * @subpackage    schedule_time Assistant
 * @category    Controller
 * @author        LiuDonghua
 */
class Schedule_time_mgmt extends REST_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('language', 'url', 'student_assistant/utils'));
        $this->load->model(array('student_assistant/schedule_time_model'));
        $this->load->language(array('general', 'student_assistant/schedule_time'));
    }

    /**
     * Get a schedule_time
     */
    function schedule_time_get() {
        $id = $this->get(schedule_time_model::$schedule_time_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $schedule_time = $this->schedule_time_model->get_by_id($id);

        if ($schedule_time) {
            $message = utils::make_response_result(schedule_time_model::$model_name, $schedule_time);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(schedule_time_model::$model_name, $schedule_time, false, 'Schedule_time could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Get all schedule_times by institute id
     */
    function schedule_times_get() {
        $schedule_profile_id = $this->get(schedule_time_model::$schedule_time_table_column_schedule_profile_id);

        if ($schedule_profile_id) {
            $schedule_times = $this->schedule_time_model->get_by_schedule_profile_id($schedule_profile_id);
        } else {
            $schedule_times = $this->schedule_time_model->get();
        }

        if ($schedule_times) {
            $message = utils::make_response_result(schedule_time_model::$models_name, $schedule_times);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(schedule_time_model::$models_name, $schedule_times, false, 'Schedule_times could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Add a schedule_time
     */
    function schedule_time_put() {
        // create($schedule_profile_id, $start_time, $end_time, $schedule_no)
        $schedule_time = $this->schedule_time_model->create($this->get(schedule_time_model::$schedule_time_table_column_school_id), $this->get(schedule_time_model::$schedule_time_table_column_institute_id), $this->get(schedule_time_model::$schedule_time_table_column_schedule_profile_id), $this->get(schedule_time_model::$schedule_time_table_column_start_time), $this->get(schedule_time_model::$schedule_time_table_column_end_time), $this->get(schedule_time_model::$schedule_time_table_column_schedule_no));

        $message = utils::make_response_result(schedule_time_model::$model_name, $schedule_time);

        $this->response($message, 200);
    }

    /**
     *  Update a schedule_time
     */
    function schedule_time_post() {
        $id = $this->get(schedule_time_model::$schedule_time_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        // $schedule_profile_id, $start_time, $end_time, $schedule_no
        $request_keys = array(schedule_time_model::$schedule_time_table_column_school_id, schedule_time_model::$schedule_time_table_column_institute_id, schedule_time_model::$schedule_time_table_column_schedule_profile_id, schedule_time_model::$schedule_time_table_column_start_time, schedule_time_model::$schedule_time_table_column_end_time, schedule_time_model::$schedule_time_table_column_schedule_no);
        $attribute = Utils::create_request_attribute($this, $request_keys);

        $schedule_time = $this->schedule_time_model->update($id, $attribute);

        $message = utils::make_response_result(schedule_time_model::$model_name, $schedule_time);

        $this->response($message, 200);
    }

    /**
     *  Delete a schedule_time
     */
    function schedule_time_delete() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
        }

        $this->schedule_time_model->delete($id);

        $message = utils::make_response_result(false, false);

        $this->response($message, 200);
    }


}