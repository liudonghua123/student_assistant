<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * lesson
 *
 * @package        CodeIgniter
 * @subpackage    lesson Assistant
 * @category    Controller
 * @author        LiuDonghua
 */
class Lesson_mgmt extends REST_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('language', 'url', 'student_assistant/utils'));
        $this->load->model(array('student_assistant/lesson_model', 'student_assistant/curriculum_model', 'student_assistant/curriculum_lesson_model'));
        $this->load->language(array('general', 'student_assistant/lesson'));
    }

    /**
     * Get a lesson
     */
    function lesson_get() {
        $id = $this->get(lesson_model::$lesson_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $lesson = $this->lesson_model->get_by_id($id);

        if ($lesson) {
            $message = utils::make_response_result(lesson_model::$model_name, $lesson);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(lesson_model::$model_name, $lesson, false, 'Lesson could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Get all lessons by institute id
     */
    function lessons_get() {
        $institute_id = $this->get(course_model::$course_table_column_institute_id);
        if ($institute_id) {
            $lessons = $this->lesson_model->get_by_institute_id($institute_id);
        } else {
            $lessons = $this->lesson_model->get();
        }

        if ($lessons) {
            $message = utils::make_response_result(lesson_model::$models_name, $lessons);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(lesson_model::$models_name, $lessons, false, 'Lessons could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Add a lesson
     */
    function lesson_put() {
        // create($course_id, $room_id, $teacher_id, $week, $day, $schedule_time)
        $lesson = $this->lesson_model->create($this->get(lesson_model::$lesson_table_column_school_id), $this->get(lesson_model::$lesson_table_column_institute_id), $this->get(lesson_model::$lesson_table_column_course_id), $this->get(lesson_model::$lesson_table_column_room_id), $this->get(lesson_model::$lesson_table_column_week), $this->get(lesson_model::$lesson_table_column_day), $this->get(lesson_model::$lesson_table_column_schedule_time_id));
        // if has a curriculum_id parameter than add it to a curriculum
        $curriculum_id = $this->get(curriculum_lesson_model::$curriculum_lesson_table_column_curriculum_id);
        if($curriculum_id) {
            $this->curriculum_lesson_model->create($curriculum_id, $lesson->id);
        }

        $message = utils::make_response_result(lesson_model::$model_name, $lesson);

        $this->response($message, 200);
    }

    /**
     *  Update a lesson
     */
    function lesson_post() {
        $id = $this->get(lesson_model::$lesson_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $request_keys = array(lesson_model::$lesson_table_column_school_id, lesson_model::$lesson_table_column_institute_id, lesson_model::$lesson_table_column_course_id, lesson_model::$lesson_table_column_room_id, lesson_model::$lesson_table_column_week, lesson_model::$lesson_table_column_day, lesson_model::$lesson_table_column_schedule_time_id);
        $attribute = Utils::create_request_attribute($this, $request_keys);

        $lesson = $this->lesson_model->update($id, $attribute);

        $message = utils::make_response_result(lesson_model::$model_name, $lesson);

        $this->response($message, 200);
    }

    /**
     *  Delete a lesson
     */
    function lesson_delete() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
        }

        // if has a curriculum_id parameter than delete it from a curriculum, must before lesson_model->delete($id)
        $curriculum_id = $this->get(curriculum_lesson_model::$curriculum_lesson_table_column_curriculum_id);
        if($curriculum_id) {
            $this->curriculum_lesson_model->delete($curriculum_id, $id);
        }

        $this->lesson_model->delete($id);

        $message = utils::make_response_result(false, false);

        $this->response($message, 200);
    }


}