<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('majors_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="col-md-2">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_majors')); ?>
    </div>

    <div class="col-md-10">

      <h2><?php echo lang('majors_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('majors_page_description'); ?>
      </div>

      <table id="major_table" class="table table-condensed table-hover">
        <thead>
          <tr>
            <th><?php echo lang('majors_column_id'); ?></th>
            <th><?php echo lang('majors_column_name'); ?></th>
            <th><?php echo lang('majors_column_description'); ?></th>
            <th>
                <button id="major_create" type="button" class="btn btn-default btn-primary btn-small" ><i class="fa fa-file-o"></i> <?php echo lang('website_create'); ?></button>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $majors as $major ) : ?>
            <tr>
              <td>
                  <span attr="major_id"><?php echo $major->id; ?></span>
              </td>
              <td>
                  <span attr="major_name"><?php echo $major->major_name; ?></span>
              </td>
              <td>
                  <span attr="major_description"><?php echo $major->major_description; ?></span>
              </td>
                <td>
                    <button type="button" class="btn btn-default btn-small"attr="major_update" ><i class="fa fa-edit"></i> <?php echo lang('website_update'); ?></button>
                    <button type="button" class="btn btn-default btn-small" attr="major_delete" ><i class="fa fa-trash"></i> <?php echo lang('website_delete'); ?></button>
                </td>
            </tr>
          <?php endforeach; ?>
          <tr id="major_table_row_template" style="display: none">
              <td>
                  <span attr="major_id"></span>
              </td>
              <td>
                  <span attr="major_name"></span>
              </td>
              <td>
                  <span attr="major_description"></span>
              </td>
              <td>
                  <button type="button" class="btn btn-default btn-small" attr="major_update" ><i class="fa fa-edit"></i> <?php echo lang('website_update'); ?></button>
                  <button type="button" class="btn btn-default btn-small" attr="major_delete" ><i class="fa fa-trash"></i> <?php echo lang('website_delete'); ?></button>
              </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="major_management_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_majors'); ?></h4>
                </div>
                <div class="modal-body" style="overflow-y: initial;">
                    <form class="form-horizontal" role="form">
                        <input type="hidden"  id="major_id">
                        <div class="form-group control-group">
                            <label for="major_name" class="col-sm-4 col-xs-4 control-label"><?php echo lang('majors_column_name'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="major_name" placeholder="Enter major Name">
                            </div>
                        </div>
                        <div class="form-group control-group">
                            <label for="major_description" class="col-sm-4 col-xs-4 control-label"><?php echo lang('majors_column_description'); ?></label>
                            <div class="col-sm-8 col-xs-8 controls">
                                <input type="text" class="form-control input-large required" id="major_description" placeholder="Enter major Description">
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
    <div class="modal fade" id="major_delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('website_manage_majors_delete'); ?></h4>
                </div>
                <div class="modal-body">
                    <span id="major_delete_modal_major_id" style="display: none" ></span>
                    <div><?php echo lang('website_manage_majors_delete'); ?> <span id="major_delete_modal_major_name"></span></div>
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

    function update_manage_modal($major_id, $major_name, $major_description) {
        $('#major_id').val($major_id);
        $('#major_name').val($major_name);
        $('#major_description').val($major_description);
    }

    $(document).ready(function() {
        var $model_name = 'major';
        var $major_id_key = 'id';
        var $major_school_id_key = 'school_id';
        var $major_institute_id_key = 'institute_id';
        var $major_name_key = 'major_name';
        var $major_description_key = 'major_description';
        var $major_base_url = 'api/major_mgmt/major';
        var $is_update = false;
        var $school_id = <?php echo isset($school) ? $school->id : 0 ?>;
        var $institute_id = <?php echo isset($institute) ? $institute->id : 0 ?>;
        var $schools_js_map = <?php echo $schools_map ?>;

        var $current_row = $('table#major_table tbody tr:first-child');

        $(document).delegate('#major_create', 'click', function () {
            $is_update = false;
            update_manage_modal('','','');
            $('#major_management_modal').modal('show');
        });

        $(document).delegate('button[attr="major_update"]', 'click', function () {
            $is_update = true;
            $current_row = $(this).parent().parent();
            var $major_id = $current_row.find('span[attr="major_id"]').text();
            var $major_name = $current_row.find('span[attr="major_name"]').text();
            var $major_description = $current_row.find('span[attr="major_description"]').text();
            update_manage_modal($major_id,$major_name,$major_description);
            $('#major_management_modal').modal('show');
        });

        $(document).delegate('button[attr="major_delete"]', 'click', function () {
            $is_update = false;
            $current_row = $(this).parent().parent();
            var $major_id = $current_row.find('span[attr="major_id"]').text();
            var $major_name = $current_row.find('span[attr="major_name"]').text();
            var $major_description = $current_row.find('span[attr="major_description"]').text();
            update_manage_modal('','','');
            $('#major_delete_modal_major_id').text($major_id);
            $('#major_delete_modal_major_name').text($major_name);
            $('#major_delete_modal').modal('show');
        });

        $('#submit').click(function () {
            var $major_id = $('#major_id').val();
            var $major_name = $('#major_name').val();
            var $major_description = $('#major_description').val();
            // Javascript "map" (object) doesn't evaluate its keys
            //  var $paras_map = {$major_name_key : $major_name, $major_description_key : $major_description}
            var $paras_map = {};
            if($is_update) {
                $paras_map[$major_id_key] = $major_id;
            }
            $paras_map[$major_name_key] = $major_name;
            $paras_map[$major_school_id_key] = $school_id;
            $paras_map[$major_institute_id_key] = $institute_id;
            $paras_map[$major_description_key] = $major_description;

            $.ajax({
                type: $is_update ? "POST" : "PUT",
                url: make_request_url($major_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    if(data.result == "success") {
                        if($is_update) {
                            $current_row.find('span[attr="major_id"]').text(data[$model_name][$major_id_key]);
                            $current_row.find('span[attr="major_name"]').text(data[$model_name][$major_name_key]);
                            $current_row.find('span[attr="major_description"]').text(data[$model_name][$major_description_key]);
                        }
                        else {
                            //var $new_row = $('<tr>', { html : $("#major_table_row_template").html().clone() });
                            var $new_row = $("#major_table_row_template").clone().removeAttr('id').removeAttr('style');
                            $new_row.find('span[attr="major_id"]').text(data[$model_name][$major_id_key]);
                            $new_row.find('span[attr="major_name"]').text(data[$model_name][$major_name_key]);
                            $new_row.find('span[attr="major_description"]').text(data[$model_name][$major_description_key]);
                            $('table#major_table tbody').append($new_row);
                        }
                        $('#major_management_modal').modal('hide');
                    }
                    else {
                        console.info(textStatus);
                        $('#major_management_modal').modal('hide');
                        $('#error_modal').modal('show');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#major_management_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });

        $('#submit_delete').click(function () {
            var $major_id = $('#major_delete_modal_major_id').text();
            var $paras_map = {};
            $paras_map[$major_id_key] = $major_id;

            $.ajax({
                type: "DELETE",
                url: make_request_url($major_base_url, $paras_map),
                cache: false,
                success: function(data, textStatus, jqXHR){
                    $current_row.remove();
                    $('#major_delete_modal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + ':' + errorThrown);
                    $('#major_delete_modal').modal('hide');
                    $('#error_modal').modal('show');
                }
            });
        });
    });
</script>

<?php echo $this->load->view('footer'); ?>

</body>
</html>