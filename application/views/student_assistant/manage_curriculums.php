<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('curriculums_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="col-md-2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_curriculums')); ?>
    </div>

    <div class="col-md-10">

      <h2><?php echo lang('curriculums_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('curriculums_page_description'); ?>
      </div>

      <table id="curriculum_table" class="table table-condensed table-hover">
        <thead>
          <tr>
            <th><?php echo lang('curriculums_column_id'); ?></th>
            <th><?php echo lang('curriculums_column_name'); ?></th>
            <th><?php echo lang('curriculums_column_description'); ?></th>
            <th>
                <button id="curriculum_create" type="button" class="btn btn-default btn-primary btn-small" ><i class="fa fa-file-o"></i> <?php echo lang('website_create'); ?></button>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $curriculums as $curriculum ) : ?>
            <tr>
              <td>
                  <span attr="curriculum_id"><?php echo $curriculum->id; ?></span>
              </td>
              <td>
                  <span attr="curriculum_name"><?php echo $curriculum->curriculum_name; ?></span>
              </td>
              <td>
                  <span attr="curriculum_description"><?php echo $curriculum->curriculum_description; ?></span>
              </td>
                <td>
                    <button type="button" class="btn btn-default btn-small"attr="curriculum_update" ><i class="fa fa-edit"></i> <?php echo lang('website_update'); ?></button>
                    <button type="button" class="btn btn-default btn-small" attr="curriculum_delete" ><i class="fa fa-trash"></i> <?php echo lang('website_delete'); ?></button>
                    <?php echo anchor("student_assistant/manage_lessons/index/$institute->school_id/$institute->id/$curriculum->id", lang('website_manage_lessons'), 'class="btn btn-default btn-small btn-primary"'); ?>
                </td>
            </tr>
          <?php endforeach; ?>
          <tr id="curriculum_table_row_template" style="display: none">
              <td>
                  <span attr="curriculum_id"></span>
              </td>
              <td>
                  <span attr="curriculum_name"></span>
              </td>
              <td>
                  <span attr="curriculum_description"></span>
              </td>
              <td>
                  <button type="button" class="btn btn-default btn-small" attr="curriculum_update" ><i class="fa fa-edit"></i> <?php echo lang('website_update'); ?></button>
                  <button type="button" class="btn btn-default btn-small" attr="curriculum_delete" ><i class="fa fa-trash"></i> <?php echo lang('website_delete'); ?></button>
                  <?php echo anchor("student_assistant/manage_lessons/index/school_id/institute_id/curriculum_id", lang('website_manage_lessons'), 'class="btn btn-default btn-small btn-primary"'); ?>
              </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="curriculum_management_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_curriculums'); ?></h4>
                </div>
                <div class="modal-body" style="overflow-y: initial;">
                    <form class="form-horizontal" role="form">
                        <input type="hidden"  id="curriculum_id">
                        <div class="form-group control-group">
                            <label for="curriculum_name" class="col-sm-4 col-xs-4 control-label"><?php echo lang('curriculums_column_name'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="curriculum_name" placeholder="Enter curriculum Name">
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="curriculum_description" class="col-sm-4 col-xs-4 control-label"><?php echo lang('curriculums_column_description'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="curriculum_description" placeholder="Enter curriculum Description">
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
    <div class="modal fade" id="curriculum_delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_curriculums_delete'); ?></h4>
                </div>
                <div class="modal-body">
                    <span id="curriculum_delete_modal_curriculum_id" style="display: none" ></span>
                    <div><?php echo lang('website_manage_curriculums_delete'); ?> <span id="curriculum_delete_modal_curriculum_name"></span></div>
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

    function update_manage_modal($curriculum_id, $curriculum_name, $curriculum_description) {
        $('#curriculum_id').val($curriculum_id);
        $('#curriculum_name').val($curriculum_name);
        $('#curriculum_description').val($curriculum_description);
    }

    function get_update_url($url, $school_id, $institute_id, $curriculum_id) {
        return $url.replace("school_id", $school_id).replace("institute_id", $institute_id).replace("curriculum_id", $curriculum_id);
    }

    function update_link($row, $school_id, $institute_id, $curriculum_id) {
        $row.find('a').each(function(index) {
            $(this).attr('href',get_update_url($(this).attr('href'), $school_id, $institute_id, $curriculum_id));
        });
    }

    $(document).ready(function() {
        var $model_name = 'curriculum';
        var $curriculum_id_key = 'id';
        var $curriculum_name_key = 'curriculum_name';
        var $course_school_id_key = 'school_id';
        var $course_institute_id_key = 'institute_id';
        var $curriculum_description_key = 'curriculum_description';
        var $curriculum_base_url = 'api/curriculum_mgmt/curriculum';
        var $is_update = false;
        var $school_id = <?php echo isset($school) ? $school->id : 0 ?>;
        var $institute_id = <?php echo isset($institute) ? $institute->id : 0 ?>;

        var $current_row = $('table#curriculum_table tbody tr:first-child');

        $(document).delegate('#curriculum_create', 'click', function () {
            $is_update = false;
            update_manage_modal('','','');
            $('#curriculum_management_modal').modal('show');
        });

        $(document).delegate('button[attr="curriculum_update"]', 'click', function () {
            $is_update = true;
            $current_row = $(this).parent().parent();
            var $curriculum_id = $current_row.find('span[attr="curriculum_id"]').text();
            var $curriculum_name = $current_row.find('span[attr="curriculum_name"]').text();
            var $curriculum_description = $current_row.find('span[attr="curriculum_description"]').text();
            update_manage_modal($curriculum_id,$curriculum_name,$curriculum_description);
            $('#curriculum_management_modal').modal('show');
        });

        $(document).delegate('button[attr="curriculum_delete"]', 'click', function () {
            $is_update = false;
            $current_row = $(this).parent().parent();
            var $curriculum_id = $current_row.find('span[attr="curriculum_id"]').text();
            var $curriculum_name = $current_row.find('span[attr="curriculum_name"]').text();
            var $curriculum_description = $current_row.find('span[attr="curriculum_description"]').text();
            update_manage_modal('','','');
            $('#curriculum_delete_modal_curriculum_id').text($curriculum_id);
            $('#curriculum_delete_modal_curriculum_name').text($curriculum_name);
            $('#curriculum_delete_modal').modal('show');
        });

        $('#submit').click(function () {
            var $curriculum_id = $('#curriculum_id').val();
            var $curriculum_name = $('#curriculum_name').val();
            var $curriculum_description = $('#curriculum_description').val();
            var $paras_map = {};
            if($is_update) {
                $paras_map[$curriculum_id_key] = $curriculum_id;
            }
            $paras_map[$curriculum_name_key] = $curriculum_name;
            $paras_map[$course_school_id_key] = $school_id;
            $paras_map[$course_institute_id_key] = $institute_id;
            $paras_map[$curriculum_description_key] = $curriculum_description;

            $.ajax({
                type: $is_update ? "POST" : "PUT",
                url: make_request_url($curriculum_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    if(data.result == "success") {
                        if($is_update) {
                            $current_row.find('span[attr="curriculum_id"]').text(data[$model_name][$curriculum_id_key]);
                            $current_row.find('span[attr="curriculum_name"]').text(data[$model_name][$curriculum_name_key]);
                            $current_row.find('span[attr="curriculum_description"]').text(data[$model_name][$curriculum_description_key]);
                            update_link($current_row, $school_id, $institute_id, data[$model_name][$curriculum_id_key]);
                        }
                        else {
                            //var $new_row = $('<tr>', { html : $("#curriculum_table_row_template").html().clone() });
                            var $new_row = $("#curriculum_table_row_template").clone().removeAttr('id').removeAttr('style');
                            $new_row.find('span[attr="curriculum_id"]').text(data[$model_name][$curriculum_id_key]);
                            $new_row.find('span[attr="curriculum_name"]').text(data[$model_name][$curriculum_name_key]);
                            $new_row.find('span[attr="curriculum_description"]').text(data[$model_name][$curriculum_description_key]);
                            update_link($new_row, $school_id, $institute_id, data[$model_name][$curriculum_id_key]);
                            $('table#curriculum_table tbody').append($new_row);
                        }
                        $('#curriculum_management_modal').modal('hide');
                    }
                    else {
                        console.info(textStatus);
                        $('#curriculum_management_modal').modal('hide');
                        $('#error_modal').modal('show');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#curriculum_management_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });

        $('#submit_delete').click(function () {
            var $curriculum_id = $('#curriculum_delete_modal_curriculum_id').text();
            var $paras_map = {};
            $paras_map[$curriculum_id_key] = $curriculum_id;

            $.ajax({
                type: "DELETE",
                url: make_request_url($curriculum_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    $current_row.remove();
                    $('#curriculum_delete_modal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#curriculum_delete_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });
    });
</script>

<?php echo $this->load->view('footer'); ?>

</body>
</html>