<?php $setting = $this->db->get_where('settings', array('status' => 1))->row(); ?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    <title><?= isset($setting) ? $setting->title : 'Page Verify Account ' ?></title>
    <link rel="apple-touch-icon" href="<?= __IMAGE; ?>apple-touch-icon.png">
    <link rel="shortcut icon" href="<?= __IMAGE; ?>favicon.ico">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= __CSS; ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= __CSS; ?>bootstrap-extend.min.css">
    <link rel="stylesheet" href="<?= __CSS; ?>site.min.css">
    <link rel="stylesheet" href="<?= __CSS; ?>login-v3.css">


    <!-- Plugins -->
    <link rel="stylesheet" href="<?= __VENDOR; ?>animsition/animsition.css">
    <link rel="stylesheet" href="<?= __VENDOR; ?>asscrollable/asScrollable.css">
    <link rel="stylesheet" href="<?= __VENDOR; ?>switchery/switchery.css">
    <link rel="stylesheet" href="<?= __VENDOR; ?>intro-js/introjs.css">
    <link rel="stylesheet" href="<?= __VENDOR; ?>slidepanel/slidePanel.css">
    <link rel="stylesheet" href="<?= __VENDOR; ?>flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="<?= __VENDOR; ?>waves/waves.css">
    <!-- Fonts -->
    <link rel="stylesheet" href="<?= __FONT; ?>material-design/material-design.min.css">
    <link rel="stylesheet" href="<?= __FONT; ?>brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <style>
        .brand-img {
            position: relative;
            width: 25%;
        }
    </style>
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
                        <img class="brand-img" src="<?= __UPLOAD; ?>original/<?= $setting->logo; ?>" alt="Logo">
                        <h2 class="brand-text font-size-18"><?= isset($setting->title) ? $setting->title : '' ?></h2>
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
                    <input type="hidden" name="email" value="<?= $this->session->userdata('email'); ?>">
                    <input type="hidden" name="password" value="<?= $this->session->userdata('password'); ?>">
                    <p>Mohon mengisikan Kode Verifikasi untuk bisa kami memastikan bahwa anda ini pemilik sah Account ini.. thank you</p>
                    <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="text" class="form-control" required name="verify_token" id="verify_token" />
                        <label class="floating-label">Verify Account</label>
                        <?php if ($this->session->flashdata('verify_failed')) { ?>
                            <div class="input-group error">
                                <div class="popover bs-popover-bottom">
                                    <div class="arrow"></div>
                                    <h3 class="popover-header"><?= $this->session->flashdata('verify_failed'); ?></h3>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-40">Verify</button>
                    <!-- </form> -->
                    <?= form_close() ?>
                </div>
            </div>

            <footer class="page-copyright page-copyright-inverse">
                <p style="color: #fff;"> <a target="_blank" href="https://unimasoft.id/">WEBSITE BY UNIMASOFT.ID</a> </p>
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
        Config.set('assets', '<?= __ASSET; ?>');
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