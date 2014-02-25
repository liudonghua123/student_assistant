<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * course
 *
 * @package        CodeIgniter
 * @subpackage    Student Assistant
 * @category    Controller
 * @author        LiuDonghua
 */
class Course_mgmt extends REST_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('language', 'url', 'student_assistant/utils'));
        $this->load->model(array('student_assistant/course_model'));
        $this->load->language(array('general', 'student_assistant/course'));
    }

    /**
     * Get a course
     */
    function course_get() {
        $id = $this->get(course_model::$course_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $course = $this->course_model->get_by_id($id);


        if ($course) {
            $message = utils::make_response_result(course_model::$model_name, $course);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(course_model::$model_name, $course, false, 'Course could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Get all courses
     */
    function courses_get() {

        $institute_id = $this->get(course_model::$course_table_column_institute_id);
        $course_type_id = $this->get(course_model::$course_table_column_course_type_id);

        if ($institute_id) {
            if ($course_type_id) {
                $courses = $this->course_model->get_by_institute_and_type($institute_id, $course_type_id);
            } else {
                $courses = $this->course_model->get_by_institute_and_type($institute_id);
            }
        } else {
            $courses = $this->course_model->get();
        }

        if ($courses) {
            $message = utils::make_response_result(course_model::$models_name, $courses);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(course_model::$models_name, $courses, false, 'Courses could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Delete a course
     */
    function course_put() {
        //  create($institute_id, $course_name, $course_type_id = 1, $course_description = NULL)
        $course = $this->course_model->create($this->get(course_model::$course_table_column_school_id), $this->get(course_model::$course_table_column_institute_id), $this->get(course_model::$course_table_column_major_id), $this->get(course_model::$course_table_column_teacher_id), $this->get(course_model::$course_table_column_course_name), $this->get(course_model::$course_table_column_course_type_id), $this->get(course_model::$course_table_column_course_description));

        $message = utils::make_response_result(course_model::$model_name, $course);

        $this->response($message, 200);
    }

    /**
     *  Update a course
     */
    function course_post() {
        $id = $this->get(course_model::$course_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $request_keys = array(course_model::$course_table_column_school_id, course_model::$course_table_column_institute_id, course_model::$course_table_column_major_id, course_model::$course_table_column_teacher_id, course_model::$course_table_column_course_name, course_model::$course_table_column_course_type_id, course_model::$course_table_column_course_description);
        $attribute = Utils::create_request_attribute($this, $request_keys);

        $course = $this->course_model->update($id, $attribute);

        $message = utils::make_response_result(course_model::$model_name, $course);

        $this->response($message, 200);
    }

    /**
     *  Delete a course
     */
    function course_delete() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
        }

        $this->course_model->delete($id);

        $message = utils::make_response_result(false, false);

        $this->response($message, 200);
    }

}