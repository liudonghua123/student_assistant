<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Curriculum_model extends CI_Model {

    public static $model_name = 'curriculum';
    public static $models_name = 'curriculums';

    public static $curriculum_table_name = 'ss_curriculum';

    public static $curriculum_table_column_id = 'id';
    public static $curriculum_table_column_school_id = 'school_id';
    public static $curriculum_table_column_institute_id = 'institute_id';
    public static $curriculum_table_column_curriculum_name = 'curriculum_name';
    public static $curriculum_table_column_curriculum_description = 'curriculum_description';

    function __construct() {
        parent::__construct();

        $this->load->database();
    }

    /**
     * Get all curriculums
     *
     * @return mixed
     */
    function get() {
        return $this->db->get(self::$curriculum_table_name)->result();
    }

    /**
     * Get a curriculum by id
     *
     * @param $id
     * @return mixed
     */
    function get_by_id($id) {
        return $this->db->get_where(self::$curriculum_table_name, array(self::$curriculum_table_column_id => $id))->row();
    }

    /**
     * Get a curriculum by school id
     *
     * @param $school_id
     * @return mixed
     */
    function get_by_school_id($school_id) {
        return $this->db->get_where(self::$curriculum_table_name, array(self::$curriculum_table_column_school_id => $school_id))->result();
    }

    /**
     * Get a curriculum by institute id
     *
     * @param $institute_id
     * @return mixed
     */
    function get_by_institute_id($institute_id) {
        return $this->db->get_where(self::$curriculum_table_name, array(self::$curriculum_table_column_institute_id => $institute_id))->result();
    }


    // --------------------------------------------------------------------

    /**
     * Create a new curriculum
     *
     * @param $school_id
     * @param $institute_id
     * @param $curriculum_name
     * @param null $curriculum_description
     * @return mixed
     */
    function create($school_id, $institute_id, $curriculum_name, $curriculum_description = NULL) {
        $this->db->insert(self::$curriculum_table_name, array(self::$curriculum_table_column_curriculum_name => $curriculum_name, self::$curriculum_table_column_school_id => $school_id, self::$curriculum_table_column_institute_id => $institute_id, self::$curriculum_table_column_curriculum_description => $curriculum_description));

        return $this->get_by_id($this->db->insert_id());
    }

    /**
     * Update a exist curriculum
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    function update($id, $attributes = array()) {
        $this->db->where('id', $id);
        $this->db->update(self::$curriculum_table_name, $attributes);

        return $this->get_by_id($id);
    }

    /**
     * Delete a exist curriculum
     *
     * @param $id
     */
    function delete($id) {
        $this->db->delete(self::$curriculum_table_name, array(self::$curriculum_table_column_id => $id));
    }

}


/* End of file curriculum_model.php */
/* Location: ./application/student_assistant/models/curriculum_model.php */