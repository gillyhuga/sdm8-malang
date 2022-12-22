
<form action="" id="form_filter">
    <input type="hidden" name="ss_filter" value="2">
    <div class="row mt-2">

        <!--[ 1 ] ----------------------------------------------------------------------------------------------------------------------------------------------------------------- [ kategori ]-->
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic">Kategori</small>
            <?php $kategoris = $this->galeri->get_list('fr_kategori_berita', array('status' => 1), '', '', '', 'id', 'ASC'); ?>
            <select class="form-control select2" name="___kategori" id="___kategori" placeholder="Kategori" style="width: 100%;">
                <?php foreach ($kategoris as $key => $obj) { ?>
                    <option value="">Select</option>
                    <option value="<?= $obj->id; ?>"<?php if($obj->id == $this->session->userdata('___kategori')){ echo 'selected="selected"';}?>><?= $obj->nama; ?></option>
                <?php } ?>
            </select>
        </div>

        <!--[ 2 ] ----------------------------------------------------------------------------------------------------------------------------------------------------------------- [ deskripsi ]-->
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic">Deskripsi</small>
            <input type="hidden" id="__deskripsi" value="<?= $this->session->userdata('___deskripsi') ?>">
            <input class="form-control" type="text" id="___deskripsi" name="___deskripsi" placeholder="Deskripsi">
        </div>

        <!--[ 3 ] ----------------------------------------------------------------------------------------------------------------------------------------------------------------- [ tanggal ]-->
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic">Tanggal Start </small>
            <?php if($this->session->userdata('___start_tanggal') != ''){ ?>
                <input type="text" class="form-control datepicker" id="___start_tanggal" name="___start_tanggal" value="<?= date('d F, Y', strtotime($this->session->userdata('___start_tanggal'))); ?>" placeholder="Tanggal End">
            <?php } else { ?>
                <input type="text" class="form-control datepicker" id="___start_tanggal" name="___start_tanggal"  placeholder="Tanggal Start">
            <?php } ?>
        </div>
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic">Tanggal End</small>
            <?php if($this->session->userdata('___end_tanggal') != ''){ ?>
                <input type="text" class="form-control datepicker" id="___end_tanggal" name="___end_tanggal" value="<?= date('d F, Y', strtotime($this->session->userdata('___end_tanggal'))); ?>" placeholder="Tanggal End">
            <?php } else { ?>
                <input type="text" class="form-control datepicker" id="___end_tanggal" name="___end_tanggal"  placeholder="Tanggal Start">
            <?php } ?>
        </div>

        <!--[ 4 ] ----------------------------------------------------------------------------------------------------------------------------------------------------------------- [ note ]-->
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic">Note</small>
            <input type="hidden" id="__note" value="<?= $this->session->userdata('___note') ?>">
            <input class="form-control" type="text" id="___note" name="___note" placeholder="Note">
        </div>
    </div>
    <button type="button" class="btn btn-icon btn-primary waves-effect waves-classic" onclick="save_filter()">Apply</button>
    <button type="reset" class="btn btn-icon btn-success waves-effect waves-classic" onclick="filter_reset()">Reset</button>
    <button type="button" class="btn btn-default btn-outline" data-dismiss="modal">Close</button>
</form>

<style>
    .popover {
        z-index: 999999;
    }
    .ui-autocomplete { 
        z-index: 9999999 !important; 
    }
</style>

<script>
    $(document).ready(function() {
    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ select2 ]
    $('.select2').select2({
        placeholder: "Select",
        allowClear: true
    });


    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ Default deskripsi ]
    var __deskripsi = $('#__deskripsi').val();
    $('#___deskripsi').val(__deskripsi);
    var __deskripsi = $('#__deskripsi').val();
    $('#___deskripsi').val(__deskripsi);
    
    $('#___deskripsi').autocomplete({
        source: 'kesiswaan/galeri/get_deskripsi',
        autoFocus:true,
        select: function(event, ui){
            $('[name="___deskripsi"]').val(ui.item.label);
        }
    });


    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ Date tanggal ]
    var year = (new Date).getFullYear();
    $('.datepicker').daterangepicker({
        autoUpdateInput: false,
        locale: {
            format: 'DD MMMM YYYY',
        },
        singleDatePicker: true,
        showDropdowns: true,
        drops: "down",
        maxDate: new Date(year+10, 11, 31)
    });
    $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD MMMM YYYY'));
    });
    $('.datepicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });


    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ Default note ]
    var __note = $('#__note').val();
    $('#___note').val(__note);
    var __note = $('#__note').val();
    $('#___note').val(__note);
    
    $('#___note').autocomplete({
        source: 'kesiswaan/galeri/get_note',
        autoFocus:true,
        select: function(event, ui){
            $('[name="___note"]').val(ui.item.label);
        }
    });        
    })
</script>