<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Course_type_model extends CI_Model {

    public static $model_name = 'course_type';
    public static $models_name = 'course_types';

    public static $course_type_table_name = 'ss_course_type';

    public static $course_type_table_column_id = 'id';
    public static $course_type_table_column_school_id = 'school_id';
    public static $course_type_table_column_course_type = 'course_type_name';
    public static $course_type_table_column_course_type_description = 'course_type_description';

    function __construct() {
        parent::__construct();

        $this->load->database();
    }

    /**
     * Get all course_types
     *
     * @return mixed
     */
    function get() {
        return $this->db->get(self::$course_type_table_name)->result();
    }

    /**
     * Get a course type by id
     *
     * @param $id
     * @return mixed
     */
    function get_by_id($id) {
        return $this->db->get_where(self::$course_type_table_name, array('id' => $id))->row();
    }

    /**
     * Get course types by school_id
     *
     * @param $school_id
     * @return mixed
     */
    function get_by_school_id($school_id) {
        return $this->db->get_where(self::$course_type_table_name, array(self::$course_type_table_column_school_id => $school_id))->result();
    }


    // --------------------------------------------------------------------

    /**
     * Create a new course_type
     *
     * @param $school_id
     * @param $course_type
     * @param null $course_type_description
     * @return mixed
     */
    function create($school_id, $course_type, $course_type_description = NULL) {
        $this->db->insert(self::$course_type_table_name, array(self::$course_type_table_column_school_id => $school_id,self::$course_type_table_column_course_type => $course_type, self::$course_type_table_column_course_type_description => $course_type_description));

        return $this->get_by_id($this->db->insert_id());
    }

    /**
     * Update a exist course_type
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    function update($id, $attributes = array()) {
        $this->db->where('id', $id);
        $this->db->update(self::$course_type_table_name, $attributes);

        return $this->get_by_id($id);
    }

    /**
     * Delete a exist course_type
     *
     * @param $id
     */
    function delete($id) {
        $this->db->delete(self::$course_type_table_name, array(self::$course_type_table_column_id => $id));
    }

}


/* End of file course_type_model.php */
/* Location: ./application/student_assistant/models/course_type_model.php */