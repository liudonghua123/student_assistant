<!DOCTYPE html>
<html>
<head>
    <?php echo $this->load->view('head', array('title' => lang('schedule_times_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
    <div class="row">

        <div class="col-md-2">
            <?php echo $this->load->view('account/account_menu', array('current' => 'manage_schedule_times')); ?>
        </div>

        <div class="col-md-10">

            <h2><?php echo lang('schedule_times_page_name'); ?></h2>

            <div class="well">
                <?php echo lang('schedule_times_page_description'); ?>
            </div>

            <table id="schedule_time_table" class="table table-condensed table-hover">
                <thead>
                <tr>
                    <th><?php echo lang('schedule_times_column_id'); ?></th>
                    <th><?php echo lang('schedule_times_column_schedule_profile'); ?></th>
                    <th><?php echo lang('schedule_times_column_start_time'); ?></th>
                    <th><?php echo lang('schedule_times_column_end_time'); ?></th>
                    <th><?php echo lang('schedule_times_column_schedule_no'); ?></th>
                    <th>
                        <button id="schedule_time_create" type="button" class="btn btn-default btn-primary btn-small" ><i class="fa fa-file-o"></i> <?php echo lang('website_create'); ?></button>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach( $schedule_times as $schedule_time ) : ?>
                    <tr>
                        <td>
                            <span attr="schedule_time_id"><?php echo $schedule_time->id; ?></span>
                        </td>
                        <td>
                            <span attr="schedule_time_schedule_profile"><?php echo utils::get_schedule_profile_name($schedule_profiles, $schedule_time->schedule_profile_id); ?></span>
                            <span attr="schedule_time_schedule_profile_id" style="display: none"><?php echo $schedule_time->schedule_profile_id; ?></span>
                        </td>
                        <td>
                            <span attr="schedule_time_start_time"><?php echo $schedule_time->start_time; ?></span>
                        </td>
                        <td>
                            <span attr="schedule_time_end_time"><?php echo $schedule_time->end_time; ?></span>
                        </td>
                        <td>
                            <span attr="schedule_time_schedule_no"><?php echo $schedule_time->schedule_no; ?></span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-default btn-small"attr="schedule_time_update" ><i class="fa fa-edit"></i> <?php echo lang('website_update'); ?></button>
                            <button type="button" class="btn btn-default btn-small" attr="schedule_time_delete" ><i class="fa fa-trash"></i> <?php echo lang('website_delete'); ?></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr id="schedule_time_table_row_template" style="display: none">
                    <td>
                        <span attr="schedule_time_id"></span>
                    </td>
                    <td>
                        <span attr="schedule_time_schedule_profile"></span>
                        <span attr="schedule_time_schedule_profile_id" style="display: none"></span>
                    </td>
                    <td>
                        <span attr="schedule_time_start_time"></span>
                    </td>
                    <td>
                        <span attr="schedule_time_end_time"></span>
                    </td>
                    <td>
                        <span attr="schedule_time_schedule_no"></span>
                    </td>
                    <td>
                        <button type="button" class="btn btn-default btn-small" attr="schedule_time_update" ><i class="fa fa-edit"></i> <?php echo lang('website_update'); ?></button>
                        <button type="button" class="btn btn-default btn-small" attr="schedule_time_delete" ><i class="fa fa-trash"></i> <?php echo lang('website_delete'); ?></button>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="schedule_time_management_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_schedule_times'); ?></h4>
                </div>
                <div class="modal-body" style="overflow-y: initial;">
                    <form class="form-horizontal" role="form">
                        <input type="hidden"  id="schedule_time_id">
                        <div class="form-group control-group">
                            <label for="schedule_profile_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('schedule_times_column_schedule_profile'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="schedule_profile_select" class="selectpicker" data-live-search="true"></select>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="schedule_start_time" class="col-sm-4 col-xs-4 control-label"><?php echo lang('schedule_times_column_start_time'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <div class="input-append bootstrap-timepicker">
                                    <input id="schedule_start_time" class="input-small" type="text"/><span class="add-on"><i class="icon-time"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="schedule_end_time" class="col-sm-4 col-xs-4 control-label"><?php echo lang('schedule_times_column_end_time'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <div class="input-append bootstrap-timepicker">
                                    <input id="schedule_end_time" class="input-small" type="text"/><span class="add-on"><i class="icon-time"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="schedule_no_select" class="col-sm-4 col-xs-4 control-label"><?php echo lang('schedule_times_column_schedule_no'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <select id="schedule_no_select" class="selectpicker"></select>
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
    <div class="modal fade" id="schedule_time_delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_schedule_times_delete'); ?></h4>
                </div>
                <div class="modal-body">
                    <span id="schedule_time_delete_modal_schedule_time_id" style="display: none" ></span>
                    <div><?php echo lang('website_manage_schedule_times_delete'); ?>
                        For <span id="schedule_time_delete_modal_schedule_time_profile"></span>
                        From<span id="schedule_time_delete_modal_schedule_time_start_time"></span>
                        To <span id="schedule_time_delete_modal_schedule_time_end_time"></span>
                        At <span id="schedule_time_delete_modal_schedule_time_schedule_no"></span>
                    </div>
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

    function update_manage_modal($schedule_time_id, $schedule_time_schedule_profile_id, $schedule_time_start_time, $schedule_time_end_time, $schedule_time_no) {
        $('#schedule_time_id').val($schedule_time_id);
        $('#schedule_profile_select').val($schedule_time_schedule_profile_id);
        $schedule_start_time_input.timepicker('setTime', $schedule_time_start_time);
        $schedule_end_time_input.timepicker('setTime', $schedule_time_end_time);
        $('#schedule_no_select').val($schedule_time_no);
    }

    $(document).ready(function() {
        var $model_name = 'schedule_time';
        var $schedule_time_id_key = 'id';
        var $schedule_time_school_id_key = 'school_id';
        var $schedule_time_institute_id_key = 'institute_id';
        var $schedule_time_schedule_profile_id_key = 'schedule_profile_id';
        var $schedule_time_start_time_key = 'start_time';
        var $schedule_time_end_time_key = 'end_time';
        var $schedule_time_schedule_no_key = 'schedule_no';
        var $schedule_time_base_url = 'api/schedule_time_mgmt/schedule_time';
        var $is_update = false;
        var $schedule_profiles_js_map = <?php echo $schedule_profiles_map ?>;
        var $schedule_no_js_map = {'1':'1','2':'2','3':'3','4':'4','5':'5','6':'6','7':'7','8':'8','9':'9','10':'10'};
        var $default_start_time = '08:00';
        var $default_end_time = '08:00';
        var $school_id = <?php echo isset($school) ? $school->id : 0 ?>;
        var $institute_id = <?php echo isset($institute) ? $institute->id : 0 ?>;

        var $current_row = $('table#schedule_time_table tbody tr:first-child');

        // add institutes to institute select
        $.map( $schedule_profiles_js_map, function( map_value, map_key ) {
            $('#schedule_profile_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });
        // add schedule_no to schedule_no select
        $.map( $schedule_no_js_map, function( map_value, map_key ) {
            $('#schedule_no_select').append($('<option>', {
                value: map_key,
                text : map_value
            }));
        });
        // set default value
        //$('#schedule_profile_select').val();
        //$('#schedule_no_select').val();

        // Enable Bootstrap-Select via JavaScript:
        $('#schedule_profile_select').selectpicker();
        $('#schedule_no_select').selectpicker();

        $schedule_start_time_input = $('#schedule_start_time').timepicker({
            minuteStep: 5,
            showSeconds: false,
            showMeridian: false,
            defaultTime: false
        });

        $schedule_end_time_input = $('#schedule_end_time').timepicker({
            minuteStep: 5,
            showSeconds: false,
            showMeridian: false,
            defaultTime: false
        });

        $('#schedule_start_time').on('changeTime.timepicker', function(e) {
            console.info(e.time.value);
        });
        $('#schedule_end_time').on('changeTime.timepicker', function(e) {
            console.info(e.time.value);
        });

        $(document).delegate('#schedule_time_create', 'click', function () {
            $is_update = false;
            update_manage_modal('','',$default_start_time,$default_end_time,'');
            $('#schedule_time_management_modal').modal('show');
        });

        $(document).delegate('button[attr="schedule_time_update"]', 'click', function () {
            $is_update = true;
            $current_row = $(this).parent().parent();
            var $schedule_time_id = $current_row.find('span[attr="schedule_time_id"]').text();
            var $schedule_time_schedule_profile_id = $current_row.find('span[attr="schedule_time_schedule_profile_id"]').text();
            var $schedule_time_start_time = $current_row.find('span[attr="schedule_time_start_time"]').text();
            var $schedule_time_end_time = $current_row.find('span[attr="schedule_time_end_time"]').text();
            var $schedule_time_schedule_no = $current_row.find('span[attr="schedule_time_schedule_no"]').text();
            update_manage_modal($schedule_time_id,$schedule_time_schedule_profile_id,$schedule_time_start_time, $schedule_time_end_time,$schedule_time_schedule_no);
            // refresh select widget
            $('#schedule_profile_select').selectpicker('refresh');
            $('#schedule_no_select').selectpicker('refresh');
            $('#schedule_time_management_modal').modal('show');
        });

        $(document).delegate('button[attr="schedule_time_delete"]', 'click', function () {
            $is_update = false;
            $current_row = $(this).parent().parent();
            var $schedule_time_id = $current_row.find('span[attr="schedule_time_id"]').text();
            var $schedule_time_schedule_profile = $current_row.find('span[attr="schedule_time_schedule_profile"]').text();
            var $schedule_time_start_time = $current_row.find('span[attr="schedule_time_start_time"]').text();
            var $schedule_time_end_time = $current_row.find('span[attr="schedule_time_end_time"]').text();
            var $schedule_time_schedule_no = $current_row.find('span[attr="schedule_time_schedule_no"]').text();
            update_manage_modal('','',$default_start_time,$default_end_time,'');
            $('#schedule_time_delete_modal_schedule_time_id').text($schedule_time_id);
            $('#schedule_time_delete_modal_schedule_time_schedule_profile').text($schedule_time_schedule_profile);
            $('#schedule_time_delete_modal_schedule_time_start_time').text($schedule_time_start_time);
            $('#schedule_time_delete_modal_schedule_time_end_time').text($schedule_time_end_time);
            $('#schedule_time_delete_modal_schedule_time_schedule_no').text($schedule_time_schedule_no);
            $('#schedule_time_delete_modal').modal('show');
        });

        $('#submit').click(function () {
            var $schedule_time_id = $('#schedule_time_id').val();
            var $schedule_time_schedule_profile_id = $('#schedule_profile_select :selected').val();
            var $schedule_time_start_time = $schedule_start_time_input.val();
            var $schedule_time_end_time = $schedule_end_time_input.val();
            var $schedule_time_schedule_no = $('#schedule_no_select :selected').val();
            // Javascript "map" (object) doesn't evaluate its keys
            //  var $paras_map = {$schedule_time_name_key : $schedule_time_name, $schedule_time_description_key : $schedule_time_description}
            var $paras_map = {};
            if($is_update) {
                $paras_map[$schedule_time_id_key] = $schedule_time_id;
            }
            $paras_map[$schedule_time_schedule_profile_id_key] = $schedule_time_schedule_profile_id;
            $paras_map[$schedule_time_school_id_key] = $school_id;
            $paras_map[$schedule_time_institute_id_key] = $institute_id;
            $paras_map[$schedule_time_start_time_key] = $schedule_time_start_time;
            $paras_map[$schedule_time_end_time_key] = $schedule_time_end_time;
            $paras_map[$schedule_time_schedule_no_key] = $schedule_time_schedule_no;
            if($is_update) {
                $paras_map[$schedule_time_id_key] = $schedule_time_id;
            }

            $.ajax({
                type: $is_update ? "POST" : "PUT",
                url: make_request_url($schedule_time_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    if(data.result == "success") {
                        if($is_update) {
                            $current_row.find('span[attr="schedule_time_id"]').text(data[$model_name][$schedule_time_id_key]);
                            $current_row.find('span[attr="schedule_time_schedule_profile"]').text($schedule_profiles_js_map[data[$model_name][$schedule_time_schedule_profile_id_key]]);
                            $current_row.find('span[attr="schedule_time_schedule_profile_id"]').text(data[$model_name][$schedule_time_schedule_profile_id_key]);
                            $current_row.find('span[attr="schedule_time_start_time"]').text(data[$model_name][$schedule_time_start_time_key]);
                            $current_row.find('span[attr="schedule_time_end_time"]').text(data[$model_name][$schedule_time_end_time_key]);
                            $current_row.find('span[attr="schedule_time_schedule_no"]').text(data[$model_name][$schedule_time_schedule_no_key]);
                        }
                        else {
                            //var $new_row = $('<tr>', { html : $("#schedule_time_table_row_template").html().clone() });
                            var $new_row = $("#schedule_time_table_row_template").clone().removeAttr('id').removeAttr('style');
                            $new_row.find('span[attr="schedule_time_id"]').text(data[$model_name][$schedule_time_id_key]);
                            $new_row.find('span[attr="schedule_time_schedule_profile"]').text($schedule_profiles_js_map[data[$model_name][$schedule_time_schedule_profile_id_key]]);
                            $new_row.find('span[attr="schedule_time_schedule_profile_id"]').text(data[$model_name][$schedule_time_schedule_profile_id_key]);
                            $new_row.find('span[attr="schedule_time_start_time"]').text(data[$model_name][$schedule_time_start_time_key]);
                            $new_row.find('span[attr="schedule_time_end_time"]').text(data[$model_name][$schedule_time_end_time_key]);
                            $new_row.find('span[attr="schedule_time_schedule_no"]').text(data[$model_name][$schedule_time_schedule_no_key]);
                            $('table#schedule_time_table tbody').append($new_row);
                        }
                        $('#schedule_time_management_modal').modal('hide');
                    }
                    else {
                        console.info(textStatus);
                        $('#schedule_time_management_modal').modal('hide');
                        $('#error_modal').modal('show');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#schedule_time_management_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });

        $('#submit_delete').click(function () {
            var $schedule_time_id = $('#schedule_time_delete_modal_schedule_time_id').text();
            var $paras_map = {};
            $paras_map[$schedule_time_id_key] = $schedule_time_id;

            $.ajax({
                type: "DELETE",
                url: make_request_url($schedule_time_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    $current_row.remove();
                    $('#schedule_time_delete_modal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#schedule_time_delete_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });
    });
</script>

<?php echo $this->load->view('footer'); ?>

</body>
</html>