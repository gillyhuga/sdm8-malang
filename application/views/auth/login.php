<?php $setting = $this->db->get_where('settings', array('status' => 1))->row(); ?>

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="<?= $setting->meta_description; ?>">
    <meta name="author" content="<?= $setting->meta_author; ?>">
    <title><?= $setting->title ?></title>
    <link rel="apple-touch-icon" href="<?= __IMAGE; ?>apple-touch-icon.png">
    <link rel="shortcut icon" href="<?= __IMAGE; ?>favicon.ico">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= __CSS; ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= __CSS; ?>bootstrap-extend.min.css">
    <link rel="stylesheet" href="<?= __CSS; ?>site.min.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="<?= __VENDOR; ?>animsition/animsition.css">
    <link rel="stylesheet" href="<?= __VENDOR; ?>asscrollable/asScrollable.css">
    <link rel="stylesheet" href="<?= __VENDOR; ?>switchery/switchery.css">
    <link rel="stylesheet" href="<?= __VENDOR; ?>intro-js/introjs.css">
    <link rel="stylesheet" href="<?= __VENDOR; ?>slidepanel/slidePanel.css">
    <link rel="stylesheet" href="<?= __VENDOR; ?>flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="<?= __VENDOR; ?>waves/waves.css">
    <link rel="stylesheet" href="<?= __CSS; ?>login-v3.css">


    <!-- Fonts -->
    <link rel="stylesheet" href="<?= __FONT; ?>material-design/material-design.min.css">
    <link rel="stylesheet" href="<?= __FONT; ?>brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <!-- Scripts -->
    <script src="<?= __VENDOR; ?>breakpoints/breakpoints.js"></script>
    <script>
        Breakpoints();
    </script>
</head>

<body class="animsition page-login-v3 layout-full">

    <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
        <div class="page-content vertical-align-middle">
            <div class="panel">
                <div class="panel-body">
                    <div class="brand">
                        <img class="brand-img" src="<?= __UPLOAD; ?>original/<?= $setting->logo; ?>" alt="Logo" width="25%">
                        <h2 class="brand-text font-size-18 mt-4"><?= $setting->login ?></h2>
                    </div>
                    <?php if ($this->session->flashdata('error')) { ?>
                        <span id="error" class="btn btn-danger btn-block btn-lg mt-40"> <?= $this->session->flashdata('error')  ?></span>
                    <?php } ?>
                    <script>
                        setInterval(() => {
                            $('#error').remove();
                        }, 8000);
                    </script>

                    <?= form_open(site_url('auth/login'), array('name' => 'login', 'id' => 'login', 'autocomplete' => 'off'), '') ?>
                    <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="email" class="form-control" name="email" />
                        <label class="floating-label">Email</label>
                        <?php if ($this->session->flashdata('email_error')) { ?>
                            <div class="input-group error">
                                <div class="popover bs-popover-bottom">
                                    <div class="arrow"></div>
                                    <h3 class="popover-header"><?= $this->session->flashdata('email_error') ?></h3>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="password" class="form-control" name="password" />
                        <label class="floating-label">Password</label>
                        <?php if ($this->session->flashdata('password_error')) { ?>
                            <div class="input-group error">
                                <div class="popover bs-popover-bottom">
                                    <div class="arrow"></div>
                                    <h3 class="popover-header"><?= $this->session->flashdata('password_error') ?></h3>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group clearfix">
                        <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                            <input type="checkbox" id="remember" name="remember" <?php if (isset($_COOKIE["loginId"])) { ?> checked="checked" <?php } ?>>
                            <label for="remember">Remember me</label>
                        </div>
                        <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-right">
                            <input type="checkbox" id="show-password">
                            <label class="float-right" for="show-password">Show password</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-40">Sign in</button>
                    <?= form_close() ?>
                </div>
            </div>

            <footer class="page-copyright page-copyright-inverse">
                <p> <a target="_blank" href="https://unimasoft.id/" style="color: #fff;">WEBSITE BY UNIMASOFT.ID</a> </p>
                <p>© <?= date('Y') ?>. All RIGHT RESERVED.</p>
                <div class="social">
                    <a class="btn btn-icon btn-pure" href="javascript:void(0)">
                        <i class="icon bd-twitter" aria-hidden="true"></i>
                    </a>
                    <a class="btn btn-icon btn-pure" href="javascript:void(0)">
                        <i class="icon bd-facebook" aria-hidden="true"></i>
                    </a>
                    <a class="btn btn-icon btn-pure" href="javascript:void(0)">
                        <i class="icon bd-google-plus" aria-hidden="true"></i>
                    </a>
                </div>
            </footer>
        </div>
    </div>
    <!-- End Page -->


    <!-- Core  -->
    <script src="<?= __VENDOR; ?>babel-external-helpers/babel-external-helpers.js"></script>
    <script src="<?= __VENDOR; ?>jquery/jquery.js"></script>
    <script src="<?= __VENDOR; ?>popper-js/umd/popper.min.js"></script>
    <script src="<?= __VENDOR; ?>bootstrap/bootstrap.js"></script>
    <script src="<?= __VENDOR; ?>animsition/animsition.js"></script>
    <script src="<?= __VENDOR; ?>mousewheel/jquery.mousewheel.js"></script>
    <script src="<?= __VENDOR; ?>asscrollbar/jquery-asScrollbar.js"></script>
    <script src="<?= __VENDOR; ?>asscrollable/jquery-asScrollable.js"></script>
    <script src="<?= __VENDOR; ?>ashoverscroll/jquery-asHoverScroll.js"></script>
    <script src="<?= __VENDOR; ?>waves/waves.js"></script>

    <!-- Plugins -->
    <script src="<?= __VENDOR; ?>switchery/switchery.js"></script>
    <script src="<?= __VENDOR; ?>intro-js/intro.js"></script>
    <script src="<?= __VENDOR; ?>screenfull/screenfull.js"></script>
    <script src="<?= __VENDOR; ?>slidepanel/jquery-slidePanel.js"></script>
    <script src="<?= __VENDOR; ?>jquery-placeholder/jquery.placeholder.js"></script>

    <!-- Scripts -->
    <script src="<?= __JS; ?>Component.js"></script>
    <script src="<?= __JS; ?>Plugin.js"></script>
    <script src="<?= __JS; ?>Base.js"></script>
    <script src="<?= __JS; ?>Config.js"></script>

    <script src="<?= __JS; ?>Section/Menubar.js"></script>
    <script src="<?= __JS; ?>Section/GridMenu.js"></script>
    <script src="<?= __JS; ?>Section/Sidebar.js"></script>
    <script src="<?= __JS; ?>Section/PageAside.js"></script>
    <script src="<?= __JS; ?>Plugin/menu.js"></script>

    <script src="<?= __JS; ?>config/colors.js"></script>
    <script src="<?= __JS; ?>config/tour.js"></script>
    <script>
        Config.set('assets', '../../assets');
    </script>

    <!-- Page -->
    <script src="<?= __JS; ?>Site.js"></script>
    <script src="<?= __JS; ?>Plugin/asscrollable.js"></script>
    <script src="<?= __JS; ?>Plugin/slidepanel.js"></script>
    <script src="<?= __JS; ?>Plugin/switchery.js"></script>
    <script src="<?= __JS; ?>Plugin/jquery-placeholder.js"></script>
    <script src="<?= __JS; ?>Plugin/material.js"></script>

    <script>
        (function(document, window, $) {
            'use strict';

            var Site = window.Site;
            $(document).ready(function() {
                Site.run();
            });
        })(document, window, jQuery);

        $('#show-password').click(function() {
            if ($(this).is(':checked')) {
                $('#password').attr('type', 'text');
            } else {
                $('#password').attr('type', 'password');
            }
        });
        setInterval(() => {
            $('.error').remove();
        }, 5000);
    </script>

</body>

</html>