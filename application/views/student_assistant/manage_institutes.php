<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('institutes_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="col-md-2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_institutes')); ?>
    </div>

    <div class="col-md-10">

      <h2><?php echo lang('institutes_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('institutes_page_description'); ?>
      </div>

      <table id="institute_table" class="table table-condensed table-hover">
        <thead>
          <tr>
            <th><?php echo lang('institutes_column_id'); ?></th>
            <th><?php echo lang('institutes_column_name'); ?></th>
            <th><?php echo lang('institutes_column_school'); ?></th>
            <th><?php echo lang('institutes_column_description'); ?></th>
            <th>
                <button id="institute_create" type="button" class="btn btn-default btn-primary btn-small" ><i class="fa fa-file-o"></i> <?php echo lang('website_create'); ?></button>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $institutes as $institute ) : ?>
            <tr>
              <td>
                  <span attr="institute_id"><?php echo $institute->id; ?></span>
              </td>
              <td>
                  <span attr="institute_name"><?php echo $institute->institute_name; ?></span>
              </td>
              <td>
                  <span attr="institute_school"><?php echo utils::get_school_name($school, $schools, $institute->school_id); ?></span>
                  <span attr="institute_school_id" style="display: none"><?php echo $institute->school_id; ?></span>
              </td>
              <td>
                  <span attr="institute_description"><?php echo $institute->institute_description; ?></span>
              </td>
                <td>
                    <button type="button" class="btn btn-default btn-small"attr="institute_update" ><i class="fa fa-edit"></i> <?php echo lang('website_update'); ?></button>
                    <button type="button" class="btn btn-default btn-small" attr="institute_delete" ><i class="fa fa-trash"></i> <?php echo lang('website_delete'); ?></button>
                    <span class="dropdown">
                        <a class="dropdown-toggle btn btn-small btn-primary" id="more_manage_dropdown" role="button" data-toggle="dropdown" href="#" ><?php echo lang('website_manage_more'); ?><b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="more_manage_dropdown">
                            <li role="presentation"><?php echo anchor("student_assistant/manage_majors/index/$institute->school_id/$institute->id", lang('website_manage_majors')); ?></li>
                            <li role="presentation"><?php echo anchor("student_assistant/manage_teachers/index/$institute->school_id/$institute->id", lang('website_manage_teachers')); ?></li>
                            <li role="presentation"><?php echo anchor("student_assistant/manage_students/index/$institute->school_id/$institute->id", lang('website_manage_students')); ?></li>
                            <li role="presentation"><?php echo anchor("student_assistant/manage_schedule_profiles/index/$institute->school_id/$institute->id", lang('website_manage_schedule_profiles')); ?></li>
                            <li role="presentation"><?php echo anchor("student_assistant/manage_schedule_times/index/$institute->school_id/$institute->id", lang('website_manage_schedule_times')); ?></li>
                            <li role="presentation"><?php echo anchor("student_assistant/manage_courses/index/$institute->school_id/$institute->id", lang('website_manage_courses')); ?></li>
                            <li role="presentation"><?php echo anchor("student_assistant/manage_curriculums/index/$institute->school_id/$institute->id", lang('website_manage_curriculums')); ?></li>
                        </ul>
                    </span>
                </td>
            </tr>
          <?php endforeach; ?>
          <tr id="institute_table_row_template" style="display: none">
              <td>
                  <span attr="institute_id"></span>
              </td>
              <td>
                  <span attr="institute_name"></span>
              </td>
              <td>
                  <span attr="institute_school"></span>
                  <span attr="institute_school_id" style="display: none"></span>
              </td>
              <td>
                  <span attr="institute_description"></span>
              </td>
              <td>
                  <button type="button" class="btn btn-default btn-small"attr="institute_update" ><i class="fa fa-edit"></i> <?php echo lang('website_update'); ?></button>
                  <button type="button" class="btn btn-default btn-small" attr="institute_delete" ><i class="fa fa-trash"></i> <?php echo lang('website_delete'); ?></button>
                  <span class="dropdown">
                      <a class="dropdown-toggle btn btn-small btn-primary" id="more_manage_dropdown" role="button" data-toggle="dropdown" href="#" ><?php echo lang('website_manage_more'); ?><b class="caret"></b></a>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="more_manage_dropdown">
                          <li role="presentation"><?php echo anchor("student_assistant/manage_majors/index/school_id/institute_id", lang('website_manage_majors')); ?></li>
                          <li role="presentation"><?php echo anchor("student_assistant/manage_teachers/index/school_id/institute_id", lang('website_manage_teachers')); ?></li>
                          <li role="presentation"><?php echo anchor("student_assistant/manage_students/index/school_id/institute_id", lang('website_manage_students')); ?></li>
                          <li role="presentation"><?php echo anchor("student_assistant/manage_schedule_profiles/index/school_id/institute_id", lang('website_manage_schedule_profiles')); ?></li>
                          <li role="presentation"><?php echo anchor("student_assistant/manage_schedule_times/index/school_id/institute_id", lang('website_manage_schedule_times')); ?></li>
                          <li role="presentation"><?php echo anchor("student_assistant/manage_courses/index/school_id/institute_id", lang('website_manage_courses')); ?></li>
                          <li role="presentation"><?php echo anchor("student_assistant/manage_curriculums/index/school_id/institute_id", lang('website_manage_curriculums')); ?></li>
                      </ul>
                  </span>
              </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="institute_management_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_institutes'); ?></h4>
                </div>
                <div class="modal-body" style="overflow-y: initial;">
                    <form class="form-horizontal" role="form">
                        <input type="hidden"  id="institute_id">
                        <div class="form-group control-group">
                            <label for="institute_name" class="col-sm-4 col-xs-4 control-label"><?php echo lang('institutes_column_name'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="institute_name" placeholder="Enter institute Name">
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="institute_school_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('institutes_column_school'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="institute_school_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="institute_description" class="col-sm-4 col-xs-4 control-label"><?php echo lang('institutes_column_description'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="institute_description" placeholder="Enter institute Description">
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
    <div class="modal fade" id="institute_delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_institutes_delete'); ?></h4>
                </div>
                <div class="modal-body">
                    <span id="institute_delete_modal_institute_id" style="display: none" ></span>
                    <div><?php echo lang('website_manage_institutes_delete'); ?> <span id="institute_delete_modal_institute_name"></span></div>
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
        $('#institute_school_select').prop('disabled', is_enable);
        $('#institute_school_select').selectpicker('refresh');
    }

    function update_manage_modal($institute_id, $institute_name, $institute_school_id, $institute_description) {
        $('#institute_id').val($institute_id);
        $('#institute_name').val($institute_name);
        $('#institute_school_select').val($institute_school_id);
        $('#institute_description').val($institute_description);
    }

    function get_update_url($url, $school_id, $institute_id) {
        return $url.replace("school_id", $school_id).replace("institute_id", $institute_id);
    }

    function update_link($row, $school_id, $institute_id) {
        $row.find('a').each(function(index) {
            $(this).attr('href',get_update_url($(this).attr('href'), $school_id, $institute_id));
        });
    }

    $(document).ready(function() {
        var $model_name = 'institute';
        var $institute_id_key = 'id';
        var $institute_school_id_key = 'school_id';
        var $institute_name_key = 'institute_name';
        var $institute_description_key = 'institute_description';
        var $institute_base_url = 'api/institute_mgmt/institute';
        var $is_update = false;
        var $school_id = <?php echo isset($school) ? $school->id : 0 ?>;
        var $know_school = $school_id != 0;
        var $schools_js_map = <?php echo $schools_map ?>;

        var $current_row = $('table#institute_table tbody tr:first-child');

        // add schools to school select
        $.map( $schools_js_map, function( map_value, map_key ) {
            $('#institute_school_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });
        // set default value
        $('#institute_school_select').val($school_id);

        // Enable Bootstrap-Select via JavaScript:
        $('#institute_school_select').selectpicker();

        select_enable($know_school);

        $(document).delegate('#institute_create', 'click', function () {
            $is_update = false;
            update_manage_modal('','',$school_id,'');
            $('#institute_school_select').selectpicker('refresh');
            $('#institute_management_modal').modal('show');
        });

        $(document).delegate('button[attr="institute_update"]', 'click', function () {
            $is_update = true;
            $current_row = $(this).parent().parent();
            var $institute_id = $current_row.find('span[attr="institute_id"]').text();
            var $institute_name = $current_row.find('span[attr="institute_name"]').text();
            var $institute_school_id = $current_row.find('span[attr="institute_school_id"]').text();
            var $institute_description = $current_row.find('span[attr="institute_description"]').text();
            update_manage_modal($institute_id,$institute_name,$institute_school_id,$institute_description);
            // refresh select widget
            $('#institute_school_select').selectpicker('refresh');
            $('#institute_management_modal').modal('show');
        });

        $(document).delegate('button[attr="institute_delete"]', 'click', function () {
            $is_update = false;
            $current_row = $(this).parent().parent();
            var $institute_id = $current_row.find('span[attr="institute_id"]').text();
            var $institute_name = $current_row.find('span[attr="institute_name"]').text();
            var $institute_description = $current_row.find('span[attr="institute_description"]').text();
            update_manage_modal('','','','');
            $('#institute_delete_modal_institute_id').text($institute_id);
            $('#institute_delete_modal_institute_name').text($institute_name);
            $('#institute_delete_modal').modal('show');
        });

        $('#submit').click(function () {
            var $institute_id = $('#institute_id').val();
            var $institute_name = $('#institute_name').val();
            var $institute_description = $('#institute_description').val();
            var $school_id = $('#institute_school_select :selected').val();
            // Javascript "map" (object) doesn't evaluate its keys
            //  var $paras_map = {$institute_name_key : $institute_name, $institute_description_key : $institute_description}
            var $paras_map = {};
            if($is_update) {
                $paras_map[$institute_id_key] = $institute_id;
            }
            $paras_map[$institute_name_key] = $institute_name;
            $paras_map[$institute_school_id_key] = $school_id;
            $paras_map[$institute_description_key] = $institute_description;

            $.ajax({
                type: $is_update ? "POST" : "PUT",
                url: make_request_url($institute_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    if(data.result == "success") {
                        if($is_update) {
                            $current_row.find('span[attr="institute_id"]').text(data[$model_name][$institute_id_key]);
                            $current_row.find('span[attr="institute_name"]').text(data[$model_name][$institute_name_key]);
                            $current_row.find('span[attr="institute_school"]').text($schools_js_map[data[$model_name][$institute_school_id_key]]);
                            $current_row.find('span[attr="institute_school_id"]').text(data[$model_name][$institute_school_id_key]);
                            $current_row.find('span[attr="institute_description"]').text(data[$model_name][$institute_description_key]);
                            update_link($current_row, data[$model_name][$institute_school_id_key], data[$model_name][$institute_id_key]);
                        }
                        else {
                            //var $new_row = $('<tr>', { html : $("#institute_table_row_template").html().clone() });
                            var $new_row = $("#institute_table_row_template").clone().removeAttr('id').removeAttr('style');
                            $new_row.find('span[attr="institute_id"]').text(data[$model_name][$institute_id_key]);
                            $new_row.find('span[attr="institute_name"]').text(data[$model_name][$institute_name_key]);
                            $new_row.find('span[attr="institute_school"]').text($schools_js_map[data[$model_name][$institute_school_id_key]]);
                            $new_row.find('span[attr="institute_school_id"]').text(data[$model_name][$institute_school_id_key]);
                            $new_row.find('span[attr="institute_description"]').text(data[$model_name][$institute_description_key]);
                            update_link($new_row, data[$model_name][$institute_school_id_key], data[$model_name][$institute_id_key]);
                            $('table#institute_table tbody').append($new_row);
                        }
                        $('#institute_management_modal').modal('hide');
                    }
                    else {
                        console.info(textStatus);
                        $('#institute_management_modal').modal('hide');
                        $('#error_modal').modal('show');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#institute_management_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });

        $('#submit_delete').click(function () {
            var $institute_id = $('#institute_delete_modal_institute_id').text();
            var $paras_map = {};
            $paras_map[$institute_id_key] = $institute_id;

            $.ajax({
                type: "DELETE",
                url: make_request_url($institute_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    $current_row.remove();
                    $('#institute_delete_modal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#institute_delete_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });
    });
</script>

<?php echo $this->load->view('footer'); ?>

</body>
</html>