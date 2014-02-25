<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('schools_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="col-md-2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_schools')); ?>
    </div>

    <div class="col-md-10">

      <h2><?php echo lang('schools_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('schools_page_description'); ?>
      </div>

      <table id="school_table" class="table table-condensed table-hover">
        <thead>
          <tr>
            <th><?php echo lang('schools_column_id'); ?></th>
            <th><?php echo lang('schools_column_name'); ?></th>
            <th><?php echo lang('schools_column_description'); ?></th>
            <th>
                <button id="school_create" type="button" class="btn btn-default btn-primary btn-small" ><?php echo lang('website_create'); ?></button>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $schools as $school ) : ?>
            <tr>
              <td>
                  <span attr="school_id"><?php echo $school->id; ?></span>
              </td>
              <td>
                  <span attr="school_name"><?php echo $school->school_name; ?></span>
              </td>
              <td>
                  <span attr="school_description"><?php echo $school->school_description; ?></span>
              </td>
              <td>
                  <button type="button" class="btn btn-default btn-small"attr="school_update" ><?php echo lang('website_update'); ?></button>
                  <button type="button" class="btn btn-default btn-small" attr="school_delete" ><?php echo lang('website_delete'); ?></button>
                  <?php echo anchor("student_assistant/manage_institutes/index/$school->id", lang('website_manage_institutes'), 'class="btn btn-default btn-small btn-primary"'); ?>
                  <?php echo anchor("student_assistant/manage_rooms/index/$school->id", lang('website_manage_rooms'), 'class="btn btn-default btn-small btn-primary"'); ?>
                  <?php echo anchor("student_assistant/manage_course_types/index/$school->id", lang('website_manage_course_types'), 'class="btn btn-default btn-small btn-primary"'); ?>
              </td>
            </tr>
          <?php endforeach; ?>
          <tr id="school_table_row_template" style="display: none">
              <td>
                  <span attr="school_id"></span>
              </td>
              <td>
                  <span attr="school_name"></span>
              </td>
              <td>
                  <span attr="school_description"></span>
              </td>
              <td>
                  <button type="button" class="btn btn-default btn-small"attr="school_update" ><?php echo lang('website_update'); ?></button>
                  <button type="button" class="btn btn-default btn-small" attr="school_delete" ><?php echo lang('website_delete'); ?></button>
                  <?php echo anchor("student_assistant/manage_institutes/index/school_id", lang('website_manage_institutes'), 'class="btn btn-default btn-small btn-primary"'); ?>
                  <?php echo anchor("student_assistant/manage_rooms/index/school_id", lang('website_manage_rooms'), 'class="btn btn-default btn-small btn-primary"'); ?>
                  <?php echo anchor("student_assistant/manage_course_types/index/school_id", lang('website_manage_course_types'), 'class="btn btn-default btn-small btn-primary"'); ?>
              </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="school_management_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_schools'); ?></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <input type="hidden"  id="school_id">
                        <div class="form-group control-group">
                            <label for="school_name" class="col-sm-4 col-xs-4 control-label"><?php echo lang('schools_column_name'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="school_name" placeholder="Enter School Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="school_description" class="col-sm-4 col-xs-4 control-label"><?php echo lang('schools_column_description'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="school_description" placeholder="Enter School Description">
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
    <div class="modal fade" id="school_delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_schools_delete'); ?></h4>
                </div>
                <div class="modal-body">
                    <span id="school_delete_modal_school_id" style="display: none" ></span>
                    <div><?php echo lang('website_manage_schools_delete'); ?> <span id="school_delete_modal_school_name"></span></div>
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

    function get_update_url($url, $school_id) {
        return $url.replace("school_id", $school_id);
    }

    function update_link($row, $school_id) {
        $row.find('a').each(function(index) {
            $(this).attr('href',get_update_url($(this).attr('href'), $school_id));
        });
    }

    $(document).ready(function() {
        var $model_name = 'school';
        var $school_id_key = 'id';
        var $school_name_key = 'school_name';
        var $school_description_key = 'school_description';
        var $school_base_url = 'api/school_mgmt/school';
        var $is_update = false;

        var $current_row = $('table#school_table tbody tr:first-child');

        $(document).delegate('#school_create', 'click', function () {
            $is_update = false;
            $('#school_id').val('');
            $('#school_name').val('');
            $('#school_description').val('');
            $('#school_management_modal').modal('show');
        });

        $(document).delegate('button[attr="school_update"]', 'click', function () {
            $is_update = true;
            $current_row = $(this).parent().parent();
            var $school_id = $current_row.find('span[attr="school_id"]').text();
            var $school_name = $current_row.find('span[attr="school_name"]').text();
            var $school_description = $current_row.find('span[attr="school_description"]').text();
            $('#school_id').val($school_id);
            $('#school_name').val($school_name);
            $('#school_description').val($school_description);
            $('#school_management_modal').modal('show');
        });

        $(document).delegate('button[attr="school_delete"]', 'click', function () {
            $is_update = false;
            $current_row = $(this).parent().parent();
            var $school_id = $current_row.find('span[attr="school_id"]').text();
            var $school_name = $current_row.find('span[attr="school_name"]').text();
            var $school_description = $current_row.find('span[attr="school_description"]').text();
            $('#school_id').val('');
            $('#school_name').val('');
            $('#school_description').val('');
            $('#school_delete_modal_school_id').text($school_id);
            $('#school_delete_modal_school_name').text($school_name);
            $('#school_delete_modal').modal('show');
        });

        $('#submit').click(function () {
            var $school_id = $('#school_id').val();
            var $school_name = $('#school_name').val();
            var $school_description = $('#school_description').val();
            // Javascript "map" (object) doesn't evaluate its keys
            //  var $paras_map = {$school_name_key : $school_name, $school_description_key : $school_description}
            var $paras_map = {};
            if($is_update) {
                $paras_map[$school_id_key] = $school_id;
            }
            $paras_map[$school_name_key] = $school_name;
            $paras_map[$school_description_key] = $school_description;

            $.ajax({
                type: $is_update ? "POST" : "PUT",
                url: make_request_url($school_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    if(data.result == "success") {
                        if($is_update) {
                            $current_row.find('span[attr="school_id"]').text(data[$model_name][$school_id_key]);
                            $current_row.find('span[attr="school_name"]').text(data[$model_name][$school_name_key]);
                            $current_row.find('span[attr="school_description"]').text(data[$model_name][$school_description_key]);
                            update_link($current_row, data[$model_name][$school_id_key]);
                        }
                        else {
                            var $new_row = $("#school_table_row_template").clone().removeAttr('id').removeAttr('style');
                            $new_row.find('span[attr="school_id"]').text(data[$model_name][$school_id_key]);
                            $new_row.find('span[attr="school_name"]').text(data[$model_name][$school_name_key]);
                            $new_row.find('span[attr="school_description"]').text(data[$model_name][$school_description_key]);
                            update_link($new_row, data[$model_name][$school_id_key]);
                            $('table#school_table tbody').append($new_row);
                        }
                        $('#school_management_modal').modal('hide');
                    }
                    else {
                        console.info(textStatus);
                        $('#school_management_modal').modal('hide');
                        $('#error_modal').modal('show');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#school_management_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });

        $('#submit_delete').click(function () {
            var $school_id = $('#school_delete_modal_school_id').text();
            var $paras_map = {};
            $paras_map[$school_id_key] = $school_id;

            $.ajax({
                type: "DELETE",
                url: make_request_url($school_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    $current_row.remove();
                    $('#school_delete_modal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#school_delete_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });
    });
</script>

<?php echo $this->load->view('footer'); ?>

</body>
</html>