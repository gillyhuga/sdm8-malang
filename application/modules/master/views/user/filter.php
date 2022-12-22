
<form action="" id="form_filter">
    <input type="hidden" name="ss_filter" value="2">
    <div class="row mt-2">
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Role</small>
            <input type="hidden" id="_role" value="<?= $this->session->userdata('___role')?>">
            <select class="form-control select_data ___role" name="___role" id="___role" style="width: 100%;">
                <option value="">Select</option>
            </select>
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Email</small>
            <input type="hidden" id="_email" value="<?= $this->session->userdata('___email')?>">
            <input type="text" class="form-control" id="___email" name="___email" placeholder="Email">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Nama</small>
            <input type="hidden" id="_nama" value="<?= $this->session->userdata('___nama')?>">
            <input type="text" class="form-control" id="___nama" name="___nama" placeholder="Nama">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Jenis Kelamin</small>
            <select class="form-control select2" id="___jenis_kelamin" name="___jenis_kelamin" style="width:100%;">
                <option value="">Select</option>
                <option value="1" <?php if($this->session->userdata('___jenis_kelamin') === '1'){ echo 'selected="selected"'; } ?>>Yes</option>
                <option value="0" <?php if($this->session->userdata('___jenis_kelamin') === '0'){ echo 'selected="selected"'; } ?>>No</option>
            </select>
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Hp</small>
            <input type="number" class="form-control" id="___hp" name="___hp" placeholder="Hp">
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Alamat</small>
            <input type="hidden" id="_alamat" value="<?= $this->session->userdata('___alamat')?>">
            <input type="text" class="form-control" id="___alamat" name="___alamat" placeholder="Alamat">
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

    var _role = $('#_role').val();
    $.ajax({
        url: "<?= base_url('master/user/edit_filter_by_role') ?>",
        dataType: 'JSON',
        type : 'POST',
        data: {
            _role : _role
        },
        success : function(reseponse){
            if(reseponse != null){
                $("#___name").html('<option value = "'+reseponse.role+'" selected >'+reseponse.role+'</option>');
            }
        }
    });

    $("#___role").select2({
        ajax: {
            url: "<?= base_url('master/user/get_filter_by_role') ?>",
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
        source: 'master/user/get_filter_by_email',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="email"]').val(ui.item.label);
        }
    });
    var _nama = $('#_nama').val();
    $('#___nama').val(_nama);
    $('#___nama').autocomplete({
        source: 'master/user/get_filter_by_nama',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="nama"]').val(ui.item.label);
        }
    });
    var _hp = $('#_hp').val();
    $('#___hp').val(_hp);
    $('#___hp').autocomplete({
        source: 'master/user/get_filter_by_hp',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="hp"]').val(ui.item.label);
        }
    });
    var _alamat = $('#_alamat').val();
    $('#___alamat').val(_alamat);
    $('#___alamat').autocomplete({
        source: 'master/user/get_filter_by_alamat',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui){
            $('[name="alamat"]').val(ui.item.label);
        }
    });
</script>