
<form action="" id="form_filter">
    <input type="hidden" name="ss_filter" value="2">
    <div class="row mt-2">
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Fullname</small>
            <input type="hidden" id="_fullname" value="<?= $this->session->userdata('___fullname')?>">
            <input type="text" class="form-control" id="___fullname" name="___fullname" placeholder="Fullname">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Username</small>
            <input type="hidden" id="_username" value="<?= $this->session->userdata('___username')?>">
            <input type="text" class="form-control" id="___username" name="___username" placeholder="Username">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Role </small>
            <input type="hidden" id="_role_id" value="<?= $this->session->userdata('___role_id')?>">
            <select class="form-control select_data ___role_id" name="___role_id" id="___role_id" style="width: 100%;">
                <option value="">Select</option>
            </select>
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Email</small>
            <input type="hidden" id="_email" value="<?= $this->session->userdata('___email')?>">
            <input type="text" class="form-control" id="___email" name="___email" placeholder="Email">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Is Login</small>
            <select class="form-control select2" id="___is_login" name="___is_login" style="width:100%;">
                <option value="">Select</option>
                <option value="1" <?php if($this->session->userdata('___is_login') === '1'){ echo 'selected="selected"'; } ?>>Yes</option>
                <option value="0" <?php if($this->session->userdata('___is_login') === '0'){ echo 'selected="selected"'; } ?>>No</option>
            </select>
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Last Logged In</small>
            <input type="text" class="form-control showCalRanges" id="___last_logged_in" name="___last_logged_in" placeholder="Last Logged In">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Last Logged Out</small>
            <input type="text" class="form-control showCalRanges" id="___last_logged_out" name="___last_logged_out" placeholder="Last Logged Out">
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

    $('.showCalRanges').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                'month').endOf(
                'month')]
        },
        alwaysShowCalendars: true,
        autoUpdateInput: false,
    });
    $('.showCalRanges').on('apply.daterangepicker', function(ev, picker) {
        // $(this).val(picker.startDate.format('L'));
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
            'MM/DD/YYYY'));
    });
    $('.showCalRanges').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
    var _fullname = $('#_fullname').val();
    $('#___fullname').val(_fullname);
    $('#___fullname').autocomplete({
        source: 'administrator/online/get_filter_by_fullname',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="fullname"]').val(ui.item.label);
        }
    });
    var _username = $('#_username').val();
    $('#___username').val(_username);
    $('#___username').autocomplete({
        source: 'administrator/online/get_filter_by_username',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="username"]').val(ui.item.label);
        }
    });
    var _role_id = $('#_role_id').val();
    $.ajax({
        url: "<?= base_url('administrator/online/edit_filter_by_role_id') ?>",
        dataType: 'JSON',
        type : 'POST',
        data: {
            _role_id : _role_id
        },
        success : function(reseponse){
            if(reseponse != null){
                $("#___role_id").html('<option value = "'+reseponse.id+'" selected >'+reseponse.name+'</option>');
            }
        }
    });
    $("#___role_id").select2({
        ajax: {
            url: "<?= base_url('administrator/online/get_filter_by_role_id') ?>",
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
    
    
    var _email = $('#_email').val();
    $('#___email').val(_email);
    $('#___email').autocomplete({
        source: 'administrator/online/get_filter_by_email',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="email"]').val(ui.item.label);
        }
    });
</script>