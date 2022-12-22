
<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided" data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse" data-toggle="collapse">
            <i class="icon md-more" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
            <?php if (!empty($this->setting->logo)) { ?>
                <img class="navbar-brand-logo" src="<?= __UPLOAD; ?>thumbnail/<?= $this->setting->logo ?>" title="Remark">
            <?php } else { ?>
                <img class="navbar-brand-logo" src="<?= __UPLOAD; ?>thumbnail/no_image.png" title="Remark">
            <?php } ?>
            <span class="navbar-brand-text hidden-xs-down"> <?= $this->setting->name ?></span>
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search" data-toggle="collapse">
            <span class="sr-only">Toggle Search</span>
            <i class="icon md-search" aria-hidden="true"></i>
        </button>
    </div>

    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="nav-item hidden-float" id="toggleMenubar">
                    <a class="nav-link" data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>
                <li class="nav-item hidden-sm-down" onclick="toggleFullscreen()">
                    <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                        <span class="sr-only">Toggle fullscreen</span>
                    </a>
                </li>
                <li class="nav-item hidden-float">
                    <a class="nav-link icon md-search" data-toggle="collapse" href="#" data-target="#site-navbar-search" role="button">
                        <span class="sr-only">Toggle Search</span>
                    </a>
                </li>

            </ul>
            <!-- End Navbar Toolbar -->

            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Messages" aria-expanded="false" data-animation="scale-up" role="button">
                        <div class="icondemo vertical-align-middle">
                            <i class="icon md-apps icon-lg" aria-hidden="true"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                        <div class="list-group" role="presentation">
                            <div data-role="container">
                                <div data-role="content">
                                    <div class="flex-container">
                                        <div>Admin</div>
                                        <div>Master</div>
                                        <div>Setting</div>
                                        <div>Frontend</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button">
                        <span class="avatar avatar-online">
                            <img src="<?= $this->session->userdata('photo') ? __UPLOAD . 'thumbnail/' . $this->session->userdata('photo') : __UPLOAD . 'thumbnail/no_user.png' ?>" alt="user.png">
                            <i></i>
                        </span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><span class="btn btn-xs btn-block btn-primary">Login as : <?= $this->session->userdata('role_permission'); ?></span></a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><span><i class="icon md-account-circle" aria-hidden="true"></i><?= $this->session->userdata('fullname'); ?></span></a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><span><i class="icon md-email" aria-hidden="true"></i><?= $this->session->userdata('email'); ?></span></a>
                        <!-- default setting here -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem" id="button_edit" data-url='<?= $this->session->userdata('url'); ?>/edit' data-id='<?= $this->session->userdata('uuid') ?>'><i class="icon md-account" aria-hidden="true"></i>Profile</a>
                        <a class="dropdown-item" href="#" role="menuitem" id="button_edit" data-url='<?= site_url('administrator/password/edit') ?>' data-id='<?= $this->session->userdata('uuid') ?>'><i class="icon md-lock" aria-hidden="true"></i>Edit Password</a>
                        <a class="dropdown-item" href="#" role="menuitem" id="button_edit" data-url='<?= site_url('administrator/email/edit') ?>' data-id='<?= $this->session->userdata('uuid') ?>'><i class="icon md-email" aria-hidden="true"></i>Edit Email </a>
                        <a class="dropdown-item" href="#" role="menuitem" id="button_edit" data-url='<?= site_url('administrator/token/edit') ?>' data-id='<?= $this->session->userdata('uuid') ?>'><i class="icon md-accounts-add" aria-hidden="true"></i>myToken </a>
                        <?php if (is_admin()) { ?>
                            <a class="dropdown-item" href="#" role="menuitem" id="button_edit" data-url='<?= site_url('setting/index') ?>' data-id='<?= 1 ?>'><i class="icon md-settings" aria-hidden="true"></i>Setting Application </a>
                        <?php } ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" id="button_logout" href="#" role="menuitem"><i class="icon md-power" aria-hidden="true"></i> Logout</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link waves-effect waves-light waves-round" data-toggle="dropdown" href="javascript:void(0)" title="Notifications" aria-expanded="false" data-animation="scale-up" role="button">
                        <i class="icon md-notifications icon-lg" aria-hidden="true"></i>
                        <!-- <span class="badge badge-pill badge-danger up">5</span> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                        <div class="dropdown-menu-header">
                            <h5>NOTIFICATIONS</h5>
                            <!-- <span class="badge badge-round badge-danger">New 0</span> -->
                        </div>
                        <div class="list-group">
                            <div data-role="container">
                                <div data-role="content">
                                    <!-- <a class="list-group-item dropdown-item waves-effect waves-light waves-round" href="javascript:void(0)" role="menuitem">
                                        <div class="media">
                                            <div class="pr-10">
                                                <i class="icon md-receipt bg-red-600 white icon-circle" aria-hidden="true"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">A new order has been placed</h6>
                                                <time class="media-meta" datetime="2017-06-12T20:50:48+08:00">5 hours ago</time>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item dropdown-item waves-effect waves-light waves-round" href="javascript:void(0)" role="menuitem">
                                        <div class="media">
                                            <div class="pr-10">
                                                <i class="icon md-account bg-green-600 white icon-circle" aria-hidden="true"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Completed the task</h6>
                                                <time class="media-meta" datetime="2017-06-11T18:29:20+08:00">2 days ago</time>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item dropdown-item waves-effect waves-light waves-round" href="javascript:void(0)" role="menuitem">
                                        <div class="media">
                                            <div class="pr-10">
                                                <i class="icon md-settings bg-red-600 white icon-circle" aria-hidden="true"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Settings updated</h6>
                                                <time class="media-meta" datetime="2017-06-11T14:05:00+08:00">2 days ago</time>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item dropdown-item waves-effect waves-light waves-round" href="javascript:void(0)" role="menuitem">
                                        <div class="media">
                                            <div class="pr-10">
                                                <i class="icon md-calendar bg-blue-600 white icon-circle" aria-hidden="true"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Event started</h6>
                                                <time class="media-meta" datetime="2017-06-10T13:50:18+08:00">3 days ago</time>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item dropdown-item waves-effect waves-light waves-round" href="javascript:void(0)" role="menuitem">
                                        <div class="media">
                                            <div class="pr-10">
                                                <i class="icon md-comment bg-orange-600 white icon-circle" aria-hidden="true"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Message received</h6>
                                                <time class="media-meta" datetime="2017-06-10T12:34:48+08:00">3 days ago</time>
                                            </div>
                                        </div>
                                    </a> -->
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-menu-footer">
                            <a class="dropdown-menu-footer-btn waves-effect waves-light waves-round" href="javascript:void(0)" role="button">
                                <i class="icon md-settings" aria-hidden="true"></i>
                            </a>
                            <a class="dropdown-item waves-effect waves-light waves-round" href="javascript:void(0)" role="menuitem">
                                All notifications
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->

        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
            <form role="search">
                <div class="form-group">
                    <div class="input-search">
                        <i class="input-search-icon md-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" name="site-search" placeholder="Search...">
                        <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search" data-toggle="collapse" aria-label="Close"></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Site Navbar Seach -->
    </div>
</nav>