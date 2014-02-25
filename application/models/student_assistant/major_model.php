<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Major_model extends CI_Model {

    public static $model_name = 'major';
    public static $models_name = 'majors';

    public static $major_table_name = 'ss_major';

    public static $major_table_column_id = 'id';
    public static $major_table_column_school_id = 'school_id';
    public static $major_table_column_institute_id = 'institute_id';
    public static $major_table_column_name = 'major_name';
    public static $major_table_column_description = 'major_description';

    function __construct() {
        parent::__construct();

        $this->load->database();
    }

    /**
     * Get all majors
     *
     * @return mixed
     */
    function get() {
        if (isset($id)) {
            return $this->db->get_where(self::$major_table_name, array('id' => $id))->row();
        }
        return $this->db->get(self::$major_table_name)->result();
    }

    /**
     * Get a major by id
     *
     * @param $id
     * @return mixed
     */
    function get_by_id($id) {
        return $this->db->get_where(self::$major_table_name, array('id' => $id))->row();
    }

    /**
     * Get all majors by school id
     *
     * @param $school_id
     * @return mixed
     */
    function get_by_school_id($school_id) {
        return $this->db->get_where(self::$major_table_name, array(self::$major_table_column_school_id => $school_id))->result();
    }

    /**
     * Get all majors by institute id
     *
     * @param $institute_id
     * @return mixed
     */
    function get_by_institute_id($institute_id) {
        return $this->db->get_where(self::$major_table_name, array(self::$major_table_column_institute_id => $institute_id))->result();
    }

    /**
     * Get all majors for specified school [and institute]
     *
     * @param $school_id
     * @param null $institute_id
     * @return mixed
     */
    function get_by_school_and_institute($school_id, $institute_id = NULL) {
        $this->db->where(self::$major_table_column_school_id, $school_id);
        if (isset($institute_id)) {
            $this->db->where(self::$major_table_column_institute_id, $institute_id);
        }
        return $this->db->get(self::$major_table_name)->result();
    }


    // --------------------------------------------------------------------

    /**
     * Create a new major
     *
     * @param $major_name
     * @param $major_school_id
     * @param null $major_institute_id
     * @param null $major_description
     * @return mixed
     */
    function create($major_name, $major_school_id, $major_institute_id = NULL, $major_description = NULL) {
        $this->db->insert(self::$major_table_name, array(self::$major_table_column_name => $major_name, self::$major_table_column_school_id => $major_school_id, self::$major_table_column_institute_id => $major_institute_id, self::$major_table_column_description => $major_description));

        return $this->get_by_id($this->db->insert_id());
    }

    /**
     * Update a exist major
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    function update($id, $attributes = array()) {
        $this->db->where('id', $id);
        $this->db->update(self::$major_table_name, $attributes);

        return $this->get_by_id($id);
    }

    /**
     * Delete a exist major
     *
     * @param $id
     */
    function delete($id) {
        $this->db->delete(self::$major_table_name, array(self::$major_table_column_id => $id));
    }

}


/* End of file major_model.php */
/* Location: ./application/student_assistant/models/major_model.php */