
<form action="" id="form_filter">
    <input type="hidden" name="ss_filter" value="2">
    <div class="row mt-2">
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Id Module</small>
            <input type="hidden" id="_id_module" value="<?= $this->session->userdata('___id_module')?>">
            <select class="form-control select_data ___id_module" name="___id_module" id="___id_module" style="width: 100%;">
                <option value="">Select</option>
            </select>
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Operation Name</small>
            <input type="hidden" id="_operation_name" value="<?= $this->session->userdata('___operation_name')?>">
            <input type="text" class="form-control" id="___operation_name" name="___operation_name" placeholder="Operation Name">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Operation Slug</small>
            <input type="hidden" id="_operation_slug" value="<?= $this->session->userdata('___operation_slug')?>">
            <input type="text" class="form-control" id="___operation_slug" name="___operation_slug" placeholder="Operation Slug">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Order Menu</small>
            <input type="number" class="form-control" id="___order_menu" name="___order_menu" placeholder="Order Menu">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Is Menu Vissible</small>
            <select class="form-control select2" id="___is_menu_vissible" name="___is_menu_vissible" style="width:100%;">
                <option value="">Select</option>
                <option value="1" <?php if($this->session->userdata('___is_menu_vissible') === '1'){ echo 'selected="selected"'; } ?>>Yes</option>
                <option value="0" <?php if($this->session->userdata('___is_menu_vissible') === '0'){ echo 'selected="selected"'; } ?>>No</option>
            </select>
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Is View Vissible</small>
            <select class="form-control select2" id="___is_view_vissible" name="___is_view_vissible" style="width:100%;">
                <option value="">Select</option>
                <option value="1" <?php if($this->session->userdata('___is_view_vissible') === '1'){ echo 'selected="selected"'; } ?>>Yes</option>
                <option value="0" <?php if($this->session->userdata('___is_view_vissible') === '0'){ echo 'selected="selected"'; } ?>>No</option>
            </select>
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Is Add Vissible</small>
            <select class="form-control select2" id="___is_add_vissible" name="___is_add_vissible" style="width:100%;">
                <option value="">Select</option>
                <option value="1" <?php if($this->session->userdata('___is_add_vissible') === '1'){ echo 'selected="selected"'; } ?>>Yes</option>
                <option value="0" <?php if($this->session->userdata('___is_add_vissible') === '0'){ echo 'selected="selected"'; } ?>>No</option>
            </select>
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Is Edit Vissible</small>
            <select class="form-control select2" id="___is_edit_vissible" name="___is_edit_vissible" style="width:100%;">
                <option value="">Select</option>
                <option value="1" <?php if($this->session->userdata('___is_edit_vissible') === '1'){ echo 'selected="selected"'; } ?>>Yes</option>
                <option value="0" <?php if($this->session->userdata('___is_edit_vissible') === '0'){ echo 'selected="selected"'; } ?>>No</option>
            </select>
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Is Delete Vissible</small>
            <select class="form-control select2" id="___is_delete_vissible" name="___is_delete_vissible" style="width:100%;">
                <option value="">Select</option>
                <option value="1" <?php if($this->session->userdata('___is_delete_vissible') === '1'){ echo 'selected="selected"'; } ?>>Yes</option>
                <option value="0" <?php if($this->session->userdata('___is_delete_vissible') === '0'){ echo 'selected="selected"'; } ?>>No</option>
            </select>
        </div>
    </div>
    <button type="button" class="btn btn-icon btn-primary waves-effect waves-classic" onclick="save_filter()">Apply</button>
    <button type="reset" class="btn btn-icon btn-success waves-effect waves-classic" onclick="filter_reset()">Reset</button>
    <button type="button" class="btn btn-default btn-outline" data-dismiss="modal">Close</button>
</form>
<style>
    .ui-autocomplete {
         z-index:2147483647; 
    }
</style>
<script>
    $('.select2').select2({
        placeholder: "Select",
        allowClear: true
    });

    var _id_module = $('#_id_module').val();
    $.ajax({
        url: "<?= base_url('administrator/operation/edit_filter_by_id_module') ?>",
        dataType: 'JSON',
        type : 'POST',
        data: {
            _id_module : _id_module
        },
        success : function(reseponse){
            if(reseponse != null){
                $("#___name").html('<option value = "'+reseponse.id_module+'" selected >'+reseponse.id_module+'</option>');
            }
        }
    });

    $("#___id_module").select2({
        ajax: {
            url: "<?= base_url('administrator/operation/get_filter_by_id_module') ?>",
            dataType: 'JSON',
            type: "GET",
            delay: 250,
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                return {
                    results: data,
                };
            },
            cache: true
        },
        // minimumInputLength: 2,
        placeholder: "Select",
        allowClear: true
    });
    
    
    var _operation_name = $('#_operation_name').val();
    $('#___operation_name').val(_operation_name);
    $('#___operation_name').autocomplete({
        source: 'administrator/operation/get_filter_by_operation_name',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="operation_name"]').val(ui.item.label);
        }
    });
    var _operation_slug = $('#_operation_slug').val();
    $('#___operation_slug').val(_operation_slug);
    $('#___operation_slug').autocomplete({
        source: 'administrator/operation/get_filter_by_operation_slug',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="operation_slug"]').val(ui.item.label);
        }
    });
    var _order_menu = $('#_order_menu').val();
    $('#___order_menu').val(_order_menu);
    $('#___order_menu').autocomplete({
        source: 'administrator/operation/get_filter_by_order_menu',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="order_menu"]').val(ui.item.label);
        }
    });
</script>