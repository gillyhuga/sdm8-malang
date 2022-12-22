<div class="page-button-data" id="lombok" data-url="administrator/backup/">
    <input type="hidden" id="trash" name="trash" value="<?= $this->session->userdata('___recycle_bin');?>">
    <button id="button_refresh" data-url="administrator/backup/index" type="button" class="mb-2 btn btn-icon btn-outline-info waves-effect waves-classic button_refresh">
        <i class="icon md-refresh" aria-hidden="true"></i>
    </button>
    <div class="page-title" style="float: right;">BACKUP DATABASE</div>
</div>
<div class="quick-link __breadcrumb mb-2">
    <strong> Quick Link :</strong>
    <a href='administrator/role'>User Role</a> ||
    <a href='administrator/module'>Module</a> ||
    <a href='administrator/operation'>Operation</a> ||
    <a href='administrator/permission'>Role Permission </a> ||
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
        <?php echo form_open(site_url('administrator/backup/post'), array('name' => 'backup', 'id' => 'backup', 'class' => 'form-horizontal form-label-left'), ''); ?>
        <input type="hidden" name="backup_database" value="backup_database">
        <p>Please backup your data regularly</p>
        <button type="submit" class="btn btn-primary shadow mr-1 mb-1">Backup Database</button>
        <?php form_close() ?>
    </div>
</div>