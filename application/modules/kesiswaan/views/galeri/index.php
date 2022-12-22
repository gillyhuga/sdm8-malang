
<div class="page-button-data" id="lombok" data-url="kesiswaan/galeri/">
<input type="hidden" id="trash" name="trash" value="<?= $this->session->userdata('___recycle_bin');?>">
    <?php if (has_permission(ADD, 'kesiswaan', 'galeri')) { ?>
        <button id="button_create" data-url="kesiswaan/galeri/create" type="button" class="mb-2 btn btn-icon btn-outline-primary waves-effect waves-classic button_create">
            <i class="icon md-plus" aria-hidden="true"></i> <span class="hidden-sm-down">Add New</span>
        </button>
    <?php } ?>
    <?php if(is_admin()){?>
        <button id="button_import" data-url="kesiswaan/galeri/import" type="button" class="mb-2 btn btn-icon btn-outline-warning waves-effect waves-classic button_import">
            <i class="icon md-download" aria-hidden="true"></i> <span class="hidden-sm-down">Import</span>
        </button>
    <?php } ?>
    <?php if(is_admin()){?>
        <button id="button_export" data-url="kesiswaan/galeri/export" data-export="1" type="button" class="mb-2 btn btn-icon btn-outline-success waves-effect waves-classic button_export">
            <i class="icon md-file-text" aria-hidden="true"></i> <span class="hidden-sm-down">Export</span>
        </button>
    <?php } ?>
    <?php if (has_permission(EDIT, 'kesiswaan', 'galeri')) { ?>
        <button id="button_status" data-url="kesiswaan/galeri/status" style="display: none;" type="button" class="mb-2 btn btn-icon btn-outline-success waves-effect waves-classic button_status">
            <i class="icon md-check" aria-hidden="true"></i> <span class="hidden-sm-down">Change Status</span>
        </button>
    <?php } ?>
    <?php if (has_permission(DELETE, 'kesiswaan', 'galeri')) { ?>
        <button id="button_bulkdestroy" data-url="kesiswaan/galeri/bulkdestroy" style="display: none;" type="button" class="mb-2 btn btn-icon btn-outline-danger waves-effect waves-classic button_bulkdestroy">
            <i class="icon md-delete" aria-hidden="true"></i> <span class="hidden-sm-down">Bulk Delete</span>
        </button>
    <?php } ?>
    <?php if(is_superadmin()){?>
    <button id="button_bulkrestore" data-url="kesiswaan/galeri/bulkrestore" style="display: none;" type="button" class="mb-2 btn btn-icon btn-outline-warning waves-effect waves-classic button_bulkrestore">
        <i class="icon md-time-restore" aria-hidden="true"></i> <span class="hidden-sm-down">Bulk Restore</span>
    </button>
    <?php } ?>
    <?php if(is_superadmin()){?>
        <button id="button_filter" type="button" class="mb-2 btn btn-icon btn-outline-secondary waves-effect waves-classic button_filter">
            <i class="icon md-filter-center-focus" aria-hidden="true"></i>
        </button>
    <?php } ?>
    <button id="button_filter2" type="button" class="mb-2 btn btn-icon btn-outline-secondary waves-effect waves-classic button_filter2">
        <i class="icon md-filter-list" aria-hidden="true"></i>
    </button>
    <button id="button_refresh" data-url="kesiswaan/galeri/index" type="button" class="mb-2 btn btn-icon btn-outline-info waves-effect waves-classic button_refresh">
        <i class="icon md-refresh" aria-hidden="true"></i>
    </button>
    <div class="page-title" style="float: right;">GALERI</div>
</div>
<div class="quick-link __breadcrumb mb-2">
    <strong> Quick Link :</strong>
    <a href='kesiswaan/ekstrakurukuler'>Program Ekstrakurikuler</a> || 
    <a href='kesiswaan/organiasi'> Struktur Organisasi</a> || 
    <a href='kesiswaan/komite'> Komite Sekolah</a> || 
    <a href='kesiswaan/upt'>UPT Sekolah</a> || 
    <a href='kesiswaan/alumni'>Alumni</a> || 
    <a href='kesiswaan/agenda'>Agenda</a> || 
    <a href='kesiswaan/berita'>Berita</a> || 
    <a href='kesiswaan/galeri'>Galeri</a>
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
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
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
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
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
        var show_galeri = $('#show_all').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            
            scrollX: true,
            order: [],
            lengthMenu: [
                [10, 25, 50, 100, 500],
                [10, 25, 50, 100, 500]
            ],
            ajax: {
                url: "<?= base_url('kesiswaan/galeri/data_json') ?>",
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