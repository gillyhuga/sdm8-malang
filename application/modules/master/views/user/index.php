
<div class="page-button-data" id="lombok" data-url="master/user/">
<input type="hidden" id="trash" name="trash" value="<?= $this->session->userdata('___recycle_bin');?>">
    <?php if (has_permission(ADD, 'master', 'user')) { ?>
        <button id="button_create" data-url="master/user/create" type="button" class="mb-2 btn btn-icon btn-outline-primary waves-effect waves-classic button_create">
            <i class="icon md-plus" aria-hidden="true"></i> <span class="hidden-sm-down">Add New</span>
        </button>
    <?php } ?>
    <?php if(is_admin()){?>
    <button id="button_setup" data-url="master/user/setup" style="display: none;" type="button" class="mb-2 btn btn-icon btn-outline-primary waves-effect waves-classic button_setup">
        <i class="icon md-accounts-add" aria-hidden="true"></i> <span class="hidden-sm-down">Setup Permission</span>
    </button>
    <?php } ?>
    <?php if(is_admin()){?>
        <button id="button_import" data-url="master/user/import" type="button" class="mb-2 btn btn-icon btn-outline-warning waves-effect waves-classic button_import">
            <i class="icon md-download" aria-hidden="true"></i> <span class="hidden-sm-down">Import</span>
        </button>
    <?php } ?>
    <?php if(is_admin()){?>
        <button id="button_export" data-url="master/user/export" data-export="1" type="button" class="mb-2 btn btn-icon btn-outline-success waves-effect waves-classic button_export">
            <i class="icon md-file-text" aria-hidden="true"></i> <span class="hidden-sm-down">Export</span>
        </button>
    <?php } ?>
    <?php if (has_permission(EDIT, 'master', 'user')) { ?>
        <button id="button_status" data-url="master/user/status" style="display: none;" type="button" class="mb-2 btn btn-icon btn-outline-success waves-effect waves-classic button_status">
            <i class="icon md-check" aria-hidden="true"></i> <span class="hidden-sm-down">Change Status</span>
        </button>
    <?php } ?>
    <?php if (has_permission(DELETE, 'master', 'user')) { ?>
        <button id="button_bulkdestroy" data-url="master/user/bulkdestroy" style="display: none;" type="button" class="mb-2 btn btn-icon btn-outline-danger waves-effect waves-classic button_bulkdestroy">
            <i class="icon md-delete" aria-hidden="true"></i> <span class="hidden-sm-down">Bulk Delete</span>
        </button>
    <?php } ?>
    <?php if(is_superadmin()){?>
    <button id="button_bulkrestore" data-url="master/user/bulkrestore" style="display: none;" type="button" class="mb-2 btn btn-icon btn-outline-warning waves-effect waves-classic button_bulkrestore">
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
    <button id="button_refresh" data-url="master/user/index" type="button" class="mb-2 btn btn-icon btn-outline-info waves-effect waves-classic button_refresh">
        <i class="icon md-refresh" aria-hidden="true"></i>
    </button>
    <div class="page-title" style="float: right;">USER</div>
</div>
<div class="quick-link __breadcrumb mb-2">
    <strong> Quick Link :</strong>
    <a href='master/user'>Data User</a>
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
                    <th>Photo</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Hp</th>
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
                    <th>Photo</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Hp</th>
                    <th>Status</th>
                    <th style="width: 7%;">Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        var show_user = $('#show_all').DataTable({
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
                url: "<?= base_url('master/user/data_json') ?>",
                type: "POST",
                data: function(data) {}
            },
            columnDefs: [{
                targets: [0, 1,-1],
                orderable: false,
            }],
        });

        // --------------------------------------------------------------------------------------------------------[Websocket start]
        var socket = new WebSocket(WEBSOCKET_URL);
        socket.onopen = function(e) {
            socket.send("");
        };

        socket.onmessage = function(e) {
            if(e.data == 'master_user'){
                show_user.ajax.reload(null, false);
            }
        };
        // --------------------------------------------------------------------------------------------------------[Websocket stop]
    });
</script>
        