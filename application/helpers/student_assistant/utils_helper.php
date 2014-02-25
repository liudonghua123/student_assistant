<?php
class Utils {

    //var $weeks_js_map = {'0':'NormalWeek', '1':'OddWeek', '2':'EvenWeek'};
    private static $lesson_week = array(0 => 'NormalWeek', 1 => 'OddWeek', 2 => 'EvenWeek');

    //var $days_js_map = {'1':'Monday', '2':'Tuesday', '3':'Wednesday', '4':'Thursday', '5':'Friday', '6':'Saturday', '7':'Sunday'};
    private static $lesson_day = array(1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday');

    function __construct() {
        parent::__construct();

        // Load the necessary stuff...
        //$this->load->helper(array('date', 'language', 'url'));
        //$this->load->language(array('general'));
    }

    public static function unset_property($var, $property) {
        if (is_object($var)) {
            unset($var->$property);
        } else if (is_array($var)) {
            unset($var[$property]);
        }
    }

    public static function unset_array_property($var, $property) {
        foreach ($var as $key => $value) {
            self::unset_property($value, $property);
        }
    }

    public static function create_request_attribute($object, $request_keys) {
        $attribute = array();
        foreach ($request_keys as $para_key) {
            $para_value = $object->get($para_key);
            if (isset($para_value)) {
                $attribute[$para_key] = $para_value;
            }
        }
        return $attribute;
    }

    public static function make_response_result($name, $value, $is_success = true, $error_message = NULL) {
        $result = array('result' => $is_success ? 'success' : 'error');
        if ($name) {
            $result[$name] = $value;
        }
        if (!$is_success && $error_message) {
            $result['error'] = $error_message;
        }
        return $result;
    }

    public static function get_school_name($school, $schools, $school_id) {
        if ($school && $school->id == $school_id) {
            return $school->school_name;
        } else if ($schools) {
            foreach ($schools as $school) {
                if ($school->id == $school_id) {
                    return $school->school_name;
                }
            }
        } else {
            return false;
        }
    }

    public static function get_institute_name($institute, $institutes, $institute_id) {
        if ($institute && $institute->id == $institute_id) {
            return $institute->institute_name;
        } else if ($institutes) {
            foreach ($institutes as $institute) {
                if ($institute->id == $institute_id) {
                    return $institute->institute_name;
                }
            }
        } else {
            return false;
        }
    }

    public static function get_major_name($major, $majors, $major_id) {
        if ($major && $major->id == $major_id) {
            return $major->major_name;
        } else if ($majors) {
            foreach ($majors as $major) {
                if ($major->id == $major_id) {
                    return $major->major_name;
                }
            }
        } else {
            return false;
        }
    }

    public static function get_course_type_name($course_types, $institute_id) {
        if ($course_types) {
            foreach ($course_types as $course_type) {
                if ($course_type->id == $institute_id) {
                    return $course_type->course_type_name;
                }
            }
        } else {
            return false;
        }
    }

    public static function get_gender_name($gender_key) {
        if ($gender_key == 'm') {
            return lang('gender_name_male');
        } else {
            return lang('gender_name_female');
        }
    }

    public static function get_week_name($week) {
        //return self::$lesson_week[$week];
        switch ($week) {
            case 0:
                return lang('lesson_week_normal');
                break;
            case 1:
                return lang('lesson_week_odd');
                break;
            case 2:
                return lang('lesson_week_even');
                break;
        }

    }

    public static function get_day_name($day) {
        //return self::$lesson_day[$day];
        switch ($day) {
            case 1:
                return lang('lesson_day_monday');
                break;
            case 2:
                return lang('lesson_day_tuesday');
                break;
            case 3:
                return lang('lesson_day_wednesday');
                break;
            case 4:
                return lang('lesson_day_thursday');
                break;
            case 5:
                return lang('lesson_day_friday');
                break;
            case 6:
                return lang('lesson_day_saturday');
                break;
            case 7:
                return lang('lesson_day_sunday');
                break;
        }

    }

    public static function get_schedule_profile_name($schedule_profiles, $schedule_profile_id) {
        if ($schedule_profiles) {
            foreach ($schedule_profiles as $schedule_profile) {
                if ($schedule_profile->id == $schedule_profile_id) {
                    return $schedule_profile->schedule_profile_name;
                }
            }
        }
        return false;
    }

    public static function get_course_name($courses, $course_id) {
        if ($courses) {
            foreach ($courses as $course) {
                if ($course->id == $course_id) {
                    return $course->course_name;
                }
            }
        }
        return false;
    }

    public static function get_room_name($rooms, $room_id) {
        if ($rooms) {
            foreach ($rooms as $room) {
                if ($room->id == $room_id) {
                    return $room->room_name;
                }
            }
        }
        return false;
    }

    public static function get_teacher_name($teachers, $teacher_id) {
        if ($teachers) {
            foreach ($teachers as $teacher) {
                if ($teacher->id == $teacher_id) {
                    return $teacher->teacher_name;
                }
            }
        }
        return false;
    }

    public static function get_schedule_time_name($schedule_times, $schedule_time_id) {
        if ($schedule_times) {
            foreach ($schedule_times as $schedule_time) {
                if ($schedule_time->id == $schedule_time_id) {
                    return $schedule_time->start_time . '-' . $schedule_time->end_time;
                }
            }
        }
        return false;
    }

    public static function get_curriculum_name($curriculum, $curriculums, $curriculum_id) {
        if ($curriculum && $curriculum->id == $curriculum_id) {
            return $curriculum->curriculum_name;
        } else if ($curriculums) {
            foreach ($curriculums as $curriculum) {
                if ($curriculum->id == $curriculum_id) {
                    return $curriculum->curriculum_name;
                }
            }
        } else {
            return false;
        }
    }

    public static function create_js_map_string($collection, $name_key, $value_key) {
        $map_string = '{';
        foreach ($collection as $element) {
            $name = $element->$name_key;
            $value = $element->$value_key;
            $map_string = $map_string . "\"$name\":\"$value\",";
        }
        // remove last char
        //rtrim($map_string, ",")
        if(strlen($map_string) > 1) {
            $map_string = substr($map_string, 0, -1);
        }
        return $map_string = $map_string . '}';
    }

    public static function create_js_map_string2($collection, $name_key, $value_key1, $value_key2, $value_key3) {
        $map_string = '{';
        foreach ($collection as $element) {
            $name = $element->$name_key;
            $value1 = $element->$value_key1;
            $value2 = $element->$value_key2;
            $value3 = $element->$value_key3;
            $map_string = $map_string . "\"$name\":\"$value2-$value3\",";
        }
        // remove last char
        //rtrim($map_string, ",")
        if(strlen($map_string) > 1) {
            $map_string = substr($map_string, 0, -1);
        }
        return $map_string = $map_string . '}';
    }

    public static function get_var_name($var) {
        foreach ($GLOBALS as $key => $value) {
            if ($key === $var) {
                return $key;
            }
        }

        return false;
    }

    public static function create_js_week_map_string() {
        $lesson_week = array('0' => lang('lesson_week_normal'), '1' => lang('lesson_week_odd'), '2' => lang('lesson_week_even'));
        return json_encode($lesson_week);
    }

    public static function create_js_day_map_string() {
        $lesson_day = array(1 => lang('lesson_day_monday'), 2 => lang('lesson_day_tuesday'), 3 => lang('lesson_day_wednesday'), 4 => lang('lesson_day_thursday'), 5 => lang('lesson_day_friday'), 6 => lang('lesson_day_saturday'), 7 => lang('lesson_day_sunday'));
        return json_encode($lesson_day);
    }

    function getvarname(&$var) {
        $ret = '';
        $tmp = $var;
        $var = md5(uniqid(rand(), TRUE));

        $key = array_keys($GLOBALS);
        foreach ($key as $k)
            if ($GLOBALS[$k] === $var) {
                $ret = $k;
                break;
            }

        $var = $tmp;
        return $ret;
    }

    public static function startsWith($haystack, $needle) {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }

    public static function endsWith($haystack, $needle) {
        return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
    }

    // see basename
    public static function get_file_extension($filepath) {
        preg_match('/[^?]*/', $filepath, $matches);
        $string = $matches[0];

        $pattern = preg_split('/\./', $string, -1, PREG_SPLIT_OFFSET_CAPTURE);

        # check if there is any extension
        if (count($pattern) == 1) {
            return 'No File Extension Present';
        }

        if (count($pattern) > 1) {
            $filenamepart = $pattern[count($pattern) - 1][0];
            preg_match('/[^?]*/', $filenamepart, $matches);
            return $matches[0];
        }
    }

    // 中文有问题
    public static function get_file_name($filepath) {
        preg_match('/[^?]*/', $filepath, $matches);
        $string = $matches[0];
        #split the string by the literal dot in the filename
        $pattern = preg_split('/\./', $string, -1, PREG_SPLIT_OFFSET_CAPTURE);
        #get the last dot position
        $lastdot = $pattern[count($pattern) - 1][1];
        #now extract the filename using the basename function
        $filename = basename(substr($string, 0, $lastdot - 1));
        #return the filename part
        return $filename;
    }


}

/* End of file phpass_helper.php */
/* Location: ./application/helpers/account/phpass_helper.php */