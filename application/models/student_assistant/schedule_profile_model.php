<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Schedule_profile_model extends CI_Model {

    public static $model_name = 'schedule_profile';
    public static $models_name = 'schedule_profiles';

    public static $schedule_profile_table_name = 'ss_schedule_profile';

    public static $schedule_profile_table_column_id = 'id';
    public static $schedule_profile_table_column_school_id = 'school_id';
    public static $schedule_profile_table_column_institute_id = 'institute_id';
    public static $schedule_profile_table_column_schedule_profile_name = 'schedule_profile_name';
    public static $schedule_profile_table_column_schedule_profile_description = 'schedule_profile_description';

    function __construct() {
        parent::__construct();

        $this->load->database();
    }

    /**
     * Get all schedule_profiles
     *
     * @return mixed
     */
    function get() {
        return $this->db->get(self::$schedule_profile_table_name)->result();
    }

    /**
     * Get schedule_profile by id
     *
     * @param null $id
     * @return mixed
     */
    function get_by_id($id) {
        return $this->db->get_where(self::$schedule_profile_table_name, array(self::$schedule_profile_table_column_id => $id))->row();
    }

    /**
     * Get schedule_profile by school_id
     *
     * @param null $school_id
     * @return mixed
     */
    function get_by_school_id($school_id) {
        return $this->db->get_where(self::$schedule_profile_table_name, array(self::$schedule_profile_table_column_school_id => $school_id))->result();
    }

    /**
     * Get schedule_profile by institute_id
     *
     * @param null $institute_id
     * @return mixed
     */
    function get_by_institute_id($institute_id) {
        return $this->db->get_where(self::$schedule_profile_table_name, array(self::$schedule_profile_table_column_institute_id => $institute_id))->result();
    }


    // --------------------------------------------------------------------

    /**
     * Create a new schedule_profile
     *
     * @param $school_id
     * @param $institute_id
     * @param $schedule_profile_name
     * @param null $schedule_profile_description
     * @return mixed
     */
    function create($school_id, $institute_id, $schedule_profile_name, $schedule_profile_description = NULL) {
        $this->db->insert(self::$schedule_profile_table_name, array(self::$schedule_profile_table_column_schedule_profile_name => $schedule_profile_name, self::$schedule_profile_table_column_school_id => $school_id, self::$schedule_profile_table_column_institute_id => $institute_id, self::$schedule_profile_table_column_schedule_profile_description => $schedule_profile_description));

        return $this->get_by_id($this->db->insert_id());
    }

    /**
     * Update a exist schedule_profile
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    function update($id, $attributes = array()) {
        $this->db->where('id', $id);
        $this->db->update(self::$schedule_profile_table_name, $attributes);

        return $this->get_by_id($id);
    }

    /**
     * Delete a exist schedule_profile
     *
     * @param $id
     */
    function delete($id) {
        $this->db->delete(self::$schedule_profile_table_name, array(self::$schedule_profile_table_column_id => $id));
    }

}


/* End of file schedule_profile_model.php */
/* Location: ./application/schedule_profile_assistant/models/schedule_profile_model.php */