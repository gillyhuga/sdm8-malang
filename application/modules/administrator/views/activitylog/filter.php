
<form action="" id="form_filter">
    <input type="hidden" name="ss_filter" value="2">
    <div class="row mt-2">
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Uuid</small>
            <input type="hidden" id="_uuid" value="<?= $this->session->userdata('___uuid')?>">
            <input type="text" class="form-control" id="___uuid" name="___uuid" placeholder="Uuid">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Role</small>
            <input type="hidden" id="_role" value="<?= $this->session->userdata('___role')?>">
            <input type="text" class="form-control" id="___role" name="___role" placeholder="Role">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Fullname</small>
            <input type="hidden" id="_fullname" value="<?= $this->session->userdata('___fullname')?>">
            <input type="text" class="form-control" id="___fullname" name="___fullname" placeholder="Fullname">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Email</small>
            <input type="hidden" id="_email" value="<?= $this->session->userdata('___email')?>">
            <input type="text" class="form-control" id="___email" name="___email" placeholder="Email">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Modular</small>
            <input type="hidden" id="_modular" value="<?= $this->session->userdata('___modular')?>">
            <input type="text" class="form-control" id="___modular" name="___modular" placeholder="Modular">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Module</small>
            <input type="hidden" id="_module" value="<?= $this->session->userdata('___module')?>">
            <input type="text" class="form-control" id="___module" name="___module" placeholder="Module">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Action</small>
            <input type="hidden" id="_action" value="<?= $this->session->userdata('___action')?>">
            <input type="text" class="form-control" id="___action" name="___action" placeholder="Action">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Response</small>
            <input type="hidden" id="_response" value="<?= $this->session->userdata('___response')?>">
            <input type="text" class="form-control" id="___response" name="___response" placeholder="Response">
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
    var _uuid = $('#_uuid').val();
    $('#___uuid').val(_uuid);
    $('#___uuid').autocomplete({
        source: 'administrator/activitylog/get_filter_by_uuid',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="uuid"]').val(ui.item.label);
        }
    });
    var _role = $('#_role').val();
    $('#___role').val(_role);
    $('#___role').autocomplete({
        source: 'administrator/activitylog/get_filter_by_role',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="role"]').val(ui.item.label);
        }
    });
    var _fullname = $('#_fullname').val();
    $('#___fullname').val(_fullname);
    $('#___fullname').autocomplete({
        source: 'administrator/activitylog/get_filter_by_fullname',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="fullname"]').val(ui.item.label);
        }
    });
    var _email = $('#_email').val();
    $('#___email').val(_email);
    $('#___email').autocomplete({
        source: 'administrator/activitylog/get_filter_by_email',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="email"]').val(ui.item.label);
        }
    });
    var _modular = $('#_modular').val();
    $('#___modular').val(_modular);
    $('#___modular').autocomplete({
        source: 'administrator/activitylog/get_filter_by_modular',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="modular"]').val(ui.item.label);
        }
    });
    var _module = $('#_module').val();
    $('#___module').val(_module);
    $('#___module').autocomplete({
        source: 'administrator/activitylog/get_filter_by_module',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="module"]').val(ui.item.label);
        }
    });
    var _action = $('#_action').val();
    $('#___action').val(_action);
    $('#___action').autocomplete({
        source: 'administrator/activitylog/get_filter_by_action',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="action"]').val(ui.item.label);
        }
    });
    var _response = $('#_response').val();
    $('#___response').val(_response);
    $('#___response').autocomplete({
        source: 'administrator/activitylog/get_filter_by_response',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="response"]').val(ui.item.label);
        }
    });
</script>