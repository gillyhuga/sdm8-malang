
<form action="" id="form_filter">
    <input type="hidden" name="ss_filter" value="2">
    <div class="row mt-2">
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Module Name</small>
            <input type="hidden" id="_module_name" value="<?= $this->session->userdata('___module_name')?>">
            <input type="text" class="form-control" id="___module_name" name="___module_name" placeholder="Module Name">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Module Slug</small>
            <input type="hidden" id="_module_slug" value="<?= $this->session->userdata('___module_slug')?>">
            <input type="text" class="form-control" id="___module_slug" name="___module_slug" placeholder="Module Slug">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Module Icon</small>
            <input type="hidden" id="_module_icon" value="<?= $this->session->userdata('___module_icon')?>">
            <input type="text" class="form-control" id="___module_icon" name="___module_icon" placeholder="Module Icon">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Module Order</small>
            <input type="number" class="form-control" id="___module_order" name="___module_order" placeholder="Module Order">
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
    var _module_name = $('#_module_name').val();
    $('#___module_name').val(_module_name);
    $('#___module_name').autocomplete({
        source: 'administrator/module/get_filter_by_module_name',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="module_name"]').val(ui.item.label);
        }
    });
    var _module_slug = $('#_module_slug').val();
    $('#___module_slug').val(_module_slug);
    $('#___module_slug').autocomplete({
        source: 'administrator/module/get_filter_by_module_slug',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="module_slug"]').val(ui.item.label);
        }
    });
    var _module_icon = $('#_module_icon').val();
    $('#___module_icon').val(_module_icon);
    $('#___module_icon').autocomplete({
        source: 'administrator/module/get_filter_by_module_icon',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="module_icon"]').val(ui.item.label);
        }
    });
    var _module_order = $('#_module_order').val();
    $('#___module_order').val(_module_order);
    $('#___module_order').autocomplete({
        source: 'administrator/module/get_filter_by_module_order',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="module_order"]').val(ui.item.label);
        }
    });
</script>