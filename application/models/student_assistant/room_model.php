<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Room_model extends CI_Model {

    public static $model_name = 'room';
    public static $models_name = 'rooms';

    public static $room_table_name = 'ss_room';

    public static $room_table_column_id = 'id';
    public static $room_table_column_school_id = 'school_id';
    public static $room_table_column_institute_id = 'institute_id';
    public static $room_table_column_name = 'room_name';
    public static $room_table_column_description = 'room_description';

    function __construct() {
        parent::__construct();

        $this->load->database();
    }

    /**
     * Get all rooms
     *
     * @return mixed
     */
    function get() {
        if (isset($id)) {
            return $this->db->get_where(self::$room_table_name, array('id' => $id))->row();
        }
        return $this->db->get(self::$room_table_name)->result();
    }

    /**
     * Get a room by id
     *
     * @param $id
     * @return mixed
     */
    function get_by_id($id) {
        return $this->db->get_where(self::$room_table_name, array('id' => $id))->row();
    }

    /**
     * Get all rooms by school id
     *
     * @param $school_id
     * @return mixed
     */
    function get_by_school_id($school_id) {
        return $this->db->get_where(self::$room_table_name, array(self::$room_table_column_school_id => $school_id))->result();
    }

    /**
     * Get all rooms for specified school [and institute]
     *
     * @param $school_id
     * @param null $institute_id
     * @return mixed
     */
    function get_by_school_and_institute($school_id, $institute_id = NULL) {
        $this->db->where(self::$room_table_column_school_id, $school_id);
        if (isset($institute_id)) {
            $this->db->where(self::$room_table_column_institute_id, $institute_id);
        }
        return $this->db->get(self::$room_table_name)->result();
    }


    // --------------------------------------------------------------------

    /**
     * Create a new room
     *
     * @param $room_name
     * @param $room_school_id
     * @param null $room_institute_id
     * @param null $room_description
     * @return mixed
     */
    function create($room_name, $room_school_id, $room_institute_id = NULL, $room_description = NULL) {
        $this->db->insert(self::$room_table_name, array(self::$room_table_column_name => $room_name, self::$room_table_column_school_id => $room_school_id, self::$room_table_column_institute_id => $room_institute_id, self::$room_table_column_description => $room_description));

        return $this->get_by_id($this->db->insert_id());
    }

    /**
     * Update a exist room
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    function update($id, $attributes = array()) {
        $this->db->where('id', $id);
        $this->db->update(self::$room_table_name, $attributes);

        return $this->get_by_id($id);
    }

    /**
     * Delete a exist room
     *
     * @param $id
     */
    function delete($id) {
        $this->db->delete(self::$room_table_name, array(self::$room_table_column_id => $id));
    }

}


/* End of file room_model.php */
/* Location: ./application/student_assistant/models/room_model.php */