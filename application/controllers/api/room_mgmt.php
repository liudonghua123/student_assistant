<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * room
 *
 * @package        CodeIgniter
 * @subpackage    Student Assistant
 * @category    Controller
 * @author        LiuDonghua
 */
class Room_mgmt extends REST_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('language', 'url', 'student_assistant/utils'));
        $this->load->model(array('student_assistant/room_model'));
        $this->load->language(array('general', 'student_assistant/room'));
    }

    /**
     * Get a room
     */
    function room_get() {
        $id = $this->get(room_model::$room_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $room = $this->room_model->get_by_id($id);

        if ($room) {
            $message = utils::make_response_result(room_model::$model_name, $room);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(room_model::$model_name, $room, false, 'Rooms could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Get all rooms
     */
    function rooms_get() {
        $school_id = $this->get(room_model::$room_table_column_school_id);
        $institute_id = $this->get(room_model::$room_table_column_institute_id);

        if ($school_id) {
            $rooms = $this->room_model->get_by_school_and_institute($school_id, $institute_id);
        } else {
            $rooms = $this->room_model->get();
        }

        if ($rooms) {
            $message = utils::make_response_result(room_model::$models_name, $rooms);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(room_model::$models_name, $rooms, false, 'Rooms could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Add a room
     */
    function room_put() {
        $room = $this->room_model->create($this->get(room_model::$room_table_column_name), $this->get(room_model::$room_table_column_school_id), $this->get(room_model::$room_table_column_institute_id), $this->get(room_model::$room_table_column_description));

        $message = utils::make_response_result(room_model::$model_name, $room);

        $this->response($message, 200);
    }

    /**
     *  Update a room
     */
    function room_post() {
        $id = $this->get(room_model::$room_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $request_keys = array(room_model::$room_table_column_name, room_model::$room_table_column_school_id, room_model::$room_table_column_institute_id, room_model::$room_table_column_description);
        $attribute = Utils::create_request_attribute($this, $request_keys);

        $room = $this->room_model->update($id, $attribute);

        $message = utils::make_response_result(room_model::$model_name, $room);

        $this->response($message, 200);
    }

    /**
     *  Delete a room
     */
    function room_delete() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
        }

        $this->room_model->delete($id);

        $message = utils::make_response_result(false, false);

        $this->response($message, 200);
    }

}