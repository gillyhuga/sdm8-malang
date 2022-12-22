<div class="page-button-data" id="lombok" data-url="administrator/email/">
    <?php if (is_admin()) { ?>
        <button id="btn_back" data-url="administrator/email/index" type="button" class="mb-2 btn btn-icon btn-primary waves-effect waves-classic">
            <i class="icon md-home" aria-hidden="true"></i> <span class="hidden-sm-down">Back Home</span>
        </button>
    <?php } ?>
    <button id="button_refresh" data-url="administrator/password/index" type="button" class="mb-2 btn btn-icon btn-outline-info waves-effect waves-classic button_refresh">
        <i class="icon md-refresh" aria-hidden="true"></i>
    </button>
    <div class="page-title" style="float: right;">LOGS EMAIL</div>
</div>
<div class="quick-link __breadcrumb mb-2" style="background: #ffe186; padding:5px 10px; border-radius: 4px;">
    <strong> Quick Link :</strong>
    <a href='administrator/role'>User Role</a> ||
    <a href='administrator/module'>Module</a> ||
    <a href='administrator/operation'>Operation</a> ||
    <a href='administrator/permission'>Role Permission </a> ||
    <a href='administrator/user'>Manage User</a> ||
    <a href='administrator/password'>Reset Password</a> ||
    <a href='administrator/email'>Reset Email</a> ||
    <a href='administrator/privilege'>Reset Permission</a> ||
    <a href='administrator/online'>Online User</a> ||
    <a href='administrator/activitylog'>Activity Log</a> ||
    <a href='administrator/backup'>Backup database</a>
</div>
<div class="panel">
    <div class="panel-body">
        <table class="table table-hover dataTable table-striped w-full " data-plugin="dataTable" id="log">
            <thead>
                <tr>
                    <th><strong>No</strong></th>
                    <th><strong>Type</strong></th>
                    <th><strong>New Email Address</strong></th>
                    <th><strong>Email reset at</strong></th>
                    <th><strong>Email reset by</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach ($log as $key => $obj) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $obj->old;?></td>
                        <td><?= $obj->new;?></td>
                        <td><?= __datetime($obj->created_at);?></td>
                        <td><?= __user_email($obj->created_by);?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th><strong>No</strong></th>
                    <th><strong>Type</strong></th>
                    <th><strong>New Email Address</strong></th>
                    <th><strong>Email reset at</strong></th>
                    <th><strong>Email reset by</strong></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#log').DataTable();
    });
</script>