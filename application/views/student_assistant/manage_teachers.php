<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('teachers_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="col-md-2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_teachers')); ?>
    </div>

    <div class="col-md-10">

      <h2><?php echo lang('teachers_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('teachers_page_description'); ?>
      </div>

      <table id="teacher_table" class="table table-condensed table-hover">
        <thead>
          <tr>
            <th><?php echo lang('teachers_column_id'); ?></th>
            <th><?php echo lang('teachers_column_name'); ?></th>
            <th><?php echo lang('teachers_column_gender'); ?></th>
            <th><?php echo lang('teachers_column_institute'); ?></th>
            <th><?php echo lang('teachers_column_research_area'); ?></th>
            <th>
                <button id="teacher_create" type="button" class="btn btn-default btn-primary btn-small" ><?php echo lang('website_create'); ?></button>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $teachers as $teacher ) : ?>
            <tr>
              <td>
                  <span attr="teacher_id"><?php echo $teacher->id; ?></span>
              </td>
              <td>
                  <span attr="teacher_name"><?php echo $teacher->teacher_name; ?></span>
              </td>
              <td>
                  <span attr="teacher_gender_name"><?php echo utils::get_gender_name($teacher->teacher_gender); ?></span>
                  <span attr="teacher_gender" style="display: none"><?php echo $teacher->teacher_gender; ?></span>
              </td>
              <td>
                  <span attr="teacher_institute"><?php echo utils::get_institute_name($institute, $institutes, $teacher->institute_id); ?></span>
                  <span attr="teacher_institute_id" style="display: none"><?php echo $teacher->institute_id; ?></span>
              </td>
              <td>
                  <span attr="teacher_research_area"><?php echo $teacher->teacher_research_area; ?></span>
              </td>
                <td>
                    <button type="button" class="btn btn-default btn-small"attr="teacher_update" ><?php echo lang('website_update'); ?></button>
                    <button type="button" class="btn btn-default btn-small" attr="teacher_delete" ><?php echo lang('website_delete'); ?></button>
                </td>
            </tr>
          <?php endforeach; ?>
          <tr id="teacher_table_row_template" style="display: none">
              <td>
                  <span attr="teacher_id"></span>
              </td>
              <td>
                  <span attr="teacher_name"></span>
              </td>
              <td>
                  <span attr="teacher_gender_name"></span>
                  <span attr="teacher_gender" style="display: none"></span>
              </td>
              <td>
                  <span attr="teacher_institute"></span>
                  <span attr="teacher_institute_id" style="display: none"></span>
              </td>
              <td>
                  <span attr="teacher_research_area"></span>
              </td>
              <td>
                  <button type="button" class="btn btn-default btn-small" attr="teacher_update" ><?php echo lang('website_update'); ?></button>
                  <button type="button" class="btn btn-default btn-small" attr="teacher_delete" ><?php echo lang('website_delete'); ?></button>
              </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="teacher_management_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_teachers'); ?></h4>
                </div>
                <div class="modal-body" style="overflow-y: initial;">
                    <form class="form-horizontal" role="form">
                        <input type="hidden"  id="teacher_id">
                        <div class="form-group control-group">
                            <label for="teacher_name" class="col-sm-4 col-xs-4 control-label"><?php echo lang('teachers_column_name'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="teacher_name" placeholder="Enter teacher Name">
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="teacher_gender" class="col-sm-4 col-xs-4 control-label"><?php echo lang('teachers_column_gender'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <label class="radio inline">
                                    <input type="radio" name="teacher_gender" value="m"> Male
                                </label>
                                <label class="radio inline">
                                    <input type="radio" name="teacher_gender" value="f"> female
                                </label>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="teacher_institute_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('teachers_column_institute'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="teacher_institute_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="teacher_research_area" class="col-sm-4 col-xs-4 control-label"><?php echo lang('teachers_column_research_area'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="teacher_research_area" placeholder="Enter teacher Description">
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
    <div class="modal fade" id="teacher_delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_teachers_delete'); ?></h4>
                </div>
                <div class="modal-body">
                    <span id="teacher_delete_modal_teacher_id" style="display: none" ></span>
                    <div><?php echo lang('website_manage_teachers_delete'); ?> <span id="teacher_delete_modal_teacher_name"></span></div>
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

    function select_enable(is_enable) {
        $('#teacher_institute_select').prop('disabled', is_enable);
        $('#teacher_institute_select').selectpicker('refresh');
    }

    function radio_gender_select(gender) {
        // http://stackoverflow.com/questions/871063/how-to-set-radio-option-checked-onload-with-jquery
        // attr sometimes may not work, prop seem works, the best is to use click
        if(gender == 'm') {
            //$('input[name=teacher_gender][value=m]').prop('checked',true);
            //$('input[name=teacher_gender][value=f]').prop('checked',false);
            $('input[name=teacher_gender][value=m]').click();
        }
        else {
            //$('input[name=teacher_gender][value=m]').prop('checked',false);
            //$('input[name=teacher_gender][value=f]').prop('checked',true);
            $('input[name=teacher_gender][value=f]').click();
        }
    }

    function update_manage_modal($teacher_id, $teacher_name, $teacher_gender, $teacher_institute_id, $teacher_research_area) {
        $('#teacher_id').val($teacher_id);
        $('#teacher_name').val($teacher_name);
        radio_gender_select($teacher_gender);
        $('#teacher_institute_select').val($teacher_institute_id);
        $('#teacher_research_area').val($teacher_research_area);
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
        var $model_name = 'teacher';
        var $teacher_id_key = 'id';
        var $teacher_school_id_key = 'school_id';
        var $teacher_institute_id_key = 'institute_id';
        var $teacher_name_key = 'teacher_name';
        var $teacher_gender_key = 'teacher_gender';
        var $teacher_research_area_key = 'teacher_research_area';
        var $teacher_base_url = 'api/teacher_mgmt/teacher';
        var $is_update = false;
        var $school_id = <?php echo isset($school) ? $school->id : 0 ?>;
        var $institute_id = <?php echo isset($institute) ? $institute->id : 0 ?>;
        var $institutes_js_map = <?php echo $institutes_map ?>;
        var $default_gender = 'm';

        var $current_row = $('table#teacher_table tbody tr:first-child');

        // add institutes to institute select
        $.map($institutes_js_map, function( map_value, map_key ) {
            $('#teacher_institute_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });
        // set default value
        $('#teacher_institute_select').val($institute_id);

        // Enable Bootstrap-Select via JavaScript:
        $('#teacher_institute_select').selectpicker();

        select_enable($institute_id != 0);

        $(document).delegate('#teacher_create', 'click', function () {
            $is_update = false;
            update_manage_modal('','',$default_gender,$institute_id,'');
            $('#teacher_management_modal').modal('show');
        });

        $(document).delegate('button[attr="teacher_update"]', 'click', function () {
            $is_update = true;
            $current_row = $(this).parent().parent();
            var $teacher_id = $current_row.find('span[attr="teacher_id"]').text();
            var $teacher_name = $current_row.find('span[attr="teacher_name"]').text();
            var $teacher_gender = $current_row.find('span[attr="teacher_gender"]').text();
            var $teacher_institute_id = $current_row.find('span[attr="teacher_institute_id"]').text();
            var $teacher_research_area = $current_row.find('span[attr="teacher_research_area"]').text();
            update_manage_modal($teacher_id,$teacher_name,$teacher_gender, $teacher_institute_id,$teacher_research_area);
            // refresh select widget
            $('#teacher_institute_select').selectpicker('refresh');
            $('#teacher_management_modal').modal('show');
        });

        $(document).delegate('button[attr="teacher_delete"]', 'click', function () {
            $is_update = false;
            $current_row = $(this).parent().parent();
            var $teacher_id = $current_row.find('span[attr="teacher_id"]').text();
            var $teacher_name = $current_row.find('span[attr="teacher_name"]').text();
            var $teacher_research_area = $current_row.find('span[attr="teacher_research_area"]').text();
            update_manage_modal('','',$default_gender,$institute_id,'');
            $('#teacher_delete_modal_teacher_id').text($teacher_id);
            $('#teacher_delete_modal_teacher_name').text($teacher_name);
            $('#teacher_delete_modal').modal('show');
        });

        $('#submit').click(function () {
            var $teacher_id = $('#teacher_id').val();
            var $teacher_name = $('#teacher_name').val();
            var $teacher_gender = $('input[name=teacher_gender]:checked').val();
            var $teacher_research_area = $('#teacher_research_area').val();
            var $institute_id = $('#teacher_institute_select :selected').val();
            // Javascript "map" (object) doesn't evaluate its keys
            //  var $paras_map = {$teacher_name_key : $teacher_name, $teacher_research_area_key : $teacher_research_area}
            var $paras_map = {};
            if($is_update) {
                $paras_map[$teacher_id_key] = $teacher_id;
            }
            $paras_map[$teacher_name_key] = $teacher_name;
            $paras_map[$teacher_gender_key] = $teacher_gender;
            $paras_map[$teacher_school_id_key] = $school_id;
            $paras_map[$teacher_institute_id_key] = $institute_id;
            $paras_map[$teacher_research_area_key] = $teacher_research_area;

            $.ajax({
                type: $is_update ? "POST" : "PUT",
                url: make_request_url($teacher_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    if(data.result == "success") {
                        if($is_update) {
                            $current_row.find('span[attr="teacher_id"]').text(data[$model_name][$teacher_id_key]);
                            $current_row.find('span[attr="teacher_name"]').text(data[$model_name][$teacher_name_key]);
                            $current_row.find('span[attr="teacher_gender"]').text(data[$model_name][$teacher_gender_key]);
                            $current_row.find('span[attr="teacher_gender_name"]').text(get_gender_name(data[$model_name][$teacher_gender_key]));
                            $current_row.find('span[attr="teacher_institute"]').text($institutes_js_map[data[$model_name][$teacher_institute_id_key]]);
                            $current_row.find('span[attr="teacher_institute_id"]').text(data[$model_name][$teacher_institute_id_key]);
                            $current_row.find('span[attr="teacher_research_area"]').text(data[$model_name][$teacher_research_area_key]);
                        }
                        else {
                            //var $new_row = $('<tr>', { html : $("#teacher_table_row_template").html().clone() });
                            var $new_row = $("#teacher_table_row_template").clone().removeAttr('id').removeAttr('style');
                            $new_row.find('span[attr="teacher_id"]').text(data[$model_name][$teacher_id_key]);
                            $new_row.find('span[attr="teacher_name"]').text(data[$model_name][$teacher_name_key]);
                            $new_row.find('span[attr="teacher_gender"]').text(data[$model_name][$teacher_gender_key]);
                            $new_row.find('span[attr="teacher_gender_name"]').text(get_gender_name(data[$model_name][$teacher_gender_key]));
                            $new_row.find('span[attr="teacher_institute"]').text($institutes_js_map[data[$model_name][$teacher_institute_id_key]]);
                            $new_row.find('span[attr="teacher_institute_id"]').text(data[$model_name][$teacher_institute_id_key]);
                            $new_row.find('span[attr="teacher_research_area"]').text(data[$model_name][$teacher_research_area_key]);
                            $('table#teacher_table tbody').append($new_row);
                        }
                        $('#teacher_management_modal').modal('hide');
                    }
                    else {
                        console.info(textStatus);
                        $('#teacher_management_modal').modal('hide');
                        $('#error_modal').modal('show');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#teacher_management_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });

        $('#submit_delete').click(function () {
            var $teacher_id = $('#teacher_delete_modal_teacher_id').text();
            var $paras_map = {};
            $paras_map[$teacher_id_key] = $teacher_id;

            $.ajax({
                type: "DELETE",
                url: make_request_url($teacher_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    $current_row.remove();
                    $('#teacher_delete_modal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#teacher_delete_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });
    });
</script>

<?php echo $this->load->view('footer'); ?>

</body>
</html>