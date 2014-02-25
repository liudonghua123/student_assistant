<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student_model extends CI_Model {

    public static $model_name = 'student';
    public static $models_name = 'students';

    public static $student_table_name = 'ss_student';

    public static $student_table_column_id = 'id';
    public static $student_table_column_school_id = 'school_id';
    public static $student_table_column_institute_id = 'institute_id';
    public static $student_table_column_major_id = 'major_id';
    public static $student_table_column_curriculum_id = 'curriculum_id';
    public static $student_table_column_name = 'name';
    public static $student_table_column_login_name = 'login_name';
    public static $student_table_column_password = 'password';
    public static $student_table_column_id_number = 'id_number';
    public static $student_table_column_gender = 'gender';

    public static $student_default_last_id_number = 6;

    function __construct() {
        parent::__construct();

        $this->load->database();
    }

    /**
     * Get all students
     *
     * @return mixed
     */
    function get() {
        return $this->db->get(self::$student_table_name)->result();
    }

    /**
     * Get a student by id
     *
     * @param $id
     * @return mixed
     */
    function get_by_id($id) {
        return $this->db->get_where(self::$student_table_name, array('id' => $id))->row();
    }

    /**
     * Get students by school id
     *
     * @param $school_id
     * @return mixed
     */
    function get_by_school_id($school_id) {
        return $this->db->get_where(self::$student_table_name, array(self::$student_table_column_school_id => $school_id))->result();
    }

    /**
     * Get students by institute id
     *
     * @param $institute_id
     * @return mixed
     */
    function get_by_institute_id($institute_id) {
        return $this->db->get_where(self::$student_table_name, array(self::$student_table_column_institute_id => $institute_id))->result();
    }


    // --------------------------------------------------------------------

    /**
     * Create a new student
     *
     * @param $name
     * @param $school_id
     * @param $institute_id
     * @param $major_id
     * @param $curriculum_id
     * @param $gender
     * @param $id_number
     * @param $login_name
     * @param null $password
     * @return mixed
     */
    function create($name, $school_id, $institute_id, $major_id, $curriculum_id, $gender, $id_number, $login_name, $password = NULL) {
        // Create password hash using phpass
        if ($password !== NULL) {
            $this->load->helper('account/phpass');
            $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $hashed_password = $hasher->HashPassword($password);
        }

        $this->db->insert(self::$student_table_name, array(self::$student_table_column_name => $name, self::$student_table_column_school_id => $school_id, self::$student_table_column_institute_id => $institute_id, self::$student_table_column_major_id => $major_id, self::$student_table_column_curriculum_id => $curriculum_id, self::$student_table_column_gender => $gender, self::$student_table_column_id_number => $id_number, self::$student_table_column_login_name => $login_name, self::$student_table_column_password => isset($hashed_password) ? $hashed_password : NULL));

        return $this->get_by_id($this->db->insert_id());
    }

    /**
     * Update a exist student
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    function update($id, $attributes = array()) {
        $this->db->where('id', $id);
        if (array_key_exists(self::$student_table_column_password, $attributes)) {
            $this->load->helper('account/phpass');
            $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $attributes[self::$student_table_column_password] = $hasher->HashPassword($attributes[self::$student_table_column_password]);
        }
        $this->db->update(self::$student_table_name, $attributes);

        return $this->get_by_id($id);
    }

    /**
     * Delete a exist student
     *
     * @param $id
     */
    function delete($id) {
        $this->db->delete(self::$student_table_name, array(self::$student_table_column_id => $id));
    }

}


/* End of file student_model.php */
/* Location: ./application/student_assistant/models/student_model.php */