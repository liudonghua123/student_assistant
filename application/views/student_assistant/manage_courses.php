<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('courses_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="col-md-2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_courses')); ?>
    </div>

    <div class="col-md-10">

      <h2><?php echo lang('courses_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('courses_page_description'); ?>
      </div>

      <table id="course_table" class="table table-condensed table-hover">
        <thead>
          <tr>
            <th><?php echo lang('courses_column_id'); ?></th>
            <th><?php echo lang('courses_column_name'); ?></th>
            <th><?php echo lang('courses_column_type'); ?></th>
            <th><?php echo lang('courses_column_major'); ?></th>
            <th><?php echo lang('courses_column_teacher'); ?></th>
            <th><?php echo lang('courses_column_description'); ?></th>
            <th>
                <button id="course_create" type="button" class="btn btn-default btn-primary btn-small" ><?php echo lang('website_create'); ?></button>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $courses as $course ) : ?>
            <tr>
              <td>
                  <span attr="course_id"><?php echo $course->id; ?></span>
              </td>
              <td>
                  <span attr="course_name"><?php echo $course->course_name; ?></span>
              </td>
              <td>
                  <span attr="course_type"><?php echo utils::get_course_type_name($course_types, $course->course_type_id); ?></span>
                  <span attr="course_type_id" style="display: none"><?php echo $course->course_type_id; ?></span>
              </td>
              <td>
                  <span attr="course_major"><?php echo utils::get_major_name(NULL, $majors, $course->major_id); ?></span>
                  <span attr="course_major_id" style="display: none"><?php echo $course->major_id; ?></span>
              </td>
                <td>
                    <span attr="course_teacher"><?php echo utils::get_teacher_name($teachers, $course->teacher_id); ?></span>
                    <span attr="course_teacher_id" style="display: none"><?php echo $course->teacher_id; ?></span>
                </td>
              <td>
                  <span attr="course_description"><?php echo $course->course_description; ?></span>
              </td>
                <td>
                    <button type="button" class="btn btn-default btn-small"attr="course_update" ><?php echo lang('website_update'); ?></button>
                    <button type="button" class="btn btn-default btn-small" attr="course_delete" ><?php echo lang('website_delete'); ?></button>
                </td>
            </tr>
          <?php endforeach; ?>
          <tr id="course_table_row_template" style="display: none">
              <td>
                  <span attr="course_id"></span>
              </td>
              <td>
                  <span attr="course_name"></span>
              </td>
              <td>
                  <span attr="course_type"></span>
                  <span attr="course_type_id" style="display: none"></span>
              </td>
              <td>
                  <span attr="course_major"></span>
                  <span attr="course_major_id" style="display: none"></span>
              </td>
              <td>
                  <span attr="course_teacher"></span>
                  <span attr="course_teacher_id" style="display: none"></span>
              </td>
              <td>
                  <span attr="course_description"></span>
              </td>
              <td>
                  <button type="button" class="btn btn-default btn-small" attr="course_update" ><?php echo lang('website_update'); ?></button>
                  <button type="button" class="btn btn-default btn-small" attr="course_delete" ><?php echo lang('website_delete'); ?></button>
              </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="course_management_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_courses'); ?></h4>
                </div>
                <div class="modal-body" style="overflow-y: initial;">
                    <form class="form-horizontal" role="form">
                        <input type="hidden"  id="course_id">
                        <div class="form-group control-group">
                            <label for="course_name" class="col-sm-4 col-xs-4 control-label"><?php echo lang('courses_column_name'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="course_name" placeholder="Enter course Name">
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="course_institute_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('courses_column_institute'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="course_institute_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="course_major_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('courses_column_major'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="course_major_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="course_teacher_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('courses_column_teacher'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="course_teacher_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="course_type_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('courses_column_type'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="course_type_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="course_description" class="col-sm-4 col-xs-4 control-label"><?php echo lang('courses_column_description'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="course_description" placeholder="Enter course Description">
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
    <div class="modal fade" id="course_delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_courses_delete'); ?></h4>
                </div>
                <div class="modal-body">
                    <span id="course_delete_modal_course_id" style="display: none" ></span>
                    <div><?php echo lang('website_manage_courses_delete'); ?> <span id="course_delete_modal_course_name"></span></div>
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

    function update_manage_modal($course_id, $course_name, $course_institute_id, $course_major_id, $course_teacher_id, course_type_id, $course_description) {
        $('#course_id').val($course_id);
        $('#course_name').val($course_name);
        $('#course_institute_select').val($course_institute_id);
        $('#course_major_select').val($course_major_id);
        $('#course_teacher_select').val($course_teacher_id);
        $('#course_type_select').val(course_type_id);
        $('#course_description').val($course_description);
    }

    $(document).ready(function() {
        var $model_name = 'course';
        var $course_id_key = 'id';
        var $course_school_id_key = 'school_id';
        var $course_institute_id_key = 'institute_id';
        var $course_major_id_key = 'major_id';
        var $course_teacher_id_key = 'teacher_id';
        var $course_name_key = 'course_name';
        var $course_type_id_key = 'course_type_id';
        var $course_description_key = 'course_description';
        var $course_base_url = 'api/course_mgmt/course';
        var $is_update = false;
        var $school_id = <?php echo isset($school) ? $school->id : 0 ?>;
        var $institute_id = <?php echo isset($institute) ? $institute->id : 0 ?>;
        var $institutes_js_map = <?php echo $institutes_map ?>;
        var $majors_js_map = <?php echo $majors_map ?>;
        var $teachers_js_map = <?php echo $teachers_map ?>;
        var $course_types_js_map = <?php echo $course_types_map ?>;
        // set the fist as default
        var $default_course_type_id = '';
        var $default_major_id = '';

        var $current_row = $('table#course_table tbody tr:first-child');

        // add institutes to institute select
        $.map( $institutes_js_map, function( map_value, map_key ) {
            $('#course_institute_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });
        // add major to major select
        $.map( $majors_js_map, function( map_value, map_key ) {
            $('#course_major_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });
        // add teacher to teacher select
        $.map( $teachers_js_map, function( map_value, map_key ) {
            $('#course_teacher_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });
        // add courses type to course type select
        $.map( $course_types_js_map, function( map_value, map_key ) {
            $('#course_type_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });
        // set default value
        $('#course_institute_select').val($institute_id);
        $('#course_type_select').val($default_course_type_id);

        // Enable Bootstrap-Select via JavaScript:
        $('#course_institute_select').selectpicker();
        $('#course_major_select').selectpicker();
        $('#course_teacher_select').selectpicker();
        $('#course_type_select').selectpicker();

        select_enable($('#course_institute_select'), $institute_id != 0);

        $(document).delegate('#course_create', 'click', function () {
            $is_update = false;
            update_manage_modal('','','', $default_major_id, '', $default_course_type_id,'');
            $('#course_management_modal').modal('show');
        });

        $(document).delegate('button[attr="course_update"]', 'click', function () {
            $is_update = true;
            $current_row = $(this).parent().parent();
            var $course_id = $current_row.find('span[attr="course_id"]').text();
            var $course_name = $current_row.find('span[attr="course_name"]').text();
            // no display institute anymore
            //var $course_institute_id = $current_row.find('span[attr="course_institute_id"]').text();
            var $course_institute_id = $institute_id;
            var $course_major_id = $current_row.find('span[attr="course_major_id"]').text();
            var $course_teacher_id = $current_row.find('span[attr="course_teacher_id"]').text();
            var $course_type_id = $current_row.find('span[attr="course_type_id"]').text();
            var $course_description = $current_row.find('span[attr="course_description"]').text();
            update_manage_modal($course_id,$course_name, $course_institute_id, $course_major_id, $course_teacher_id, $course_type_id, $course_description);
            // refresh select widget
            $('#course_institute_select').selectpicker('refresh');
            $('#course_major_select').selectpicker('refresh');
            $('#course_teacher_select').selectpicker('refresh');
            $('#course_type_select').selectpicker('refresh');
            $('#course_management_modal').modal('show');
        });

        $(document).delegate('button[attr="course_delete"]', 'click', function () {
            $is_update = false;
            $current_row = $(this).parent().parent();
            var $course_id = $current_row.find('span[attr="course_id"]').text();
            var $course_name = $current_row.find('span[attr="course_name"]').text();
            var $course_description = $current_row.find('span[attr="course_description"]').text();
            update_manage_modal('','','', $default_major_id, $default_course_type_id,'');
            $('#course_delete_modal_course_id').text($course_id);
            $('#course_delete_modal_course_name').text($course_name);
            $('#course_delete_modal').modal('show');
        });

        $('#submit').click(function () {
            var $course_id = $('#course_id').val();
            var $course_name = $('#course_name').val();
            var $institute_id = $('#course_institute_select :selected').val();
            var $major_id = $('#course_major_select :selected').val();
            var $teacher_id = $('#course_teacher_select :selected').val();
            var $course_type_id = $('#course_type_select :selected').val();
            var $course_description = $('#course_description').val();
            // Javascript "map" (object) doesn't evaluate its keys
            //  var $paras_map = {$course_name_key : $course_name, $course_description_key : $course_description}
            var $paras_map = {};
            if($is_update) {
                $paras_map[$course_id_key] = $course_id;
            }
            $paras_map[$course_name_key] = $course_name;
            $paras_map[$course_school_id_key] = $school_id;
            $paras_map[$course_institute_id_key] = $institute_id;
            $paras_map[$course_major_id_key] = $major_id;
            $paras_map[$course_teacher_id_key] = $teacher_id;
            $paras_map[$course_type_id_key] = $course_type_id;
            $paras_map[$course_description_key] = $course_description;

            $.ajax({
                type: $is_update ? "POST" : "PUT",
                url: make_request_url($course_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    if(data.result == "success") {
                        if($is_update) {
                            $current_row.find('span[attr="course_id"]').text(data[$model_name][$course_id_key]);
                            $current_row.find('span[attr="course_name"]').text(data[$model_name][$course_name_key]);
                            $current_row.find('span[attr="course_type"]').text($course_types_js_map[data[$model_name][$course_type_id_key]]);
                            $current_row.find('span[attr="course_type_id"]').text(data[$model_name][$course_type_id_key]);
                            $current_row.find('span[attr="course_major"]').text($majors_js_map[data[$model_name][$course_major_id_key]]);
                            $current_row.find('span[attr="course_major_id"]').text(data[$model_name][$course_major_id_key]);
                            $current_row.find('span[attr="course_teacher"]').text($teachers_js_map[data[$model_name][$course_teacher_id_key]]);
                            $current_row.find('span[attr="course_teacher_id"]').text(data[$model_name][$course_teacher_id_key]);
                            $current_row.find('span[attr="course_description"]').text(data[$model_name][$course_description_key]);
                        }
                        else {
                            //var $new_row = $('<tr>', { html : $("#course_table_row_template").html().clone() });
                            var $new_row = $("#course_table_row_template").clone().removeAttr('id').removeAttr('style');
                            $new_row.find('span[attr="course_id"]').text(data[$model_name][$course_id_key]);
                            $new_row.find('span[attr="course_name"]').text(data[$model_name][$course_name_key]);
                            $new_row.find('span[attr="course_type"]').text($course_types_js_map[data[$model_name][$course_type_id_key]]);
                            $new_row.find('span[attr="course_type_id"]').text(data[$model_name][$course_type_id_key]);
                            $new_row.find('span[attr="course_major"]').text($majors_js_map[data[$model_name][$course_major_id_key]]);
                            $new_row.find('span[attr="course_major_id"]').text(data[$model_name][$course_major_id_key]);
                            $new_row.find('span[attr="course_teacher"]').text($teachers_js_map[data[$model_name][$course_teacher_id_key]]);
                            $new_row.find('span[attr="course_teacher_id"]').text(data[$model_name][$course_teacher_id_key]);
                            $new_row.find('span[attr="course_description"]').text(data[$model_name][$course_description_key]);
                            $('table#course_table tbody').append($new_row);
                        }
                        $('#course_management_modal').modal('hide');
                    }
                    else {
                        console.info(textStatus);
                        $('#course_management_modal').modal('hide');
                        $('#error_modal').modal('show');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#course_management_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });

        $('#submit_delete').click(function () {
            var $course_id = $('#course_delete_modal_course_id').text();
            var $paras_map = {};
            $paras_map[$course_id_key] = $course_id;

            $.ajax({
                type: "DELETE",
                url: make_request_url($course_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    $current_row.remove();
                    $('#course_delete_modal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#course_delete_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });
    });
</script>

<?php echo $this->load->view('footer'); ?>

</body>
</html>