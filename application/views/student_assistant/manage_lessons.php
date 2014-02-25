<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('lessons_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="col-md-2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_lessons')); ?>
    </div>

    <div class="col-md-10">

      <h2><?php echo lang('lessons_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('lessons_page_description'); ?>
      </div>

      <table id="lesson_table" class="table table-condensed table-hover">
        <thead>
          <tr>
            <th><?php echo lang('lessons_column_id'); ?></th>
            <th><?php echo lang('lessons_column_course'); ?></th>
            <th><?php echo lang('lessons_column_room'); ?></th>
            <th><?php echo lang('lessons_column_week'); ?></th>
            <th><?php echo lang('lessons_column_day'); ?></th>
            <th><?php echo lang('lessons_column_schedule_time'); ?></th>
            <th>
                <button id="lesson_create" type="button" class="btn btn-default btn-primary btn-small" ><?php echo lang('website_create'); ?></button>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $lessons as $lesson ) : ?>
            <tr>
              <td>
                  <span attr="lesson_id"><?php echo $lesson->id; ?></span>
              </td>
              <td>
                  <span attr="lesson_course"><?php echo utils::get_course_name($courses, $lesson->course_id); ?></span>
                  <span attr="lesson_course_id" style="display: none"><?php echo $lesson->course_id; ?></span>
              </td>
              <td>
                  <span attr="lesson_room"><?php echo utils::get_room_name($rooms, $lesson->room_id); ?></span>
                  <span attr="lesson_room_id" style="display: none"><?php echo $lesson->room_id; ?></span>
              </td>
              <td>
                  <span attr="lesson_week"><?php echo utils::get_week_name($lesson->week); ?></span>
                  <span attr="lesson_week_id" style="display: none"><?php echo $lesson->week; ?></span>
              </td>
              <td>
                  <span attr="lesson_day"><?php echo utils::get_day_name($lesson->day); ?></span>
                  <span attr="lesson_day_id" style="display: none"><?php echo $lesson->day; ?></span>
              </td>
              <td>
                  <span attr="lesson_schedule_time"><?php echo utils::get_schedule_time_name($schedule_times, $lesson->schedule_time_id); ?></span>
                  <span attr="lesson_schedule_time_id" style="display: none"><?php echo $lesson->schedule_time_id; ?></span>
              </td>
              <td>
                  <button type="button" class="btn btn-default btn-small" attr="lesson_update" ><?php echo lang('website_update'); ?></button>
                  <button type="button" class="btn btn-default btn-small" attr="lesson_delete" ><?php echo lang('website_delete'); ?></button>
              </td>
            </tr>
          <?php endforeach; ?>
          <tr id="lesson_table_row_template" style="display: none">
            <td>
                <span attr="lesson_id"></span>
            </td>
            <td>
                <span attr="lesson_course"></span>
                <span attr="lesson_course_id" style="display: none"></span>
            </td>
            <td>
                <span attr="lesson_room"></span>
                <span attr="lesson_room_id" style="display: none"></span>
            </td>
            <td>
                <span attr="lesson_week"></span>
                <span attr="lesson_day_id" style="display: none"></span>
            </td>
            <td>
                <span attr="lesson_day"></span>
                <span attr="lesson_day_id" style="display: none"></span>
            </td>
            <td>
                <span attr="lesson_schedule_time"></span>
                <span attr="lesson_schedule_time_id" style="display: none"></span>
            </td>
            <td>
                <button type="button" class="btn btn-default btn-small" attr="lesson_update" ><?php echo lang('website_update'); ?></button>
                <button type="button" class="btn btn-default btn-small" attr="lesson_delete" ><?php echo lang('website_delete'); ?></button>
            </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="lesson_management_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_lessons'); ?></h4>
                </div>
                <div class="modal-body" style="overflow-y: initial;">
                    <form class="form-horizontal" role="form">
                        <input type="hidden"  id="lesson_id">
                        <div class="form-group control-group">
                            <label for="lesson_course_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('lessons_column_course'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="lesson_course_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="lesson_room_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('lessons_column_room'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="lesson_room_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="lesson_week_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('lessons_column_week'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="lesson_week_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="lesson_day_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('lessons_column_day'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="lesson_day_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="lesson_schedule_time_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('lessons_column_schedule_time'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="lesson_schedule_time_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-default" data-dismiss="modal"><?php echo lang('website_text_close'); ?></button>
                    <button id="submit" type="button" class="btn btn-default btn-primary"><?php echo lang('website_text_submit'); ?></button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Modal -->
    <div class="modal fade" id="lesson_delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_lessons_delete'); ?></h4>
                </div>
                <div class="modal-body">
                    <span id="lesson_delete_modal_lesson_id" style="display: none" ></span>
                    <div><?php echo lang('website_manage_lessons_delete'); ?> <span id="lesson_delete_modal_lesson_course"></span></div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-default" data-dismiss="modal"><?php echo lang('website_text_close'); ?></button>
                        <button id="submit_delete" type="button" class="btn btn-default btn-primary"><?php echo lang('website_text_submit'); ?></button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Modal -->
        <div class="modal fade" id="error_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_error_title'); ?></h4>
                    </div>
                    <div class="modal-body">
                        <div><?php echo lang('website_error_content'); ?></div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-default" data-dismiss="modal"><?php echo lang('website_text_close'); ?></button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


</div>

<script>

    function select_enable($select, is_enable) {
        $select.prop('disabled', is_enable);
        $select.selectpicker('refresh');
    }

    function update_manage_modal($lesson_id, $lesson_course_id, $lesson_room_id, $lesson_week, $lesson_day, $lesson_schedule_time_id) {
        $('#lesson_id').val($lesson_id);
        $('#lesson_course_select').val($lesson_course_id);
        $('#lesson_room_select').val($lesson_room_id);
        $('#lesson_week_select').val($lesson_week);
        $('#lesson_day_select').val($lesson_day);
        $('#lesson_schedule_time_select').val($lesson_schedule_time_id);
    }

    $(document).ready(function() {
        var $model_name = 'lesson';
        var $lesson_id_key = 'id';
        var $lesson_school_id_key = 'school_id';
        var $lesson_institute_id_key = 'institute_id';
        var $lesson_course_id_key = 'course_id';
        var $lesson_room_id_key = 'room_id';
        var $lesson_week_key = 'week';
        var $lesson_day_key = 'day';
        var $lesson_schedule_time_id_key = 'schedule_time_id';
        var $lesson_curriculum_id = 'curriculum_id';
        var $lesson_base_url = 'api/lesson_mgmt/lesson';
        var $is_update = false;
        var $school_id = <?php echo isset($school) ? $school->id : 0 ?>;
        var $institute_id = <?php echo isset($institute) ? $institute->id : 0 ?>;
        var $curriculum_id = <?php echo isset($curriculum) ? $curriculum->id : 0 ?>;
        var $courses_js_map = <?php echo $courses_map ?>;
        var $rooms_js_map = <?php echo $rooms_map ?>;
        var $weeks_js_map = <?php echo $lesson_week_map ?>;
        var $days_js_map = <?php echo $lesson_day_map ?>;
        var $schedule_times_js_map = <?php echo $schedule_times_map ?>;

        var $current_row = $('table#lesson_table tbody tr:first-child');

        // add courses to course select
        $.map( $courses_js_map, function( map_value, map_key ) {
            $('#lesson_course_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });

        // add rooms to room select
        $.map( $rooms_js_map, function( map_value, map_key ) {
            $('#lesson_room_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });

        // add weeks to week select
        $.map( $weeks_js_map, function( map_value, map_key ) {
            $('#lesson_week_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });

        // add days to day select
        $.map( $days_js_map, function( map_value, map_key ) {
            $('#lesson_day_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });

        // add schedule_times type to schedule_time type select
        $.map( $schedule_times_js_map, function( map_value, map_key ) {
            $('#lesson_schedule_time_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });
        // set default value

        // Enable Bootstrap-Select via JavaScript:
        $('#lesson_course_select').selectpicker();
        $('#lesson_room_select').selectpicker();
        $('#lesson_week_select').selectpicker();
        $('#lesson_day_select').selectpicker();
        $('#lesson_schedule_time_select').selectpicker();

        //select_enable($('#lesson_institute_select'), $institute_id != 0);

        $(document).delegate('#lesson_create', 'click', function () {
            $is_update = false;
            update_manage_modal('','','','','','','');
            $('#lesson_management_modal').modal('show');
        });

        $(document).delegate('button[attr="lesson_update"]', 'click', function () {
            $is_update = true;
            $current_row = $(this).parent().parent();
            var $lesson_id = $current_row.find('span[attr="lesson_id"]').text();
            var $lesson_course_id = $current_row.find('span[attr="lesson_course_id"]').text();
            var $lesson_room_id = $current_row.find('span[attr="lesson_room_id"]').text();
            var $lesson_week = $current_row.find('span[attr="lesson_week_id"]').text();
            var $lesson_day = $current_row.find('span[attr="lesson_day_id"]').text();
            var $lesson_schedule_time_id = $current_row.find('span[attr="lesson_schedule_time_id"]').text();
            update_manage_modal($lesson_id, $lesson_course_id, $lesson_room_id, $lesson_week, $lesson_day, $lesson_schedule_time_id);
            // refresh select widget
            $('#lesson_course_select').selectpicker('refresh');
            $('#lesson_room_select').selectpicker('refresh');
            $('#lesson_week_select').selectpicker('refresh');
            $('#lesson_day_select').selectpicker('refresh');
            $('#lesson_schedule_time_select').selectpicker('refresh');
            $('#lesson_management_modal').modal('show');
        });

        $(document).delegate('button[attr="lesson_delete"]', 'click', function () {
            $is_update = false;
            $current_row = $(this).parent().parent();
            var $lesson_id = $current_row.find('span[attr="lesson_id"]').text();
            var $lesson_course = $current_row.find('span[attr="lesson_course"]').text();
            update_manage_modal('','','','','','');
            $('#lesson_delete_modal_lesson_id').text($lesson_id);
            $('#lesson_delete_modal_lesson_course').text($lesson_course);
            $('#lesson_delete_modal').modal('show');
        });

        $('#submit').click(function () {
            var $lesson_id = $('#lesson_id').val();
            var $lesson_course_id = $('#lesson_course_select :selected').val();
            var $lesson_room_id = $('#lesson_room_select :selected').val();
            var $lesson_week_id = $('#lesson_week_select :selected').val();
            var $lesson_day_id = $('#lesson_day_select :selected').val();
            var $lesson_schedule_time_id =  $('#lesson_schedule_time_select :selected').val();

            var $paras_map = {};
            if($is_update) {
                $paras_map[$lesson_id_key] = $lesson_id;
            }
            $paras_map[$lesson_school_id_key] = $school_id;
            $paras_map[$lesson_institute_id_key] = $institute_id;
            $paras_map[$lesson_course_id_key] = $lesson_course_id;
            $paras_map[$lesson_room_id_key] = $lesson_room_id;
            $paras_map[$lesson_week_key] = $lesson_week_id;
            $paras_map[$lesson_day_key] = $lesson_day_id;
            $paras_map[$lesson_schedule_time_id_key] = $lesson_schedule_time_id;
            if($curriculum_id != 0) {
                $paras_map[$lesson_curriculum_id] = $curriculum_id;
            }

            $.ajax({
                type: $is_update ? "POST" : "PUT",
                url: make_request_url($lesson_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    if(data.result == "success") {
                        if($is_update) {
                            $current_row.find('span[attr="lesson_id"]').text(data[$model_name][$lesson_id_key]);
                            $current_row.find('span[attr="lesson_course"]').text($courses_js_map[data[$model_name][$lesson_course_id_key]]);
                            $current_row.find('span[attr="lesson_course_id"]').text(data[$model_name][$lesson_course_id_key]);
                            $current_row.find('span[attr="lesson_room"]').text($rooms_js_map[data[$model_name][$lesson_room_id_key]]);
                            $current_row.find('span[attr="lesson_room_id"]').text(data[$model_name][$lesson_room_id_key]);
                            $current_row.find('span[attr="lesson_week"]').text($weeks_js_map[data[$model_name][$lesson_week_key]]);
                            $current_row.find('span[attr="lesson_week_id"]').text(data[$model_name][$lesson_week_key]);
                            $current_row.find('span[attr="lesson_day"]').text($days_js_map[data[$model_name][$lesson_day_key]]);
                            $current_row.find('span[attr="lesson_day_id"]').text(data[$model_name][$lesson_day_key]);
                            $current_row.find('span[attr="lesson_schedule_time"]').text($schedule_times_js_map[data[$model_name][$lesson_schedule_time_id_key]]);
                            $current_row.find('span[attr="lesson_schedule_time_id"]').text(data[$model_name][$lesson_schedule_time_id_key]);
                        }
                        else {
                            //var $new_row = $('<tr>', { html : $("#lesson_table_row_template").html().clone() });
                            var $new_row = $("#lesson_table_row_template").clone().removeAttr('id').removeAttr('style');
                            $new_row.find('span[attr="lesson_id"]').text(data[$model_name][$lesson_id_key]);
                            $new_row.find('span[attr="lesson_course"]').text($courses_js_map[data[$model_name][$lesson_course_id_key]]);
                            $new_row.find('span[attr="lesson_course_id"]').text(data[$model_name][$lesson_course_id_key]);
                            $new_row.find('span[attr="lesson_room"]').text($rooms_js_map[data[$model_name][$lesson_room_id_key]]);
                            $new_row.find('span[attr="lesson_room_id"]').text(data[$model_name][$lesson_room_id_key]);
                            $new_row.find('span[attr="lesson_week"]').text($weeks_js_map[data[$model_name][$lesson_week_key]]);
                            $new_row.find('span[attr="lesson_week_id"]').text(data[$model_name][$lesson_week_key]);
                            $new_row.find('span[attr="lesson_day"]').text($days_js_map[data[$model_name][$lesson_day_key]]);
                            $new_row.find('span[attr="lesson_day_id"]').text(data[$model_name][$lesson_day_key]);
                            $new_row.find('span[attr="lesson_schedule_time"]').text($schedule_times_js_map[data[$model_name][$lesson_schedule_time_id_key]]);
                            $new_row.find('span[attr="lesson_schedule_time_id"]').text(data[$model_name][$lesson_schedule_time_id_key]);
                            $('table#lesson_table tbody').append($new_row);
                        }
                        $('#lesson_management_modal').modal('hide');
                    }
                    else {
                        console.info(textStatus);
                        $('#lesson_management_modal').modal('hide');
                        $('#error_modal').modal('show');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#lesson_management_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });

        $('#submit_delete').click(function () {
            var $lesson_id = $('#lesson_delete_modal_lesson_id').text();
            var $paras_map = {};
            $paras_map[$lesson_id_key] = $lesson_id;
            if($curriculum_id != 0) {
                $paras_map[$lesson_curriculum_id] = $curriculum_id;
            }

            $.ajax({
                type: "DELETE",
                url: make_request_url($lesson_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    $current_row.remove();
                    $('#lesson_delete_modal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#lesson_delete_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });
    });
</script>

<?php echo $this->load->view('footer'); ?>

</body>
</html>