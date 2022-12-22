<form action="" id="form_filter">
    <input type="hidden" name="ss_filter" value="1">
    <div class="row mt-2">
        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic"">Created at</small>
            <?php if ($this->session->userdata('___created_start') != '') { ?>
                <input type=" text" class="form-control showCalRanges" id="___created_at" name="___created_at" value="<?= date('m/d/Y', strtotime($this->session->userdata('___created_start'))) . ' - ' . date('m/d/Y', strtotime($this->session->userdata('___created_end'))) ?>" placeholder="Created at">
            <?php } else { ?>
                <input type="text" class="form-control showCalRanges" id="___created_at" name="___created_at" placeholder="Created at">
            <?php } ?>
        </div>

        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic">Created by</small>
            <?php if ($this->session->userdata('___created_by') != '') { ?>
                <?php $created_by = $this->db->get_where('users', array('id' => $this->session->userdata('___created_by')))->row();  ?>
                <select class="form-control select_user" name="___created_by" id="___created_by" style="width: 100%;">
                    <option value="<?= $created_by->id ?>" selected="selected"><?= $created_by->email ?></option>
                </select>
            <?php } else { ?>
                <select class="form-control select_user" name="___created_by" id="___created_by" style="width: 100%;">
                </select>
            <?php } ?>
        </div>

        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic">Modified at</small>
            <?php if ($this->session->userdata('___modified_start') != '') { ?>
                <input type="text" class="form-control showCalRanges" id="___modified_at" name="___modified_at" value="<?= date('m/d/Y', strtotime($this->session->userdata('___modified_start'))) . ' - ' . date('m/d/Y', strtotime($this->session->userdata('___modified_end'))) ?>" placeholder="Created at">
            <?php } else { ?>
                <input type="text" class="form-control showCalRanges" id="___modified_at" name="___modified_at" placeholder="Modified at">
            <?php } ?>
        </div>

        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic">Modified by</small>
            <?php if ($this->session->userdata('___modified_by') != '') { ?>
                <?php $modified_by = $this->db->get_where('users', array('id' => $this->session->userdata('___modified_by')))->row();  ?>
                <select class="form-control select_user" name="___modified_by" id="___modified_by" style="width: 100%;">
                    <option value="<?= $modified_by->id ?>" selected="selected"><?= $modified_by->email ?></option>
                </select>
            <?php } else { ?>
                <select class="form-control select_user" name="___modified_by" id="___modified_by" style="width: 100%;">
                </select>
            <?php } ?>
        </div>

        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic">Deleted at</small>
            <?php if ($this->session->userdata('___deleted_start') != '') { ?>
                <input type="text" class="form-control showCalRanges" id="___deleted_at" name="___deleted_at" value="<?= date('m/d/Y', strtotime($this->session->userdata('___deleted_start'))) . ' - ' . date('m/d/Y', strtotime($this->session->userdata('___deleted_end'))) ?>" placeholder="Deleted at">
            <?php } else { ?>
                <input type="text" class="form-control showCalRanges" id="___deleted_at" name="___deleted_at" placeholder="Deleted at">
            <?php } ?>
        </div>

        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic">Deleted by</small>
            <?php if ($this->session->userdata('___deleted_by') != '') { ?>
                <?php $deleted_by = $this->db->get_where('users', array('id' => $this->session->userdata('___deleted_by')))->row();  ?>
                <select class="form-control select_user" name="___deleted_by" id="___deleted_by" style="width: 100%;">
                    <option value="<?= $deleted_by->id ?>" selected="selected"><?= $deleted_by->email ?></option>
                </select>
            <?php } else { ?>
                <select class="form-control select_user" name="___deleted_by" id="___deleted_by" style="width: 100%;">
                </select>
            <?php } ?>
        </div>

        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic">Restored at</small>
            <?php if ($this->session->userdata('___restored_start') != '') { ?>
                <input type="text" class="form-control showCalRanges" id="___restored_at" name="___restored_at" value="<?= date('m/d/Y', strtotime($this->session->userdata('___restored_start'))) . ' - ' . date('m/d/Y', strtotime($this->session->userdata('___restored_end'))) ?>" placeholder="Restored at">
            <?php } else { ?>
                <input type="text" class="form-control showCalRanges" id="___restored_at" name="___restored_at" placeholder="Restored at">
            <?php } ?>
        </div>
        <div class="col-6 form-group">
            <!-- <small class="badge badge-default">Restored by</small> -->
            <label for="" class="btn btn-xs btn-icon btn-default waves-effect waves-classic">Restored by</label>
            <?php if ($this->session->userdata('___restored_by') != '') { ?>
                <?php $restored_by = $this->db->get_where('users', array('id' => $this->session->userdata('___restored_by')))->row();  ?>
                <select class="form-control select_user" name="___restored_by" id="___restored_by" style="width: 100%;">
                    <option value="<?= $restored_by->id ?>" selected="selected"><?= $restored_by->email ?></option>
                </select>
            <?php } else { ?>
                <select class="form-control select_user" name="___restored_by" id="___restored_by" style="width: 100%;">
                    <option value="">Select</option>
                </select>
            <?php } ?>
        </div>

        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic">Status</small>
            <select class="form-control select2" name="___status" id="___status" style="width: 100%;">
                <option value="">Select</option>
                <option value="1" <?php if($this->session->userdata('___status') === '1'){ echo 'selected="selected"'; } ?>>Active</option>
                <option value="0" <?php if($this->session->userdata('___status') === '0'){ echo 'selected="selected"'; } ?>>Not Active</option>
            </select>
        </div>

        <div class="col-6 form-group">
            <small class="btn btn-xs btn-icon btn-default waves-effect waves-classic">Recycle bin</small>
            <select class="form-control select2" name="___recycle_bin" id="___recycle_bin" style="width: 100%;">
                <option value="">Select</option>
                <option value="1" <?php if($this->session->userdata('___recycle_bin') === '1'){ echo 'selected="selected"'; } ?>>Recycle bin</option>
                <option value="2" <?php if($this->session->userdata('___recycle_bin') === '2'){ echo 'selected="selected"'; } ?>>Restored</option>
            </select>
        </div>
    </div>
    <button type="button" class="btn btn-icon btn-primary waves-effect waves-classic" onclick="save_filter()">Apply</button>
    <button type="reset" class="btn btn-icon btn-success waves-effect waves-classic" onclick="filter_reset()">Reset</button>
    <button type="button" class="btn btn-default btn-outline" data-dismiss="modal">Close</button>
</form>



<!-- <style>
    .select_user {
        z-index: 9999999;
    }
</style> -->

<script>
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


    $('.select2').select2({
        placeholder: "Select",
        allowClear: true
    });

    $(".select_user").select2({
        ajax: {
            url: 'dashboard/get_user',
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
        placeholder: "Select",
        allowClear: true
    });
</script>