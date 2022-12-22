
<div class="page-button-data" id="lombok" data-url="administrator/module/">
    <input type="hidden" id="trash" name="trash" value="<?= $this->session->userdata('___recycle_bin');?>">
    <?php if (has_permission(ADD, 'administrator', 'module')) { ?>
        <button id="button_create" data-url="administrator/module/create" type="button" class="mb-2 btn btn-icon btn-outline-primary waves-effect waves-classic button_create">
            <i class="icon md-plus" aria-hidden="true"></i> <span class="hidden-sm-down">Add New</span>
        </button>
    <?php } ?>
    <?php if(is_admin()){?>
        <button id="button_import" data-url="administrator/module/import" type="button" class="mb-2 btn btn-icon btn-outline-warning waves-effect waves-classic button_import">
            <i class="icon md-download" aria-hidden="true"></i> <span class="hidden-sm-down">Import</span>
        </button>
    <?php } ?>
    <?php if(is_admin()){?>
        <button id="button_export" data-url="administrator/module/export" data-export="1" type="button" class="mb-2 btn btn-icon btn-outline-success waves-effect waves-classic button_export">
            <i class="icon md-file-text" aria-hidden="true"></i> <span class="hidden-sm-down">Export</span>
        </button>
    <?php } ?>
    <?php if (has_permission(EDIT, 'administrator', 'module')) { ?>
        <button id="button_status" data-url="administrator/module/status" style="display: none;" type="button" class="mb-2 btn btn-icon btn-outline-success waves-effect waves-classic button_status">
            <i class="icon md-check" aria-hidden="true"></i> <span class="hidden-sm-down">Change Status</span>
        </button>
    <?php } ?>
    <?php if (has_permission(DELETE, 'administrator', 'module')) { ?>
        <button id="button_bulkdestroy" data-url="administrator/module/bulkdestroy" style="display: none;" type="button" class="mb-2 btn btn-icon btn-outline-danger waves-effect waves-classic button_bulkdestroy">
            <i class="icon md-delete" aria-hidden="true"></i> <span class="hidden-sm-down">Bulk Delete</span>
        </button>
    <?php } ?>
    <?php if(is_superadmin()){?>
    <button id="button_bulkrestore" data-url="administrator/module/bulkrestore" style="display: none;" type="button" class="mb-2 btn btn-icon btn-outline-warning waves-effect waves-classic button_bulkrestore">
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
    <button id="button_refresh" data-url="administrator/module/index" type="button" class="mb-2 btn btn-icon btn-outline-info waves-effect waves-classic button_refresh">
        <i class="icon md-refresh" aria-hidden="true"></i>
    </button>
    <div class="page-title" style="float: right;">MODULE</div>
</div>
<div class="quick-link __breadcrumb mb-2">
    <strong> Quick Link :</strong>
    <a href='administrator/role'>User Role</a> || 
    <a href='administrator/module'>Module</a> || 
    <a href='administrator/operation'>Operation</a> || 
    <a href='administrator/permission'>Role Permission	</a> || 
    <a href='administrator/user'>Manage User</a> || 
    <a href='administrator/password'>Reset Password</a> || 
    <a href='administrator/email'>Reset Email</a> || 
    <a href='administrator/privilege'>Reset Permission</a> || 
    <a href='administrator/token'>Reset Token</a> || 
    <a href='administrator/online'>Online User</a> || 
    <a href='administrator/activitylog'>Activity Log</a> || 
    <a href='administrator/backup'>Backup database</a>
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
                    <th>Module Name</th>
                    <th>Module Slug</th>
                    <th>Module Icon</th>
                    <th>Module Order</th>
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
                    <th>Module Name</th>
                    <th>Module Slug</th>
                    <th>Module Icon</th>
                    <th>Module Order</th>
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
        var show_module = $('#show_all').DataTable({
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
                url: "<?= base_url('administrator/module/data_json') ?>",
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
            if(e.data == 'administrator_module'){
                show_module.ajax.reload(null, false);
            }
        };
        // --------------------------------------------------------------------------------------------------------[Websocket stop]
    });
</script>
        