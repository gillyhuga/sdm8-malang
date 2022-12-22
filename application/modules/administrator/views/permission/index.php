
<div class="page-button-data" id="lombok" data-url="administrator/permission/">
    <input type="hidden" id="trash" name="trash" value="<?= $this->session->userdata('___recycle_bin');?>">
    <button id="button_refresh" data-url="administrator/permission/index" type="button" class="mb-2 btn btn-icon btn-outline-info waves-effect waves-classic button_refresh">
        <i class="icon md-refresh" aria-hidden="true"></i>
    </button>
    <div class="page-title" style="float: right;">PERMISSION</div>
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
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Is Default</th>
                    <th>Is Superadmin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Is Default</th>
                    <th>Is Superadmin</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        var show_permission = $('#show_all').DataTable({
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
                url: "<?= base_url('administrator/permission/data_json') ?>",
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
            if(e.data == 'administrator_permission'){
                show_permission.ajax.reload(null, false);
            }
        };
        // --------------------------------------------------------------------------------------------------------[Websocket stop]
    });
</script>
        