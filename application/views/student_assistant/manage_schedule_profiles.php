<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('schedule_profiles_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="col-md-2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_schedule_profiles')); ?>
    </div>

    <div class="col-md-10">

      <h2><?php echo lang('schedule_profiles_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('schedule_profiles_page_description'); ?>
      </div>

      <table id="schedule_profile_table" class="table table-condensed table-hover">
        <thead>
          <tr>
            <th><?php echo lang('schedule_profiles_column_id'); ?></th>
            <th><?php echo lang('schedule_profiles_column_name'); ?></th>
            <th><?php echo lang('schedule_profiles_column_description'); ?></th>
            <th>
                <button id="schedule_profile_create" type="button" class="btn btn-default btn-primary btn-small" ><?php echo lang('website_create'); ?></button>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $schedule_profiles as $schedule_profile ) : ?>
            <tr>
              <td>
                  <span attr="schedule_profile_id"><?php echo $schedule_profile->id; ?></span>
              </td>
              <td>
                  <span attr="schedule_profile_name"><?php echo $schedule_profile->schedule_profile_name; ?></span>
              </td>
              <td>
                  <span attr="schedule_profile_description"><?php echo $schedule_profile->schedule_profile_description; ?></span>
              </td>
                <td>
                    <button type="button" class="btn btn-default btn-small"attr="schedule_profile_update" ><?php echo lang('website_update'); ?></button>
                    <button type="button" class="btn btn-default btn-small" attr="schedule_profile_delete" ><?php echo lang('website_delete'); ?></button>
                </td>
            </tr>
          <?php endforeach; ?>
          <tr id="schedule_profile_table_row_template" style="display: none">
              <td>
                  <span attr="schedule_profile_id"></span>
              </td>
              <td>
                  <span attr="schedule_profile_name"></span>
              </td>
              <td>
                  <span attr="schedule_profile_description"></span>
              </td>
              <td>
                  <button type="button" class="btn btn-default btn-small"attr="schedule_profile_update" ><?php echo lang('website_update'); ?></button>
                  <button type="button" class="btn btn-default btn-small" attr="schedule_profile_delete" ><?php echo lang('website_delete'); ?></button>
              </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="schedule_profile_management_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_schedule_profiles'); ?></h4>
                </div>
                <div class="modal-body" style="overflow-y: initial;">
                    <form class="form-horizontal" role="form">
                        <input type="hidden"  id="schedule_profile_id">
                        <div class="form-group control-group">
                            <label for="schedule_profile_name" class="col-sm-5 col-xs-5 control-label"><?php echo lang('schedule_profiles_column_name'); ?></label>
                            <div class="col-sm-7 col-xs-7 controls">
                                <input type="text" class="form-control input-large required" id="schedule_profile_name" placeholder="Enter schedule_profile Name">
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="schedule_profile_description" class="col-sm-5 col-xs-5 control-label"><?php echo lang('schedule_profiles_column_description'); ?></label>
                            <div class="col-sm-7 col-xs-7 controls">
                                <input type="text" class="form-control input-large required" id="schedule_profile_description" placeholder="Enter schedule_profile Description">
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
    <div class="modal fade" id="schedule_profile_delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_schedule_profiles_delete'); ?></h4>
                </div>
                <div class="modal-body">
                    <span id="schedule_profile_delete_modal_schedule_profile_id" style="display: none" ></span>
                    <div><?php echo lang('website_manage_schedule_profiles_delete'); ?> <span id="schedule_profile_delete_modal_schedule_profile_name"></span></div>
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

    function update_manage_modal($schedule_profile_id, $schedule_profile_name, $schedule_profile_description) {
        $('#schedule_profile_id').val($schedule_profile_id);
        $('#schedule_profile_name').val($schedule_profile_name);
        $('#schedule_profile_description').val($schedule_profile_description);
    }

    function get_update_url($url, $school_id, $schedule_profile_id) {
        return $url.replace("school_id", $school_id).replace("schedule_profile_id", $schedule_profile_id);
    }

    function update_link($row, $school_id, $schedule_profile_id) {
        $row.find('a').each(function(index) {
            $(this).attr('href',get_update_url($(this).attr('href'), $school_id, $schedule_profile_id));
        });
    }

    $(document).ready(function() {
        var $model_name = 'schedule_profile';
        var $schedule_profile_id_key = 'id';
        var $schedule_profile_school_id_key = 'school_id';
        var $schedule_profile_institute_id_key = 'institute_id';
        var $schedule_profile_name_key = 'schedule_profile_name';
        var $schedule_profile_description_key = 'schedule_profile_description';
        var $schedule_profile_base_url = 'api/schedule_profile_mgmt/schedule_profile';
        var $is_update = false;
        var $school_id = <?php echo isset($school) ? $school->id : 0 ?>;
        var $institute_id = <?php echo isset($institute) ? $institute->id : 0 ?>;

        var $current_row = $('table#schedule_profile_table tbody tr:first-child');

        $(document).delegate('#schedule_profile_create', 'click', function () {
            $is_update = false;
            update_manage_modal('','','');
            $('#schedule_profile_management_modal').modal('show');
        });

        $(document).delegate('button[attr="schedule_profile_update"]', 'click', function () {
            $is_update = true;
            $current_row = $(this).parent().parent();
            var $schedule_profile_id = $current_row.find('span[attr="schedule_profile_id"]').text();
            var $schedule_profile_name = $current_row.find('span[attr="schedule_profile_name"]').text();
            var $schedule_profile_description = $current_row.find('span[attr="schedule_profile_description"]').text();
            update_manage_modal($schedule_profile_id,$schedule_profile_name,$schedule_profile_description);
            $('#schedule_profile_management_modal').modal('show');
        });

        $(document).delegate('button[attr="schedule_profile_delete"]', 'click', function () {
            $is_update = false;
            $current_row = $(this).parent().parent();
            var $schedule_profile_id = $current_row.find('span[attr="schedule_profile_id"]').text();
            var $schedule_profile_name = $current_row.find('span[attr="schedule_profile_name"]').text();
            var $schedule_profile_description = $current_row.find('span[attr="schedule_profile_description"]').text();
            update_manage_modal('','','');
            $('#schedule_profile_delete_modal_schedule_profile_id').text($schedule_profile_id);
            $('#schedule_profile_delete_modal_schedule_profile_name').text($schedule_profile_name);
            $('#schedule_profile_delete_modal').modal('show');
        });

        $('#submit').click(function () {
            var $schedule_profile_id = $('#schedule_profile_id').val();
            var $schedule_profile_name = $('#schedule_profile_name').val();
            var $schedule_profile_description = $('#schedule_profile_description').val();
            // Javascript "map" (object) doesn't evaluate its keys
            //  var $paras_map = {$schedule_profile_name_key : $schedule_profile_name, $schedule_profile_description_key : $schedule_profile_description}
            var $paras_map = {};
            if($is_update) {
                $paras_map[$schedule_profile_id_key] = $schedule_profile_id;
            }
            $paras_map[$schedule_profile_name_key] = $schedule_profile_name;
            $paras_map[$schedule_profile_school_id_key] = $school_id;
            $paras_map[$schedule_profile_institute_id_key] = $institute_id;
            $paras_map[$schedule_profile_description_key] = $schedule_profile_description;

            $.ajax({
                type: $is_update ? "POST" : "PUT",
                url: make_request_url($schedule_profile_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    if(data.result == "success") {
                        if($is_update) {
                            $current_row.find('span[attr="schedule_profile_id"]').text(data[$model_name][$schedule_profile_id_key]);
                            $current_row.find('span[attr="schedule_profile_name"]').text(data[$model_name][$schedule_profile_name_key]);
                            $current_row.find('span[attr="schedule_profile_description"]').text(data[$model_name][$schedule_profile_description_key]);
                            update_link($current_row, data[$model_name][$schedule_profile_school_id_key], data[$model_name][$schedule_profile_id_key]);
                        }
                        else {
                            //var $new_row = $('<tr>', { html : $("#schedule_profile_table_row_template").html().clone() });
                            var $new_row = $("#schedule_profile_table_row_template").clone().removeAttr('id').removeAttr('style');
                            $new_row.find('span[attr="schedule_profile_id"]').text(data[$model_name][$schedule_profile_id_key]);
                            $new_row.find('span[attr="schedule_profile_name"]').text(data[$model_name][$schedule_profile_name_key]);
                            $new_row.find('span[attr="schedule_profile_description"]').text(data[$model_name][$schedule_profile_description_key]);
                            update_link($new_row, data[$model_name][$schedule_profile_school_id_key], data[$model_name][$schedule_profile_id_key]);
                            $('table#schedule_profile_table tbody').append($new_row);
                        }
                        $('#schedule_profile_management_modal').modal('hide');
                    }
                    else {
                        console.info(textStatus);
                        $('#schedule_profile_management_modal').modal('hide');
                        $('#error_modal').modal('show');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#schedule_profile_management_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });

        $('#submit_delete').click(function () {
            var $schedule_profile_id = $('#schedule_profile_delete_modal_schedule_profile_id').text();
            var $paras_map = {};
            $paras_map[$schedule_profile_id_key] = $schedule_profile_id;

            $.ajax({
                type: "DELETE",
                url: make_request_url($schedule_profile_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    $current_row.remove();
                    $('#schedule_profile_delete_modal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#schedule_profile_delete_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });
    });
</script>

<?php echo $this->load->view('footer'); ?>

</body>
</html>