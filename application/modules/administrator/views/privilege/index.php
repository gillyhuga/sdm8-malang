
<div class="page-button-data" id="lombok" data-url="administrator/privilege/">
    <input type="hidden" id="trash" name="trash" value="<?= $this->session->userdata('___recycle_bin');?>">
    <?php if(is_admin()){?>
        <button id="button_export" data-url="administrator/privilege/export" data-export="1" type="button" class="mb-2 btn btn-icon btn-outline-success waves-effect waves-classic button_export">
            <i class="icon md-file-text" aria-hidden="true"></i> <span class="hidden-sm-down">Export</span>
        </button>
    <?php } ?>
    <?php if (has_permission(EDIT, 'administrator', 'privilege')) { ?>
        <button id="button_status" data-url="administrator/privilege/status" style="display: none;" type="button" class="mb-2 btn btn-icon btn-outline-success waves-effect waves-classic button_status">
            <i class="icon md-check" aria-hidden="true"></i> <span class="hidden-sm-down">Change Status</span>
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
    <button id="button_refresh" data-url="administrator/privilege/index" type="button" class="mb-2 btn btn-icon btn-outline-info waves-effect waves-classic button_refresh">
        <i class="icon md-refresh" aria-hidden="true"></i>
    </button>
    <div class="page-title" style="float: right;">PRIVILEGE</div>
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
                    <th>No</th>
                    <th>Photo</th>
                    <th>Fullname</th>
                    <th>Role </th>
                    <th>Email</th>
                    <th>Permission Reset At</th>
                    <th>Permission Reset By</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Photo</th>
                    <th>Fullname</th>
                    <th>Role </th>
                    <th>Email</th>
                    <th>Permission Reset At</th>
                    <th>Permission Reset By</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        var show_privilege = $('#show_all').DataTable({
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
                url: "<?= base_url('administrator/privilege/data_json') ?>",
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
            if(e.data == 'administrator_privilege'){
                show_privilege.ajax.reload(null, false);
            }
        };
        // --------------------------------------------------------------------------------------------------------[Websocket stop]
    });
</script>
        