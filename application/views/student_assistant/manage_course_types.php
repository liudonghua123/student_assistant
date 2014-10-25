<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('course_types_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="col-md-2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_course_types')); ?>
    </div>

    <div class="col-md-10">

      <h2><?php echo lang('course_types_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('course_types_page_description'); ?>
      </div>

      <table id="course_type_table" class="table table-condensed table-hover">
        <thead>
          <tr>
            <th><?php echo lang('course_types_column_id'); ?></th>
            <th><?php echo lang('course_types_column_name'); ?></th>
            <th><?php echo lang('course_types_column_school'); ?></th>
            <th><?php echo lang('course_types_column_description'); ?></th>
            <th>
                <button id="course_type_create" type="button" class="btn btn-default btn-primary btn-small" ><i class="fa fa-file-o"></i> <?php echo lang('website_create'); ?></button>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $course_types as $course_type ) : ?>
            <tr>
              <td>
                  <span attr="course_type_id"><?php echo $course_type->id; ?></span>
              </td>
              <td>
                  <span attr="course_type_name"><?php echo $course_type->course_type_name; ?></span>
              </td>
              <td>
                  <span attr="course_type_school"><?php echo utils::get_school_name($school, $schools, $course_type->school_id); ?></span>
                  <span attr="course_type_school_id" style="display: none"><?php echo $course_type->school_id; ?></span>
              </td>
              <td>
                  <span attr="course_type_description"><?php echo $course_type->course_type_description; ?></span>
              </td>
                <td>
                    <button type="button" class="btn btn-default btn-small"attr="course_type_update" ><i class="fa fa-edit"></i> <?php echo lang('website_update'); ?></button>
                    <button type="button" class="btn btn-default btn-small" attr="course_type_delete" ><i class="fa fa-trash"></i> <?php echo lang('website_delete'); ?></button>
                </td>
            </tr>
          <?php endforeach; ?>
          <tr id="course_type_table_row_template" style="display: none">
              <td>
                  <span attr="course_type_id"></span>
              </td>
              <td>
                  <span attr="course_type_name"></span>
              </td>
              <td>
                  <span attr="course_type_school"></span>
                  <span attr="course_type_school_id" style="display: none"></span>
              </td>
              <td>
                  <span attr="course_type_description"></span>
              </td>
              <td>
                  <button type="button" class="btn btn-default btn-small" attr="course_type_update" ><i class="fa fa-edit"></i> <?php echo lang('website_update'); ?></button>
                  <button type="button" class="btn btn-default btn-small" attr="course_type_delete" ><i class="fa fa-trash"></i> <?php echo lang('website_delete'); ?></button>
              </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="course_type_management_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_course_types'); ?></h4>
                </div>
                <div class="modal-body" style="overflow-y: initial;">
                    <form class="form-horizontal" role="form">
                        <input type="hidden"  id="course_type_id">
                        <div class="form-group control-group">
                            <label for="course_type_name" class="col-sm-4 col-xs-4 control-label"><?php echo lang('course_types_column_name'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="course_type_name" placeholder="Enter course_type Name">
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="course_type_school_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('course_types_column_school'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="course_type_school_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="course_type_description" class="col-sm-4 col-xs-4 control-label"><?php echo lang('course_types_column_description'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="course_type_description" placeholder="Enter course_type Description">
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
    <div class="modal fade" id="course_type_delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_course_types_delete'); ?></h4>
                </div>
                <div class="modal-body">
                    <span id="course_type_delete_modal_course_type_id" style="display: none" ></span>
                    <div><?php echo lang('website_manage_course_types_delete'); ?> <span id="course_type_delete_modal_course_type_name"></span></div>
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
        $('#course_type_school_select').prop('disabled', is_enable);
        $('#course_type_school_select').selectpicker('refresh');
    }

    function update_manage_modal($course_type_id, $course_type_name, $course_type_school_id, $course_type_description) {
        $('#course_type_id').val($course_type_id);
        $('#course_type_name').val($course_type_name);
        $('#course_type_school_select').val($course_type_school_id);
        $('#course_type_description').val($course_type_description);
    }

    $(document).ready(function() {
        var $model_name = 'course_type';
        var $course_type_id_key = 'id';
        var $course_type_school_id_key = 'school_id';
        var $course_type_name_key = 'course_type_name';
        var $course_type_description_key = 'course_type_description';
        var $course_type_base_url = 'api/course_type_mgmt/course_type';
        var $is_update = false;
        var $school_id = <?php echo isset($school) ? $school->id : 0 ?>;
        var $know_school = $school_id != 0;
        var $schools_js_map = <?php echo $schools_map ?>;

        var $current_row = $('table#course_type_table tbody tr:first-child');

        // add schools to school select
        $.map( $schools_js_map, function( map_value, map_key ) {
            $('#course_type_school_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });
        // set default value
        $('#course_type_school_select').val($school_id);

        // Enable Bootstrap-Select via JavaScript:
        $('#course_type_school_select').selectpicker();

        select_enable($know_school);

        $(document).delegate('#course_type_create', 'click', function () {
            $is_update = false;
            update_manage_modal('','','','');
            $('#course_type_management_modal').modal('show');
        });

        $(document).delegate('button[attr="course_type_update"]', 'click', function () {
            $is_update = true;
            $current_row = $(this).parent().parent();
            var $course_type_id = $current_row.find('span[attr="course_type_id"]').text();
            var $course_type_name = $current_row.find('span[attr="course_type_name"]').text();
            var $course_type_school_id = $current_row.find('span[attr="course_type_school_id"]').text();
            var $course_type_description = $current_row.find('span[attr="course_type_description"]').text();
            update_manage_modal($course_type_id,$course_type_name,$course_type_school_id,$course_type_description);
            // refresh select widget
            $('#course_type_school_select').selectpicker('refresh');
            $('#course_type_management_modal').modal('show');
        });

        $(document).delegate('button[attr="course_type_delete"]', 'click', function () {
            $is_update = false;
            $current_row = $(this).parent().parent();
            var $course_type_id = $current_row.find('span[attr="course_type_id"]').text();
            var $course_type_name = $current_row.find('span[attr="course_type_name"]').text();
            var $course_type_description = $current_row.find('span[attr="course_type_description"]').text();
            update_manage_modal('','','','');
            $('#course_type_delete_modal_course_type_id').text($course_type_id);
            $('#course_type_delete_modal_course_type_name').text($course_type_name);
            $('#course_type_delete_modal').modal('show');
        });

        $('#submit').click(function () {
            var $course_type_id = $('#course_type_id').val();
            var $course_type_name = $('#course_type_name').val();
            var $course_type_description = $('#course_type_description').val();
            var $school_id = $('#course_type_school_select :selected').val();
            // Javascript "map" (object) doesn't evaluate its keys
            //  var $paras_map = {$course_type_name_key : $course_type_name, $course_type_description_key : $course_type_description}
            var $paras_map = {};
            if($is_update) {
                $paras_map[$course_type_id_key] = $course_type_id;
            }
            $paras_map[$course_type_name_key] = $course_type_name;
            $paras_map[$course_type_school_id_key] = $school_id;
            $paras_map[$course_type_description_key] = $course_type_description;

            $.ajax({
                type: $is_update ? "POST" : "PUT",
                url: make_request_url($course_type_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    if(data.result == "success") {
                        if($is_update) {
                            $current_row.find('span[attr="course_type_id"]').text(data[$model_name][$course_type_id_key]);
                            $current_row.find('span[attr="course_type_name"]').text(data[$model_name][$course_type_name_key]);
                            $current_row.find('span[attr="course_type_school"]').text($schools_js_map[data[$model_name][$course_type_school_id_key]]);
                            $current_row.find('span[attr="course_type_school_id"]').text(data[$model_name][$course_type_school_id_key]);
                            $current_row.find('span[attr="course_type_description"]').text(data[$model_name][$course_type_description_key]);
                        }
                        else {
                            //var $new_row = $('<tr>', { html : $("#course_type_table_row_template").html().clone() });
                            var $new_row = $("#course_type_table_row_template").clone().removeAttr('id').removeAttr('style');
                            $new_row.find('span[attr="course_type_id"]').text(data[$model_name][$course_type_id_key]);
                            $new_row.find('span[attr="course_type_name"]').text(data[$model_name][$course_type_name_key]);
                            $new_row.find('span[attr="course_type_school"]').text($schools_js_map[data[$model_name][$course_type_school_id_key]]);
                            $new_row.find('span[attr="course_type_school_id"]').text(data[$model_name][$course_type_school_id_key]);
                            $new_row.find('span[attr="course_type_description"]').text(data[$model_name][$course_type_description_key]);
                            $('table#course_type_table tbody').append($new_row);
                        }
                        $('#course_type_management_modal').modal('hide');
                    }
                    else {
                        console.info(textStatus);
                        $('#course_type_management_modal').modal('hide');
                        $('#error_modal').modal('show');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#course_type_management_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });

        $('#submit_delete').click(function () {
            var $course_type_id = $('#course_type_delete_modal_course_type_id').text();
            var $paras_map = {};
            $paras_map[$course_type_id_key] = $course_type_id;

            $.ajax({
                type: "DELETE",
                url: make_request_url($course_type_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    $current_row.remove();
                    $('#course_type_delete_modal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#course_type_delete_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });
    });
</script>

<?php echo $this->load->view('footer'); ?>

</body>
</html>