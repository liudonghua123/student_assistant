<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lesson_model extends CI_Model {

    public static $model_name = 'lesson';
    public static $models_name = 'lessons';

    public static $lesson_table_name = 'ss_lesson';

    public static $lesson_table_column_id = 'id';
    public static $lesson_table_column_school_id = 'school_id';
    public static $lesson_table_column_institute_id = 'institute_id';
    public static $lesson_table_column_course_id = 'course_id';
    public static $lesson_table_column_room_id = 'room_id';
    public static $lesson_table_column_week = 'week';
    public static $lesson_table_column_day = 'day';
    public static $lesson_table_column_schedule_time_id = 'schedule_time_id';

    function __construct() {
        parent::__construct();

        $this->load->database();
    }

    /**
     * Get all lessons
     *
     * @return mixed
     */
    function get() {
        return $this->db->get(self::$lesson_table_name)->result();
    }

    /**
     * Get a lesson by id
     *
     * @param null $id
     */
    function get_by_id($id) {
        return $this->db->get_where(self::$lesson_table_name, array('id' => $id))->row();
    }

    /**
     * Get all lessons or a specify school
     *
     * @param $school_id
     * @return mixed
     */
    function get_by_school_id($school_id) {
        $this->db->where(self::$lesson_table_column_school_id, $school_id);
        return $this->db->get(self::$lesson_table_name)->result();
    }

    /**
     * Get all lessons or a specify institute
     *
     * @param $institute_id
     * @return mixed
     */
    function get_by_institute_id($institute_id) {
        $this->db->where(self::$lesson_table_column_institute_id, $institute_id);
        return $this->db->get(self::$lesson_table_name)->result();
    }

    /**
     * Get all lessons or a specify curriculum
     *
     * @param $curriculum_id
     * @return mixed
     */
    function get_by_curriculum_id($curriculum_id) {

        // Use inner join see http://ellislab.com/codeigniter/user-guide/database/active_record.html#select
        // select id, school_id, institute_id, course_id, room_id, teacher_id, week, day, schedule_time_id
        // from ss_lesson
        // inner join ss_curriculum_lesson
        // on ss_lesson.id = ss_curriculum_lesson.lesson_id where ss_curriculum_lesson.curriculum_id=$curriculum_id;
        // method 1: Use built-in join function
        //        $this->db->select('id, school_id, institute_id, course_id, room_id, teacher_id, week, day, schedule_time_id');
        //        $this->db->from(self::$lesson_table_name);
        //        $this->db->join(curriculum_lesson_model::$curriculum_lesson_table_name, "ss_lesson.id = ss_curriculum_lesson.lesson_id where ss_curriculum_lesson.curriculum_id=$curriculum_id");

        // Or use sub-queries like below, but CodeIgniter Active Records do not currently support sub-queries
        // see http://stackoverflow.com/questions/6047149/subquery-in-codeigniter-active-record
       // method 2: Use sub-query more (readable)
        // select * from ss_lesson where id in (select lesson_id from ss_curriculum_lesson where curriculum_id=$curriculum_id);
        $query = $this->db->get_where(self::$lesson_table_name, "`id` IN (SELECT `lesson_id` FROM `ss_curriculum_lesson` where `curriculum_id`= $curriculum_id)", NULL, FALSE);
        return $query->result();
        // Equivalent to
        //$this->db->select('*')->from(self::$lesson_table_name);
        //$this->db->where("`id` IN (SELECT `lesson_id` FROM `ss_curriculum_lesson` where `curriculum_id`= $curriculum_id)", NULL, FALSE);
        //return $this->db->get()->result();
    }


    // --------------------------------------------------------------------

    /**
     * Create a new lesson
     *
     * @param $school_id
     * @param $institute_id
     * @param $course_id
     * @param $room_id
     * @param $week
     * @param $day
     * @param $schedule_time
     * @return mixed
     */
    function create($school_id, $institute_id, $course_id, $room_id, $week, $day, $schedule_time) {
        $this->db->insert(self::$lesson_table_name, array(self::$lesson_table_column_school_id => $school_id, self::$lesson_table_column_institute_id => $institute_id, self::$lesson_table_column_course_id => $course_id, self::$lesson_table_column_room_id => $room_id, self::$lesson_table_column_week => $week, self::$lesson_table_column_day => $day, self::$lesson_table_column_schedule_time_id => $schedule_time));

        return $this->get_by_id($this->db->insert_id());
    }

    /**
     * Update a exist lesson
     *
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    function update($id, $attributes = array()) {
        $this->db->where('id', $id);
        $this->db->update(self::$lesson_table_name, $attributes);
        return $this->get_by_id($id);
    }

    /**
     * Delete a exist lesson
     *
     * @param $id
     */
    function delete($id) {
        $this->db->delete(self::$lesson_table_name, array(self::$lesson_table_column_id => $id));
    }

}


/* End of file lesson_model.php */
/* Location: ./application/student_assistant/models/lesson_model.php */