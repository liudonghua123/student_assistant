<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class School_model extends CI_Model {

    public static $model_name = 'school';
    public static $models_name = 'schools';

    public static $school_table_name = 'ss_school';

    public static $school_table_column_id = 'id';
    public static $school_table_column_school_name = 'school_name';
    public static $school_table_column_description = 'school_description';
    public static $school_table_column_homepage = 'school_homepage';

    function __construct() {
        parent::__construct();

        $this->load->database();
    }

    /**
     * Get all schools
     *
     * @return mixed
     */
    function get() {
        return $this->db->get(self::$school_table_name)->result();
    }

    /**
     * Get a school by id
     *
     * @param $id
     * @return mixed
     */
    function get_by_id($id) {
        return $this->db->get_where(self::$school_table_name, array('id' => $id))->row();
    }


    // --------------------------------------------------------------------

    /**
     * Create a new school
     *
     * @param $school_name
     * @param null $school_description
     * @param null $school_homepage
     * @return mixed
     */
    function create($school_name, $school_description = NULL, $school_homepage = NULL) {
        $this->db->insert(self::$school_table_name, array(self::$school_table_column_school_name => $school_name, self::$school_table_column_description => $school_description, self::$school_table_column_homepage => $school_homepage));

        //		return $this->db->insert_id();

        return $this->get_by_id($this->db->insert_id());
    }

    /**
     * Update a exist school
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    function update($id, $attributes = array()) {
        $this->db->where('id', $id);
        $this->db->update(self::$school_table_name, $attributes);

        return $this->get_by_id($id);
    }

    /**
     * Delete a exist school
     *
     * @param $id
     */
    function  delete($id) {
        $this->db->delete(self::$school_table_name, array(self::$school_table_column_id => $id));
    }

}


/* End of file school_model.php */
/* Location: ./application/student_assistant/models/school_model.php */