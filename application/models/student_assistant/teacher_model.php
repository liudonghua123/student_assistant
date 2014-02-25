<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teacher_model extends CI_Model {

    public static $model_name = 'teacher';
    public static $models_name = 'teachers';

    public static $teacher_table_name = 'ss_teacher';

    public static $teacher_table_column_id = 'id';
    public static $teacher_table_column_school_id = 'school_id';
    public static $teacher_table_column_institute_id = 'institute_id';
    public static $teacher_table_column_teacher_name = 'teacher_name';
    public static $teacher_table_column_teacher_gender = 'teacher_gender';
    public static $teacher_table_column_teacher_research_area = 'teacher_research_area';

    function __construct() {
        parent::__construct();

        $this->load->database();
    }

    /**
     * Get all teachers
     *
     * @return mixed
     */
    function get() {
        return $this->db->get(self::$teacher_table_name)->result();
    }

    /**
     * Get teacher by id
     *
     * @param null $id
     * @return mixed
     */
    function get_by_id($id) {
        return $this->db->get_where(self::$teacher_table_name, array('id' => $id))->row();
    }

    /**
     * Get teachers by school id
     *
     * @param $school_id
     * @return mixed
     */
    function get_by_school_id($school_id) {
        return $this->db->get_where(self::$teacher_table_name, array(self::$teacher_table_column_school_id => $school_id))->result();
    }

    /**
     * Get teachers by institute id
     *
     * @param $institute_id
     * @return mixed
     */
    function get_by_institute_id($institute_id) {
        return $this->db->get_where(self::$teacher_table_name, array(self::$teacher_table_column_institute_id => $institute_id))->result();
    }


    // --------------------------------------------------------------------

    /**
     * Create a new teacher
     *
     * @param $school_id
     * @param $institute_id
     * @param $teacher_name
     * @param $teacher_gender
     * @param null $teacher_research_area
     * @return mixed
     */
    function create($school_id, $institute_id, $teacher_name, $teacher_gender, $teacher_research_area = NULL) {

        $this->db->insert(self::$teacher_table_name, array(self::$teacher_table_column_teacher_name => $teacher_name, self::$teacher_table_column_school_id => $school_id, self::$teacher_table_column_institute_id => $institute_id, self::$teacher_table_column_teacher_gender => $teacher_gender, self::$teacher_table_column_teacher_research_area => $teacher_research_area));

        return $this->get_by_id($this->db->insert_id());
    }

    /**
     * Update a exist teacher
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    function update($id, $attributes = array()) {
        $this->db->where('id', $id);
        $this->db->update(self::$teacher_table_name, $attributes);

        return $this->get_by_id($id);
    }

    /**
     * Delete a exist teacher
     *
     * @param $id
     */
    function delete($id) {
        $this->db->delete(self::$teacher_table_name, array(self::$teacher_table_column_id => $id));
    }

}


/* End of file teacher_model.php */
/* Location: ./application/teacher_assistant/models/teacher_model.php */