<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Institute_model extends CI_Model {

    public static $model_name = 'institute';
    public static $models_name = 'institutes';

    public static $institute_table_name = 'ss_institute';

    public static $institute_table_column_id = 'id';
    public static $institute_table_column_school_id = 'school_id';
    public static $institute_table_column_institute_name = 'institute_name';
    public static $institute_table_column_institute_description = 'institute_description';
    public static $institute_table_column_institute_homepage = 'institute_homepage';

    function __construct() {
        parent::__construct();

        $this->load->database();
    }

    /**
     * Get all institutes
     *
     * @return mixed
     */
    function get() {
        return $this->db->get(self::$institute_table_name)->result();
    }

    /**
     * Get a institute by id
     *
     * @param $id
     * @return mixed
     */
    function get_by_id($id) {
        return $this->db->get_where(self::$institute_table_name, array('id' => $id))->row();
    }

    /**
     * Get all institutes by school id
     *
     * @param null $school_id
     * @return mixed
     */
    function get_by_school_id($school_id) {
        return $this->db->get_where(self::$institute_table_name, array(self::$institute_table_column_school_id => $school_id))->result();
    }


    // --------------------------------------------------------------------

    /**
     * Create a new institute
     *
     * @param $institute_name
     * @param $institute_school_id
     * @param null $institute_description
     * @param null $institute_homepage
     * @return mixed
     */
    function create($institute_name, $institute_school_id, $institute_description = NULL, $institute_homepage = NULL) {
        $this->db->insert(self::$institute_table_name, array(self::$institute_table_column_institute_name => $institute_name, self::$institute_table_column_school_id => $institute_school_id, self::$institute_table_column_institute_description => $institute_description, self::$institute_table_column_institute_homepage => $institute_homepage));

        return $this->get_by_id($this->db->insert_id());
    }

    /**
     * Update a exist institute
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    function update($id, $attributes = array()) {
        $this->db->where('id', $id);
        $this->db->update(self::$institute_table_name, $attributes);

        return $this->get_by_id($id);
    }

    /**
     * Delete a exist institute
     *
     * @param $id
     */
    function  delete($id) {
        $this->db->delete(self::$institute_table_name, array(self::$institute_table_column_id => $id));
    }

}


/* End of file institute_model.php */
/* Location: ./application/student_assistant/models/institute_model.php */