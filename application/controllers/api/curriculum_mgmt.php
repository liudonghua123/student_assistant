<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * curriculum
 *
 * @package        CodeIgniter
 * @subpackage    curriculum Assistant
 * @category    Controller
 * @author        LiuDonghua
 */
class Curriculum_mgmt extends REST_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('language', 'url', 'student_assistant/utils'));
        $this->load->model(array('student_assistant/curriculum_model', 'student_assistant/lesson_model', 'student_assistant/curriculum_lesson_model'));
        $this->load->language(array('general', 'student_assistant/curriculum'));
    }

    /**
     * Get a curriculum
     */
    function curriculum_get() {
        $id = $this->get(curriculum_model::$curriculum_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $curriculum = $this->curriculum_model->get_by_id($id);

        if ($curriculum) {
            $message = utils::make_response_result(curriculum_model::$model_name, $curriculum);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(curriculum_model::$model_name, $curriculum, false, 'Curriculum could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Get all curriculums by institute id
     */
    function curriculums_get() {
        $curriculums = $this->curriculum_model->get();

        if ($curriculums) {
            $message = utils::make_response_result(curriculum_model::$models_name, $curriculums);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(curriculum_model::$models_name, $curriculums, false, 'Curriculums could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Add a curriculum
     */
    function curriculum_put() {
        // create($course_id, $room_id, $teacher_id, $week, $day, $schedule_time)
        $curriculum = $this->curriculum_model->create(
            $this->get(curriculum_model::$curriculum_table_column_school_id),
            $this->get(curriculum_model::$curriculum_table_column_institute_id),
            $this->get(curriculum_model::$curriculum_table_column_curriculum_name),
            $this->get(curriculum_model::$curriculum_table_column_curriculum_description));

        $message = utils::make_response_result(curriculum_model::$model_name, $curriculum);

        $this->response($message, 200);
    }

    /**
     *  Update a curriculum
     */
    function curriculum_post() {
        $id = $this->get(curriculum_model::$curriculum_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        // $course_id, $room_id, $teacher_id, $week, $day, $schedule_time
        $request_keys = array(
            curriculum_model::$curriculum_table_column_school_id,
            curriculum_model::$curriculum_table_column_institute_id,
            curriculum_model::$curriculum_table_column_curriculum_name,
            curriculum_model::$curriculum_table_column_curriculum_description);
        $attribute = Utils::create_request_attribute($this, $request_keys);

        $curriculum = $this->curriculum_model->update($id, $attribute);

        $message = utils::make_response_result(curriculum_model::$model_name, $curriculum);

        $this->response($message, 200);
    }

    /**
     *  Delete a curriculum
     */
    function curriculum_delete() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
        }

        $this->curriculum_model->delete($id);

        $message = utils::make_response_result(false, false);

        $this->response($message, 200);
    }

    function lessons_get() {
        $curriculum_id = $this->get(curriculum_lesson_model::$curriculum_lesson_table_column_curriculum_id);
        if (!$curriculum_id) {
            $this->response(NULL, 400);
        }
        $lesson_ids = $this->curriculum_lesson_model->get_by_id($curriculum_id);

        $this->response($lesson_ids, 200);

    }

    function lesson_put() {
        $curriculum_id = $this->get(curriculum_lesson_model::$curriculum_lesson_table_column_curriculum_id);
        $lesson_id = $this->get(curriculum_lesson_model::$curriculum_lesson_table_column_lesson_id);
        if (!$curriculum_id) {
            $this->response(NULL, 400);
        }
        $this->curriculum_lesson_model->create($curriculum_id, $lesson_id);

        $message = array(curriculum_lesson_model::$curriculum_lesson_table_column_curriculum_id => $curriculum_id, curriculum_lesson_model::$curriculum_lesson_table_column_lesson_id => $lesson_id, 'message' => 'CREATED!');

        $this->response($message, 200);
    }

    function lesson_delete() {
        $curriculum_id = $this->get(curriculum_lesson_model::$curriculum_lesson_table_column_curriculum_id);
        $lesson_id = $this->get(curriculum_lesson_model::$curriculum_lesson_table_column_lesson_id);
        if (!$curriculum_id) {
            $this->response(NULL, 400);
        }
        $this->curriculum_lesson_model->delete($curriculum_id, $lesson_id);

        $message = array(curriculum_lesson_model::$curriculum_lesson_table_column_curriculum_id => $curriculum_id, curriculum_lesson_model::$curriculum_lesson_table_column_lesson_id => $lesson_id, 'message' => 'DELETED!');

        $this->response($message, 200);
    }


}