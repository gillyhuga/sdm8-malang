
<div class="page-button-data" id="lombok" data-url="frontend/sambutan/">
<input type="hidden" id="trash" name="trash" value="<?= $this->session->userdata('___recycle_bin');?>">
    <?php if (has_permission(EDIT, 'frontend', 'sambutan')) { ?>
        <button id="button_status" data-url="frontend/sambutan/status" style="display: none;" type="button" class="mb-2 btn btn-icon btn-outline-success waves-effect waves-classic button_status">
            <i class="icon md-check" aria-hidden="true"></i> <span class="hidden-sm-down">Change Status</span>
        </button>
    <?php } ?>
    <?php if(is_superadmin()){?>
        <button id="button_filter" type="button" class="mb-2 btn btn-icon btn-outline-secondary waves-effect waves-classic button_filter">
            <i class="icon md-filter-center-focus" aria-hidden="true"></i>
        </button>
    <?php } ?>
    <button id="button_refresh" data-url="frontend/sambutan/index" type="button" class="mb-2 btn btn-icon btn-outline-info waves-effect waves-classic button_refresh">
        <i class="icon md-refresh" aria-hidden="true"></i>
    </button>
    <div class="page-title" style="float: right;">SAMBUTAN</div>
</div>
<div class="quick-link __breadcrumb mb-2">
    <strong> Quick Link :</strong>
    <a href='frontend/slider'>Slider</a> || 
    <a href='frontend/sambutan'>Sambutan Kepala</a> || 
    <a href='frontend/budaya'>Budaya Sekolah</a> || 
    <a href='frontend/visimisi'>Visi dan Misi</a> || 
    <a href='frontend/guru'>Guru dan Tenaga Pendidik</a> || 
    <a href='frontend/testimoni'>Testimoni</a>
</div>
<div class="panel">
    <div class="panel-body">
        <table class="table table-hover dataTable table-striped w-full nowrap" data-plugin="dataTable" id="show_all">
            <thead>
                <tr>
                    <th style="width: 2%;">
                        <div class="checkbox-custom checkbox-primary"><input type="checkbox" id="check_all"> <label for="check_all"></label></div>
                    </th>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Kepala</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th style="width: 7%;">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th style="width: 2%;">
                        <div class="checkbox-custom checkbox-primary"><input type="checkbox" id="check_all"> <label for="check_all"></label></div>
                    </th>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Kepala</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th style="width: 7%;">Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        var show_sambutan = $('#show_all').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            // responsive: true,
            scrollX: true,
            order: [],
            lengthMenu: [
                [10, 25, 50, 100, 500],
                [10, 25, 50, 100, 500]
            ],
            ajax: {
                url: "<?= base_url('frontend/sambutan/data_json') ?>",
                type: "POST",
                data: function(data) {},
            },
            columnDefs: [{
                targets: [0, 1,-1],
                orderable: false,
            }],
        });
    });
</script>