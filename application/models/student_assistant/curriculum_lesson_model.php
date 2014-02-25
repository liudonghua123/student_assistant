<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Curriculum_lesson_model extends CI_Model {

    public static $model_name = 'curriculum_lesson';
    public static $models_name = 'curriculum_lessons';

    public static $curriculum_lesson_table_name = 'ss_curriculum_lesson';

    public static $curriculum_lesson_table_column_curriculum_id = 'curriculum_id';
    public static $curriculum_lesson_table_column_lesson_id = 'lesson_id';

    function __construct() {
        parent::__construct();

        $this->load->database();
    }

    /**
     * Get a specify curriculum_lesson
     *
     * @param $curriculum_id
     * @param $lesson_id
     * @return mixed
     */
    function get_by_curriculum_id_and_lesson_id($curriculum_id, $lesson_id) {
        return $this->db->get_where(self::$curriculum_lesson_table_name, array(self::$curriculum_lesson_table_column_curriculum_id => $curriculum_id, self::$curriculum_lesson_table_column_lesson_id => $lesson_id))->row();
    }

    /**
     * Get all curriculum_lessons or a specify curriculum_lesson
     *
     * @param null $curriculum_id
     * @return mixed
     */
    function get_by_curriculum_id($curriculum_id) {
        $this->db->select(self::$curriculum_lesson_table_column_lesson_id);
        return $this->db->get_where(self::$curriculum_lesson_table_name, array(self::$curriculum_lesson_table_column_curriculum_id => $curriculum_id))->result();
    }


    // --------------------------------------------------------------------

    /**
     * Create a new curriculum_lesson
     *
     * @param $curriculum_id
     * @param $lesson_id
     * @return mixed
     */
    function create($curriculum_id, $lesson_id) {
        $this->db->insert(self::$curriculum_lesson_table_name, array(self::$curriculum_lesson_table_column_curriculum_id => $curriculum_id, self::$curriculum_lesson_table_column_lesson_id => $lesson_id));

        return $this->get_by_curriculum_id_and_lesson_id($curriculum_id, $lesson_id);
    }

    /**
     * Update a exist curriculum_lesson
     *
     * @param $curriculum_id
     * @param array $attributes
     * @return mixed
     */
    function update($curriculum_id, $attributes = array()) {
        $this->db->where(self::$curriculum_lesson_table_column_curriculum_id, $curriculum_id);
        $this->db->update(self::$curriculum_lesson_table_name, $attributes);

        return $this->get_by_curriculum_id_and_lesson_id($curriculum_id, $attributes[self::$curriculum_lesson_table_column_lesson_id]);
    }

    /**
     * Delete a exist curriculum_lesson
     *
     * @param $curriculum_id
     * @param $lesson_id
     */
    function  delete($curriculum_id, $lesson_id) {
        $this->db->delete(self::$curriculum_lesson_table_name, array(self::$curriculum_lesson_table_column_curriculum_id => $curriculum_id, self::$curriculum_lesson_table_column_lesson_id => $lesson_id));
    }

}


/* End of file curriculum_lesson_model.php */
/* Location: ./application/student_assistant/models/curriculum_lesson_model.php */