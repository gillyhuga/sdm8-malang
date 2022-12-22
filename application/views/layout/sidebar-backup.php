
<div class="site-menubar __sidebar">
	<div class="site-menubar-body">
		<div>
			<div>
				<ul class="site-menu" data-plugin="menu">
					<br>
					<li class="site-menu-item">
						<a class="animsition-link" href="dashboard/home">
							<i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
							<span class="site-menu-title">Dashboard</span>
						</a>
                    </li>
                    <?php if($this->session->userdata('___switch') == 'administrator' OR $this->session->userdata('___switch') == ''){ ?>
                        <?php if(has_permission(MENU, 'administrator', 'role') || has_permission(MENU, 'administrator', 'module') || has_permission(MENU, 'administrator', 'operation') || has_permission(MENU, 'administrator', 'permission') || has_permission(MENU, 'administrator', 'user') || has_permission(MENU, 'administrator', 'password') || has_permission(MENU, 'administrator', 'email') || has_permission(MENU, 'administrator', 'privilege') || has_permission(MENU, 'administrator', 'token') || has_permission(MENU, 'administrator', 'online') || has_permission(MENU, 'administrator', 'activitylog') || has_permission(MENU, 'administrator', 'backup')){ ?>
                            <li class="site-menu-item has-sub">
                                <a href="#">
                                    <i class="site-menu-icon md-balance" aria-hidden="true"></i>
                                    <span class="site-menu-title">Administrator</span>
                                    <span class="site-menu-arrow"></span>
                                </a> 
                                <ul class="site-menu-sub">
                                    <?php if(has_permission(MENU, 'administrator', 'role')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/role">
                                                <span class="site-menu-title">User Role</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'module')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/module">
                                                <span class="site-menu-title">Module</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'operation')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/operation">
                                                <span class="site-menu-title">Operation</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'permission')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/permission">
                                                <span class="site-menu-title">Role Permission	</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'user')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/user">
                                                <span class="site-menu-title">Manage User</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'password')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/password">
                                                <span class="site-menu-title">Reset Password</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'email')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/email">
                                                <span class="site-menu-title">Reset Email</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'privilege')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/privilege">
                                                <span class="site-menu-title">Reset Permission</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'token')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/token">
                                                <span class="site-menu-title">Reset Token</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'online')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/online">
                                                <span class="site-menu-title">Online User</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'activitylog')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/activitylog">
                                                <span class="site-menu-title">Activity Log</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(has_permission(MENU, 'administrator', 'backup')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="administrator/backup">
                                                <span class="site-menu-title">Backup database</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?> 
                    <?php } ?> 
                    <?php if($this->session->userdata('___switch') == 'admin' OR $this->session->userdata('___switch') == ''){ ?>
                        <?php if(has_permission(MENU, 'admin', 'user')){ ?>
                            <li class="site-menu-item has-sub">
                                <a href="#">
                                    <i class="site-menu-icon md-assignment-account" aria-hidden="true"></i>
                                    <span class="site-menu-title">Admin</span>
                                    <span class="site-menu-arrow"></span>
                                </a> 
                                <ul class="site-menu-sub">
                                    <?php if(has_permission(MENU, 'admin', 'user')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="admin/user">
                                                <span class="site-menu-title">Manage User</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?> 
                    <?php } ?> 
                    <?php if($this->session->userdata('___switch') == 'master' OR $this->session->userdata('___switch') == ''){ ?>
                        <?php if(has_permission(MENU, 'master', 'user')){ ?>
                            <li class="site-menu-item has-sub">
                                <a href="#">
                                    <i class="site-menu-icon md-lamp" aria-hidden="true"></i>
                                    <span class="site-menu-title">Master</span>
                                    <span class="site-menu-arrow"></span>
                                </a> 
                                <ul class="site-menu-sub">
                                    <?php if(has_permission(MENU, 'master', 'user')){ ?>
                                        <li class="site-menu-item active">
                                            <a class="animsition-link" href="master/user">
                                                <span class="site-menu-title">Data User</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?> 
                    <?php } ?> 
					</li>
				</ul>
            </div>
        </div>
    </div>
    <div class="site-menubar-footer">
        <a href="javascript: void(0);" id="button_edit" data-url='<?= site_url('setting/index') ?>' data-id='<?= 1 ?>' class="fold-show" data-placement="top" data-toggle="tooltip" data-original-title="Settings">
            <span class="icon md-settings" aria-hidden="true"></span>
        </a>
        <a href="<?= site_url('lockscreen')?>" data-placement="top" data-toggle="tooltip" data-original-title="Lock">
            <span class="icon md-eye-off" aria-hidden="true"></span>
        </a>
        <a href="javascript: void(0);" id="button_logout" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
            <span class="icon md-power" aria-hidden="true"></span>
        </a>
    </div>
</div>
<div class="site-gridmenu">
    <div>
        <div>
            <ul>
                <li class="button_menu" data-url="dashboard/switch" data-menu="administrator">
                    <a href="#">
                        <i class="icon md-balance"></i>
                        <span>Administrator</span>
                    </a>
                </li>
                <li class="button_menu" data-url="dashboard/switch" data-menu="admin">
                    <a href="#">
                        <i class="icon md-assignment-account"></i>
                        <span>Admin</span>
                    </a>
                </li>
                <li class="button_menu" data-url="dashboard/switch" data-menu="default">
                    <a href="#">
                        <i class="icon md-lamp"></i>
                        <span>Default</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
        