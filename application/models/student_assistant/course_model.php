<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Course_model extends CI_Model {

    public static $model_name = 'course';
    public static $models_name = 'courses';

    public static $course_table_name = 'ss_course';

    public static $course_table_column_id = 'id';
    public static $course_table_column_school_id = 'school_id';
    public static $course_table_column_institute_id = 'institute_id';
    public static $course_table_column_major_id = 'major_id';
    public static $course_table_column_teacher_id = 'teacher_id';
    public static $course_table_column_course_name = 'course_name';
    public static $course_table_column_course_type_id = 'course_type_id';
    public static $course_table_column_course_description = 'course_description';

    function __construct() {
        parent::__construct();

        $this->load->database();
    }

    /**
     * Get all courses
     *
     * @return mixed
     */
    function get() {
        return $this->db->get(self::$course_table_name)->result();
    }

    /**
     * Get a course by id
     *
     * @param $id
     * @return mixed
     */
    function get_by_id($id) {
        return $this->db->get_where(self::$course_table_name, array('id' => $id))->row();
    }

    /**
     * Get all school courses
     *
     * @param $school_id
     * @return mixed
     */
    function get_by_school_id($school_id) {
        return $this->db->get_where(self::$course_table_name, array(self::$course_table_column_school_id => $school_id))->result();
    }


    /**
     * Get all institute courses
     *
     * @param $institute_id
     * @return mixed
     */
    function get_by_institute_id($institute_id) {
        return $this->db->get_where(self::$course_table_name, array(self::$course_table_column_institute_id => $institute_id))->result();
    }


    /**
     * Get all major courses
     *
     * @param $major_id
     * @return mixed
     */
    function get_by_major_id($major_id) {
        return $this->db->get_where(self::$course_table_name, array(self::$course_table_column_major_id => $major_id))->result();
    }

    /**
     * Get all institute courses(with course type)
     *
     * @param $institute_id
     * @param int $course_type_id
     * @return mixed
     */
    function get_by_institute_and_type($institute_id, $course_type_id = 1) {
        $this->db->where(self::$course_table_column_institute_id, $institute_id);
        if ($course_type_id) {
            $this->db->where(self::$course_table_column_course_type_id, $course_type_id);
        }

        return $this->db->get(self::$course_table_name)->result();
    }


    // --------------------------------------------------------------------

    /**
     * Create a new course
     *
     * @param $school_id
     * @param $institute_id
     * @param $major_id
     * @param $teacher_id
     * @param $course_name
     * @param int $course_type_id
     * @param null $course_description
     * @return mixed
     */
    function create($school_id, $institute_id, $major_id, $teacher_id, $course_name, $course_type_id = 1, $course_description = NULL) {
        $this->db->insert(self::$course_table_name, array(self::$course_table_column_school_id => $school_id, self::$course_table_column_institute_id => $institute_id, self::$course_table_column_major_id => $major_id, self::$course_table_column_teacher_id => $teacher_id, self::$course_table_column_course_name => $course_name, self::$course_table_column_course_type_id => $course_type_id, self::$course_table_column_course_description => $course_description));

        return $this->get_by_id($this->db->insert_id());
    }

    /**
     * Update a exist course
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    function update($id, $attributes = array()) {
        $this->db->where('id', $id);
        $this->db->update(self::$course_table_name, $attributes);

        return $this->get_by_id($id);
    }

    /**
     * Delete a exist course
     *
     * @param $id
     */
    function delete($id) {
        $this->db->delete(self::$course_table_name, array(self::$course_table_column_id => $id));
    }

}


/* End of file course_model.php */
/* Location: ./application/student_assistant/models/course_model.php */