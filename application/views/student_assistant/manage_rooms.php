<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('rooms_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="col-md-2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_rooms')); ?>
    </div>

    <div class="col-md-10">

      <h2><?php echo lang('rooms_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('rooms_page_description'); ?>
      </div>

      <table id="room_table" class="table table-condensed table-hover">
        <thead>
          <tr>
            <th><?php echo lang('rooms_column_id'); ?></th>
            <th><?php echo lang('rooms_column_name'); ?></th>
            <th><?php echo lang('rooms_column_school'); ?></th>
            <th><?php echo lang('rooms_column_description'); ?></th>
            <th>
                <button id="room_create" type="button" class="btn btn-default btn-primary btn-small" ><?php echo lang('website_create'); ?></button>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $rooms as $room ) : ?>
            <tr>
              <td>
                  <span attr="room_id"><?php echo $room->id; ?></span>
              </td>
              <td>
                  <span attr="room_name"><?php echo $room->room_name; ?></span>
              </td>
              <td>
                  <span attr="room_school"><?php echo utils::get_school_name($school, $schools, $room->school_id); ?></span>
                  <span attr="room_school_id" style="display: none"><?php echo $room->school_id; ?></span>
              </td>
              <td>
                  <span attr="room_description"><?php echo $room->room_description; ?></span>
              </td>
                <td>
                    <button type="button" class="btn btn-default btn-small"attr="room_update" ><?php echo lang('website_update'); ?></button>
                    <button type="button" class="btn btn-default btn-small" attr="room_delete" ><?php echo lang('website_delete'); ?></button>
                </td>
            </tr>
          <?php endforeach; ?>
          <tr id="room_table_row_template" style="display: none">
              <td>
                  <span attr="room_id"></span>
              </td>
              <td>
                  <span attr="room_name"></span>
              </td>
              <td>
                  <span attr="room_school"></span>
                  <span attr="room_school_id" style="display: none"></span>
              </td>
              <td>
                  <span attr="room_description"></span>
              </td>
              <td>
                  <button type="button" class="btn btn-default btn-small" attr="room_update" ><?php echo lang('website_update'); ?></button>
                  <button type="button" class="btn btn-default btn-small" attr="room_delete" ><?php echo lang('website_delete'); ?></button>
              </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="room_management_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_rooms'); ?></h4>
                </div>
                <div class="modal-body" style="overflow-y: initial;">
                    <form class="form-horizontal" role="form">
                        <input type="hidden"  id="room_id">
                        <div class="form-group control-group">
                            <label for="room_name" class="col-sm-4 col-xs-4 control-label"><?php echo lang('rooms_column_name'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="room_name" placeholder="Enter room Name">
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="room_school_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('rooms_column_school'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="room_school_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="room_description" class="col-sm-4 col-xs-4 control-label"><?php echo lang('rooms_column_description'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="room_description" placeholder="Enter room Description">
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
    <div class="modal fade" id="room_delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_rooms_delete'); ?></h4>
                </div>
                <div class="modal-body">
                    <span id="room_delete_modal_room_id" style="display: none" ></span>
                    <div><?php echo lang('website_manage_rooms_delete'); ?> <span id="room_delete_modal_room_name"></span></div>
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
        $('#room_school_select').prop('disabled', is_enable);
        $('#room_school_select').selectpicker('refresh');
    }

    function update_manage_modal($room_id, $room_name, $room_school_id, $room_description) {
        $('#room_id').val($room_id);
        $('#room_name').val($room_name);
        $('#room_school_select').val($room_school_id);
        $('#room_description').val($room_description);
    }

    $(document).ready(function() {
        var $model_name = 'room';
        var $room_id_key = 'id';
        var $room_school_id_key = 'school_id';
        var $room_name_key = 'room_name';
        var $room_description_key = 'room_description';
        var $room_base_url = 'api/room_mgmt/room';
        var $is_update = false;
        var $school_id = <?php echo isset($school) ? $school->id : 0 ?>;
        var $schools_js_map = <?php echo $schools_map ?>;

        var $current_row = $('table#room_table tbody tr:first-child');

        // add schools to school select
        $.map( $schools_js_map, function( map_value, map_key ) {
            $('#room_school_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });
        // set default value
        $('#room_school_select').val($school_id);

        // Enable Bootstrap-Select via JavaScript:
        $('#room_school_select').selectpicker();

        select_enable($school_id != 0);

        $(document).delegate('#room_create', 'click', function () {
            $is_update = false;
            update_manage_modal('','',$school_id,'');
            $('#room_management_modal').modal('show');
        });

        $(document).delegate('button[attr="room_update"]', 'click', function () {
            $is_update = true;
            $current_row = $(this).parent().parent();
            var $room_id = $current_row.find('span[attr="room_id"]').text();
            var $room_name = $current_row.find('span[attr="room_name"]').text();
            var $room_school_id = $current_row.find('span[attr="room_school_id"]').text();
            var $room_description = $current_row.find('span[attr="room_description"]').text();
            update_manage_modal($room_id,$room_name,$room_school_id,$room_description);
            // refresh select widget
            $('#room_school_select').selectpicker('refresh');
            $('#room_management_modal').modal('show');
        });

        $(document).delegate('button[attr="room_delete"]', 'click', function () {
            $is_update = false;
            $current_row = $(this).parent().parent();
            var $room_id = $current_row.find('span[attr="room_id"]').text();
            var $room_name = $current_row.find('span[attr="room_name"]').text();
            var $room_description = $current_row.find('span[attr="room_description"]').text();
            update_manage_modal('','',$school_id,'');
            $('#room_delete_modal_room_id').text($room_id);
            $('#room_delete_modal_room_name').text($room_name);
            $('#room_delete_modal').modal('show');
        });

        $('#submit').click(function () {
            var $room_id = $('#room_id').val();
            var $room_name = $('#room_name').val();
            var $room_description = $('#room_description').val();
            var $school_id = $('#room_school_select :selected').val();
            // Javascript "map" (object) doesn't evaluate its keys
            //  var $paras_map = {$room_name_key : $room_name, $room_description_key : $room_description}
            var $paras_map = {};
            if($is_update) {
                $paras_map[$room_id_key] = $room_id;
            }
            $paras_map[$room_name_key] = $room_name;
            $paras_map[$room_school_id_key] = $school_id;
            $paras_map[$room_description_key] = $room_description;

            $.ajax({
                type: $is_update ? "POST" : "PUT",
                url: make_request_url($room_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    if(data.result == "success") {
                        if($is_update) {
                            $current_row.find('span[attr="room_id"]').text(data[$model_name][$room_id_key]);
                            $current_row.find('span[attr="room_name"]').text(data[$model_name][$room_name_key]);
                            $current_row.find('span[attr="room_school"]').text($schools_js_map[data[$model_name][$room_school_id_key]]);
                            $current_row.find('span[attr="room_school_id"]').text(data[$model_name][$room_school_id_key]);
                            $current_row.find('span[attr="room_description"]').text(data[$model_name][$room_description_key]);
                        }
                        else {
                            //var $new_row = $('<tr>', { html : $("#room_table_row_template").html().clone() });
                            var $new_row = $("#room_table_row_template").clone().removeAttr('id').removeAttr('style');
                            $new_row.find('span[attr="room_id"]').text(data[$model_name][$room_id_key]);
                            $new_row.find('span[attr="room_name"]').text(data[$model_name][$room_name_key]);
                            $new_row.find('span[attr="room_school"]').text($schools_js_map[data[$model_name][$room_school_id_key]]);
                            $new_row.find('span[attr="room_school_id"]').text(data[$model_name][$room_school_id_key]);
                            $new_row.find('span[attr="room_description"]').text(data[$model_name][$room_description_key]);
                            $('table#room_table tbody').append($new_row);
                        }
                        $('#room_management_modal').modal('hide');
                    }
                    else {
                        console.info(textStatus);
                        $('#room_management_modal').modal('hide');
                        $('#error_modal').modal('show');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#room_management_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });

        $('#submit_delete').click(function () {
            var $room_id = $('#room_delete_modal_room_id').text();
            var $paras_map = {};
            $paras_map[$room_id_key] = $room_id;

            $.ajax({
                type: "DELETE",
                url: make_request_url($room_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    $current_row.remove();
                    $('#room_delete_modal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#room_delete_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });
    });
</script>

<?php echo $this->load->view('footer'); ?>

</body>
</html>