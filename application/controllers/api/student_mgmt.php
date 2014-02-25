<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * student
 *
 * @package        CodeIgniter
 * @subpackage    Student Assistant
 * @category    Controller
 * @author        LiuDonghua
 */
class Student_mgmt extends REST_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->helper(array('language', 'url', 'student_assistant/utils'));
        $this->load->model(array('student_assistant/student_model'));
        $this->load->language(array('general', 'student_assistant/student'));
    }

    /**
     * Get a student
     */
    function student_get() {
        $id = $this->get(student_model::$student_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        $student = $this->student_model->get_by_id($id);

        if ($student) {
            //unset($student->password);
            $this->load->helper('student_assistant/utils');
            Utils::unset_property($student, 'password');
            $message = utils::make_response_result(student_model::$model_name, $student);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(student_model::$model_name, $student, false, 'Student could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Get all students by institute id
     */
    function students_get() {
        $institute_id = $this->get(student_model::$student_table_column_institute_id);

        if ($institute_id) {
            $students = $this->student_model->get_by_institute_id($institute_id);
        } else {
            $students = $this->student_model->get();
        }

        if ($students) {
            $this->load->helper('student_assistant/utils');
            Utils::unset_array_property($students, 'password');
            $message = utils::make_response_result(student_model::$model_name, $students);
            $this->response($message, 200);
        } else {
            $message = utils::make_response_result(student_model::$model_name, $students, false, 'Students could not be found');
            $this->response($message, 404);
        }
    }

    /**
     *  Add a student
     */
    function student_put() {
        $id_number = $this->get(student_model::$student_table_column_id_number);
        $password = $this->get(student_model::$student_table_column_password);
        if (!$password) {
            $password = substr($id_number, -student_model::$student_default_last_id_number);
        }
        // create($name, $school_id, $institute_id, $major_id, $curriculum_id, $gender, $id_number, $login_name, $password = NULL)
        $student = $this->student_model->create(
            $this->get(student_model::$student_table_column_name),
            $this->get(student_model::$student_table_column_school_id),
            $this->get(student_model::$student_table_column_institute_id),
            $this->get(student_model::$student_table_column_major_id),
            $this->get(student_model::$student_table_column_curriculum_id),
            $this->get(student_model::$student_table_column_gender),
            $this->get(student_model::$student_table_column_id_number),
            $this->get(student_model::$student_table_column_login_name),
            $password);

        $message = utils::make_response_result(student_model::$model_name, $student);

        $this->response($message, 200);
    }

    /**
     *  Update a student
     */
    function student_post() {
        $id = $this->get(student_model::$student_table_column_id);
        if (!$id) {
            $this->response(NULL, 400);
        }

        /*
        $attribute = array();
        $name = $this->get(student_model::$student_table_column_name);
        $login_name = $this->get(student_model::$student_table_column_login_name);
        $password = $this->get(student_model::$student_table_column_password);
        $id_number = $this->get(student_model::$student_table_column_id_number);
        $gender = $this->get(student_model::$student_table_column_gender);
        $institute_id = $this->get(student_model::$student_table_column_institute_id);
        if( isset($name) ) {
            $attribute[student_model::$student_table_column_name] = $name;
        }
        if( isset($login_name) ) {
            $attribute[student_model::$student_table_column_login_name] = $login_name;
        }
        if( isset($password) ) {
            $attribute[student_model::$student_table_column_password] = $password;
        }
        if( isset($id_number) ) {
            $attribute[student_model::$student_table_column_id_number] = $id_number;
        }
        if( isset($gender) ) {
            $attribute[student_model::$student_table_column_gender] = $gender;
        }
        if( isset($institute_id) ) {
            $attribute[student_model::$student_table_column_institute_id] = $institute_id;
        }
        */
        $request_keys = array(
            student_model::$student_table_column_name,
            student_model::$student_table_column_school_id,
            student_model::$student_table_column_institute_id,
            student_model::$student_table_column_major_id,
            student_model::$student_table_column_curriculum_id,
            student_model::$student_table_column_login_name,
            student_model::$student_table_column_password,
            student_model::$student_table_column_id_number,
            student_model::$student_table_column_gender);
        $attribute = Utils::create_request_attribute($this, $request_keys);

        $student = $this->student_model->update($id, $attribute);

        $message = utils::make_response_result(student_model::$model_name, $student);

        $this->response($message, 200);
    }

    /**
     *  Delete a student
     */
    function student_delete() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
        }

        $this->student_model->delete($id);

        $message = utils::make_response_result(false, false);

        $this->response($message, 200);
    }


}