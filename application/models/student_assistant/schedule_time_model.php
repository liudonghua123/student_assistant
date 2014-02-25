<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Schedule_time_model extends CI_Model {

    public static $model_name = 'schedule_time';
    public static $models_name = 'schedule_times';

    public static $schedule_time_table_name = 'ss_schedule_time';

    public static $schedule_time_table_column_id = 'id';
    public static $schedule_time_table_column_school_id = 'school_id';
    public static $schedule_time_table_column_institute_id = 'institute_id';
    public static $schedule_time_table_column_schedule_profile_id = 'schedule_profile_id';
    public static $schedule_time_table_column_start_time = 'start_time';
    public static $schedule_time_table_column_end_time = 'end_time';
    public static $schedule_time_table_column_schedule_no = 'schedule_no';

    function __construct() {
        parent::__construct();

        $this->load->database();
    }

    /**
     * Get all schedule_times
     *
     * @return mixed
     */
    function get() {
        return $this->db->get(self::$schedule_time_table_name)->result();
    }

    /**
     * Get schedule_time by id
     *
     * @param null $id
     * @return mixed
     */
    function get_by_id($id) {
        return $this->db->get_where(self::$schedule_time_table_name, array(self::$schedule_time_table_column_id => $id))->row();
    }

    /**
     * Get schedule_time by school_id
     *
     * @param school_id
     * @return mixed
     */
    function get_by_school_id($school_id) {
        return $this->db->get_where(self::$schedule_time_table_name, array(self::$schedule_time_table_column_school_id => $school_id))->result();
    }

    /**
     * Get schedule_time by institute_id
     *
     * @param $institute_id
     * @return mixed
     */
    function get_by_institute_id($institute_id) {
        return $this->db->get_where(self::$schedule_time_table_name, array(self::$schedule_time_table_column_institute_id => $institute_id))->result();
    }

    /**
     * Get schedule_times by institute id
     *
     * @param $schedule_profile_id
     * @return mixed
     */
    function get_by_schedule_profile_id($schedule_profile_id) {
        return $this->db->get_where(self::$schedule_time_table_name, array(self::$schedule_time_table_column_schedule_profile_id => $schedule_profile_id))->result();
    }


    // --------------------------------------------------------------------

    /**
     * Create a new schedule_time
     *
     * @param $school_id
     * @param $institute_id
     * @param $schedule_profile_id
     * @param $start_time
     * @param $end_time
     * @param $schedule_no
     * @return mixed
     */
    function create($school_id, $institute_id, $schedule_profile_id, $start_time, $end_time, $schedule_no) {
        $this->db->insert(self::$schedule_time_table_name, array(self::$schedule_time_table_column_school_id => $school_id, self::$schedule_time_table_column_institute_id => $institute_id, self::$schedule_time_table_column_schedule_profile_id => $schedule_profile_id, self::$schedule_time_table_column_start_time => $start_time, self::$schedule_time_table_column_end_time => $end_time, self::$schedule_time_table_column_schedule_no => $schedule_no));

        return $this->get_by_id($this->db->insert_id());
    }

    /**
     * Update a exist schedule_time
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    function update($id, $attributes = array()) {
        $this->db->where('id', $id);
        $this->db->update(self::$schedule_time_table_name, $attributes);

        return $this->get_by_id($id);
    }

    /**
     * Delete a exist schedule_time
     *
     * @param $id
     */
    function delete($id) {
        $this->db->delete(self::$schedule_time_table_name, array(self::$schedule_time_table_column_id => $id));
    }

}


/* End of file schedule_time_model.php */
/* Location: ./application/schedule_time_assistant/models/schedule_time_model.php */