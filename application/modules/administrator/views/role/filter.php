
<form action="" id="form_filter">
    <input type="hidden" name="ss_filter" value="2">
    <div class="row mt-2">
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Name</small>
            <input type="hidden" id="_name" value="<?= $this->session->userdata('___name')?>">
            <input type="text" class="form-control" id="___name" name="___name" placeholder="Name">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Is Default</small>
            <select class="form-control select2" id="___is_default" name="___is_default" style="width:100%;">
                <option value="">Select</option>
                <option value="1" <?php if($this->session->userdata('___is_default') === '1'){ echo 'selected="selected"'; } ?>>Yes</option>
                <option value="0" <?php if($this->session->userdata('___is_default') === '0'){ echo 'selected="selected"'; } ?>>No</option>
            </select>
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Is Superadmin</small>
            <select class="form-control select2" id="___is_superadmin" name="___is_superadmin" style="width:100%;">
                <option value="">Select</option>
                <option value="1" <?php if($this->session->userdata('___is_superadmin') === '1'){ echo 'selected="selected"'; } ?>>Yes</option>
                <option value="0" <?php if($this->session->userdata('___is_superadmin') === '0'){ echo 'selected="selected"'; } ?>>No</option>
            </select>
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Note</small>
            <input type="hidden" id="_note" value="<?= $this->session->userdata('___note')?>">
            <input type="text" class="form-control" id="___note" name="___note" placeholder="Note">
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

    var _name = $('#_name').val();
    $('#___name').val(_name);
    $('#___name').autocomplete({
        source: 'administrator/role/get_filter_by_name',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="name"]').val(ui.item.label);
        }
    });
    var _note = $('#_note').val();
    $('#___note').val(_note);
    $('#___note').autocomplete({
        source: 'administrator/role/get_filter_by_note',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="note"]').val(ui.item.label);
        }
    });
</script>