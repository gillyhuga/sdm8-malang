
<div class="page-button-data" id="lombok" data-url="admin/user/">
    <input type="hidden" id="trash" name="trash" value="<?= $this->session->userdata('___recycle_bin');?>">
    <button id="button_export" data-url="admin/user/export" data-export="1" type="button" class="mb-2 btn btn-icon btn-outline-success waves-effect waves-classic button_export">
        <i class="icon md-file-text" aria-hidden="true"></i> <span class="hidden-sm-down">Export</span>
    </button>
    <?php if (has_permission(EDIT, 'admin', 'user')) { ?>
        <button id="button_access" data-url="admin/user/status" data-status="1" style="display: none;" type="button" class="mb-2 btn btn-icon btn-outline-success waves-effect waves-classic button_status">
            <i class="icon md-check" aria-hidden="true"></i> <span class="hidden-sm-down">Allow Access</span>
        </button>
        <button id="button_access" data-url="admin/user/status" data-status="0" style="display: none;" type="button" class="mb-2 btn btn-icon btn-outline-danger waves-effect waves-classic button_status">
            <i class="icon md-close" aria-hidden="true"></i> <span class="hidden-sm-down">Block Access</span>
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
    <button id="button_refresh" data-url="admin/user/index" type="button" class="mb-2 btn btn-icon btn-outline-info waves-effect waves-classic button_refresh">
        <i class="icon md-refresh" aria-hidden="true"></i>
    </button>
    <div class="page-title" style="float: right;">USER</div>
</div>
<div class="quick-link __breadcrumb mb-2">
    <strong> Quick Link :</strong>
    <a href='admin/user'>Manage User</a>
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
                    <th>Fullname</th>
                    <th>Username</th>
                    <th>Role </th>
                    <th>Mytoken</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action Reset</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th style="width: 2%;">
                        <div class="checkbox-custom checkbox-primary"><input type="checkbox" id="check_all"> <label for="check_all"></label></div>
                    </th>
                    <th>No</th>
                    <th>Photo</th>
                    <th>Fullname</th>
                    <th>Username</th>
                    <th>Role </th>
                    <th>Mytoken</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action Reset</th>
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
                url: "<?= base_url('admin/user/data_json') ?>",
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
            if(e.data == 'admin_user'){
                show_user.ajax.reload(null, false);
            }
        };
        // --------------------------------------------------------------------------------------------------------[Websocket stop]
    });
</script>
        