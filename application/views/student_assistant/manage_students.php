<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('students_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="col-md-2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_students')); ?>
    </div>

    <div class="col-md-10">

      <h2><?php echo lang('students_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('students_page_description'); ?>
      </div>

      <table id="student_table" class="table table-condensed table-hover">
        <thead>
          <tr>
            <th><?php echo lang('students_column_id'); ?></th>
            <th><?php echo lang('students_column_name'); ?></th>
            <th><?php echo lang('students_column_gender'); ?></th>
            <th><?php echo lang('students_column_institute'); ?></th>
            <th><?php echo lang('students_column_major'); ?></th>
            <th><?php echo lang('students_column_curriculum'); ?></th>
            <th><?php echo lang('students_column_login_name'); ?></th>
            <th><?php echo lang('students_column_id_number'); ?></th>
            <th>
                <button id="student_create" type="button" class="btn btn-default btn-primary btn-small" ><?php echo lang('website_create'); ?></button>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $students as $student ) : ?>
            <tr>
              <td>
                  <span attr="student_id"><?php echo $student->id; ?></span>
              </td>
              <td>
                  <span attr="student_name"><?php echo $student->name; ?></span>
              </td>
              <td>
                  <span attr="student_gender_name"><?php echo utils::get_gender_name($student->gender); ?></span>
                  <span attr="student_gender" style="display: none"><?php echo $student->gender; ?></span>
              </td>
              <td>
                  <span attr="student_institute"><?php echo utils::get_institute_name($institute, $institutes, $student->institute_id); ?></span>
                  <span attr="student_institute_id" style="display: none"><?php echo $student->institute_id; ?></span>
              </td>
              <td>
                  <span attr="student_major"><?php echo utils::get_major_name(NULL, $majors, $student->major_id); ?></span>
                  <span attr="student_major_id" style="display: none"><?php echo $student->major_id; ?></span>
              </td>
              <td>
                  <span attr="student_curriculum"><?php echo utils::get_curriculum_name(NULL, $curriculums, $student->curriculum_id); ?></span>
                  <span attr="student_curriculum_id" style="display: none"><?php echo $student->curriculum_id; ?></span>
              </td>
              <td>
                  <span attr="student_login_name"><?php echo $student->login_name; ?></span>
              </td>
              <td>
                  <span attr="student_id_number"><?php echo $student->id_number; ?></span>
              </td>
                <td>
                    <button type="button" class="btn btn-default btn-small"attr="student_update" ><?php echo lang('website_update'); ?></button>
                    <button type="button" class="btn btn-default btn-small" attr="student_delete" ><?php echo lang('website_delete'); ?></button>
                </td>
            </tr>
          <?php endforeach; ?>
          <tr id="student_table_row_template" style="display: none">
              <td>
                  <span attr="student_id"></span>
              </td>
              <td>
                  <span attr="student_name"></span>
              </td>
              <td>
                  <span attr="student_gender_name"></span>
                  <span attr="student_gender" style="display: none"></span>
              </td>
              <td>
                  <span attr="student_institute"></span>
                  <span attr="student_institute_id" style="display: none"></span>
              </td>
              <td>
                  <span attr="student_major"></span>
                  <span attr="student_major_id" style="display: none"></span>
              </td>
              <td>
                  <span attr="student_curriculum"></span>
                  <span attr="student_curriculum_id" style="display: none"></span>
              </td>
              <td>
                  <span attr="student_login_name"></span>
              </td>
              <td>
                  <span attr="student_id_number"></span>
              </td>
              <td>
                  <button type="button" class="btn btn-default btn-small" attr="student_update" ><?php echo lang('website_update'); ?></button>
                  <button type="button" class="btn btn-default btn-small" attr="student_delete" ><?php echo lang('website_delete'); ?></button>
              </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="student_management_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_students'); ?></h4>
                </div>
                <div class="modal-body" style="overflow-y: initial;">
                    <form class="form-horizontal" role="form">
                        <input type="hidden"  id="student_id">
                        <div class="form-group control-group">
                            <label for="student_name" class="col-sm-4 col-xs-4 control-label"><?php echo lang('students_column_name'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="student_name" placeholder="Enter student Name">
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="student_gender" class="col-sm-4 col-xs-4 control-label"><?php echo lang('students_column_gender'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <label class="radio inline">
                                    <input type="radio" name="student_gender" value="m"> Male
                                </label>
                                <label class="radio inline">
                                    <input type="radio" name="student_gender" value="f"> female
                                </label>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="student_institute_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('students_column_institute'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="student_institute_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="student_major_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('students_column_major'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="student_major_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="student_curriculum_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('students_column_curriculum'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="student_curriculum_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="student_login_name" class="col-sm-4 col-xs-4 control-label"><?php echo lang('students_column_login_name'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="student_login_name" placeholder="Enter student Description">
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="student_password" class="col-sm-4 col-xs-4 control-label"><?php echo lang('students_column_password'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="password" class="form-control input-large required" id="student_password" placeholder="Enter student Description">
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="student_id_number" class="col-sm-4 col-xs-4 control-label"><?php echo lang('students_column_id_number'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="student_id_number" placeholder="Enter student Description">
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
    <div class="modal fade" id="student_delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_students_delete'); ?></h4>
                </div>
                <div class="modal-body">
                    <span id="student_delete_modal_student_id" style="display: none" ></span>
                    <div><?php echo lang('website_manage_students_delete'); ?> <span id="student_delete_modal_student_name"></span></div>
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

    function radio_gender_select(gender) {
        // http://stackoverflow.com/questions/871063/how-to-set-radio-option-checked-onload-with-jquery
        // attr sometimes may not work, prop seem works, the best is to use click
        if(gender == 'm') {
            //$('input[name=student_gender][value=m]').prop('checked',true);
            //$('input[name=student_gender][value=f]').prop('checked',false);
            $('input[name=student_gender][value=m]').click();
        }
        else {
            //$('input[name=student_gender][value=m]').prop('checked',false);
            //$('input[name=student_gender][value=f]').prop('checked',true);
            $('input[name=student_gender][value=f]').click();
        }
    }

    function update_manage_modal($student_id, $student_name, $student_gender, $student_institute_id, $student_major_id, $student_curriculum_id, $student_login_name, $student_password, $student_id_number) {
        $('#student_id').val($student_id);
        $('#student_name').val($student_name);
        radio_gender_select($student_gender);
        $('#student_institute_select').val($student_institute_id);
        $('#student_major_select').val($student_major_id);
        $('#student_curriculum_select').val($student_curriculum_id);
        $('#student_login_name').val($student_login_name);
        $('#student_passowrd').val($student_password);
        $('#student_id_number').val($student_id_number);
    }

    function get_gender_name($gender_key) {
        if($gender_key == 'm') {
            return '<?php echo lang('gender_name_male'); ?>';
        }
        else {
            return '<?php echo lang('gender_name_female'); ?>';
        }
    }

    $(document).ready(function() {
        var $model_name = 'student';
        var $student_id_key = 'id';
        var $student_school_id_key = 'school_id';
        var $student_institute_id_key = 'institute_id';
        var $student_major_id_key = 'major_id';
        var $student_curriculum_id_key = 'curriculum_id';
        var $student_name_key = 'name';
        var $student_gender_key = 'gender';
        var $student_login_name_key = 'login_name';
        var $student_password_key = 'password';
        var $student_id_number_key = 'id_number';
        var $student_base_url = 'api/student_mgmt/student';
        var $is_update = false;
        var $school_id = <?php echo isset($school) ? $school->id : 0 ?>;
        var $institute_id = <?php echo isset($institute) ? $institute->id : 0 ?>;
        var $institutes_js_map = <?php echo $institutes_map ?>;
        var $majors_js_map = <?php echo $majors_map ?>;
        var $curriculums_js_map = <?php echo $curriculums_map ?>;
        var $default_gender = 'm';

        var $current_row = $('table#student_table tbody tr:first-child');

        // add institutes to institute select
        $.map($institutes_js_map, function( map_value, map_key ) {
            $('#student_institute_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });

        // add majors to major select
        $.map($majors_js_map, function( map_value, map_key ) {
            $('#student_major_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });

        // add curriculums to curriculum select
        $.map($curriculums_js_map, function( map_value, map_key ) {
            $('#student_curriculum_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });

        // set default value
        $('#student_institute_select').val($institute_id);

        // Enable Bootstrap-Select via JavaScript:
        $('#student_institute_select').selectpicker();
        $('#student_major_select').selectpicker();
        $('#student_curriculum_select').selectpicker();

        select_enable($('#student_institute_select'), $institute_id != 0);

        $(document).delegate('#student_create', 'click', function () {
            $is_update = false;
            update_manage_modal('', '', $default_gender, $institute_id, '', '', '', '', '');
            $('#student_management_modal').modal('show');
        });

        $(document).delegate('button[attr="student_update"]', 'click', function () {
            $is_update = true;
            $current_row = $(this).parent().parent();
            var $student_id = $current_row.find('span[attr="student_id"]').text();
            var $student_name = $current_row.find('span[attr="student_name"]').text();
            var $student_gender = $current_row.find('span[attr="student_gender"]').text();
            var $student_institute_id = $current_row.find('span[attr="student_institute_id"]').text();
            var $student_major_id = $current_row.find('span[attr="student_major_id"]').text();
            var $student_curriculum_id = $current_row.find('span[attr="student_curriculum_id"]').text();
            var $student_login_name = $current_row.find('span[attr="student_login_name"]').text();
            var $student_password = '';
            var $student_id_number = $current_row.find('span[attr="student_id_number"]').text();
            update_manage_modal($student_id, $student_name, $student_gender, $student_institute_id, $student_major_id, $student_curriculum_id, $student_login_name, $student_password, $student_id_number);
            // refresh select widget
            $('#student_institute_select').selectpicker('refresh');
            $('#student_major_select').selectpicker('refresh');
            $('#student_curriculum_select').selectpicker('refresh');
            $('#student_management_modal').modal('show');
        });

        $(document).delegate('button[attr="student_delete"]', 'click', function () {
            $is_update = false;
            $current_row = $(this).parent().parent();
            var $student_id = $current_row.find('span[attr="student_id"]').text();
            var $student_name = $current_row.find('span[attr="student_name"]').text();
            update_manage_modal('', '', $default_gender, $institute_id, '', '', '', '', '');
            $('#student_delete_modal_student_id').text($student_id);
            $('#student_delete_modal_student_name').text($student_name);
            $('#student_delete_modal').modal('show');
        });

        $('#submit').click(function () {
            var $student_id = $('#student_id').val();
            var $student_name = $('#student_name').val();
            var $student_gender = $('input[name=student_gender]:checked').val();
            var $student_school_id = $school_id;
            var $student_institute_id = $('#student_institute_select :selected').val();
            var $student_major_id = $('#student_major_select :selected').val();
            var $student_curriculum_id = $('#student_curriculum_select :selected').val();
            var $student_login_name = $('#student_login_name').val();
            var $student_password = $('#student_password').val();
            var $student_id_number = $('#student_id_number').val();
            // Javascript "map" (object) doesn't evaluate its keys
            //  var $paras_map = {$student_name_key : $student_name, $student_research_area_key : $student_research_area}
            var $paras_map = {};
            if($is_update) {
                $paras_map[$student_id_key] = $student_id;
            }
            $paras_map[$student_name_key] = $student_name;
            $paras_map[$student_gender_key] = $student_gender;
            $paras_map[$student_school_id_key] = $student_school_id;
            $paras_map[$student_institute_id_key] = $student_institute_id;
            $paras_map[$student_major_id_key] = $student_major_id;
            $paras_map[$student_curriculum_id_key] = $student_curriculum_id;
            $paras_map[$student_login_name_key] = $student_login_name;
            $paras_map[$student_password_key] = $student_password;
            $paras_map[$student_id_number_key] = $student_id_number;

            $.ajax({
                type: $is_update ? "POST" : "PUT",
                url: make_request_url($student_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    if(data.result == "success") {
                        if($is_update) {
                            $current_row.find('span[attr="student_id"]').text(data[$model_name][$student_id_key]);
                            $current_row.find('span[attr="student_name"]').text(data[$model_name][$student_name_key]);
                            $current_row.find('span[attr="student_gender"]').text(data[$model_name][$student_gender_key]);
                            $current_row.find('span[attr="student_gender_name"]').text(get_gender_name(data[$model_name][$student_gender_key]));
                            $current_row.find('span[attr="student_institute"]').text($institutes_js_map[data[$model_name][$student_institute_id_key]]);
                            $current_row.find('span[attr="student_institute_id"]').text(data[$model_name][$student_institute_id_key]);
                            $current_row.find('span[attr="student_major"]').text($majors_js_map[data[$model_name][$student_major_id_key]]);
                            $current_row.find('span[attr="student_major_id"]').text(data[$model_name][$student_major_id_key]);
                            $current_row.find('span[attr="student_curriculum"]').text($curriculums_js_map[data[$model_name][$student_curriculum_id_key]]);
                            $current_row.find('span[attr="student_curriculum_id"]').text(data[$model_name][$student_curriculum_id_key]);
                            $current_row.find('span[attr="student_login_name"]').text(data[$model_name][$student_login_name_key]);
                            $current_row.find('span[attr="student_id_number"]').text(data[$model_name][$student_id_number_key]);
                        }
                        else {
                            //var $new_row = $('<tr>', { html : $("#student_table_row_template").html().clone() });
                            var $new_row = $("#student_table_row_template").clone().removeAttr('id').removeAttr('style');
                            $new_row.find('span[attr="student_id"]').text(data[$model_name][$student_id_key]);
                            $new_row.find('span[attr="student_name"]').text(data[$model_name][$student_name_key]);
                            $new_row.find('span[attr="student_gender"]').text(data[$model_name][$student_gender_key]);
                            $new_row.find('span[attr="student_gender_name"]').text(get_gender_name(data[$model_name][$student_gender_key]));
                            $new_row.find('span[attr="student_institute"]').text($institutes_js_map[data[$model_name][$student_institute_id_key]]);
                            $new_row.find('span[attr="student_institute_id"]').text(data[$model_name][$student_institute_id_key]);
                            $new_row.find('span[attr="student_major"]').text($majors_js_map[data[$model_name][$student_major_id_key]]);
                            $new_row.find('span[attr="student_major_id"]').text(data[$model_name][$student_major_id_key]);
                            $new_row.find('span[attr="student_curriculum"]').text($curriculums_js_map[data[$model_name][$student_curriculum_id_key]]);
                            $new_row.find('span[attr="student_curriculum_id"]').text(data[$model_name][$student_curriculum_id_key]);
                            $new_row.find('span[attr="student_login_name"]').text(data[$model_name][$student_login_name_key]);
                            $new_row.find('span[attr="student_id_number"]').text(data[$model_name][$student_id_number_key]);
                            $('table#student_table tbody').append($new_row);
                        }
                        $('#student_management_modal').modal('hide');
                    }
                    else {
                        console.info(textStatus);
                        $('#student_management_modal').modal('hide');
                        $('#error_modal').modal('show');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#student_management_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });

        $('#submit_delete').click(function () {
            var $student_id = $('#student_delete_modal_student_id').text();
            var $paras_map = {};
            $paras_map[$student_id_key] = $student_id;

            $.ajax({
                type: "DELETE",
                url: make_request_url($student_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    $current_row.remove();
                    $('#student_delete_modal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#student_delete_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });
    });
</script>

<?php echo $this->load->view('footer'); ?>

</body>
</html>