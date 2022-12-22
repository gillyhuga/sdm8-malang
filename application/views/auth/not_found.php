<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">

    <title>404</title>

    <link rel="apple-touch-icon" href="<?= __IMAGE; ?>apple-touch-icon.png">
    <link rel="shortcut icon" href="<?= __IMAGE; ?>favicon.ico">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= __GLOBAL; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= __GLOBAL; ?>css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="<?= __CSS; ?>site.min.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="<?= __GLOBAL; ?>vendor/animsition/animsition.css">
    <link rel="stylesheet" href="<?= __GLOBAL; ?>vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="<?= __GLOBAL; ?>vendor/switchery/switchery.css">
    <link rel="stylesheet" href="<?= __GLOBAL; ?>vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="<?= __GLOBAL; ?>vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="<?= __GLOBAL; ?>vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="<?= __GLOBAL; ?>vendor/waves/waves.css">
    <link rel="stylesheet" href="<?= __EXA; ?>css/pages/errors.css">


    <!-- Fonts -->
    <link rel="stylesheet" href="<?= __GLOBAL; ?>fonts/material-design/material-design.min.css">
    <link rel="stylesheet" href="<?= __GLOBAL; ?>fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <!-- Scripts -->
    <script src="<?= __GLOBAL; ?>vendor/breakpoints/breakpoints.js"></script>
    <script>
        Breakpoints();
    </script>
</head>

<body class="animsition page-error page-error-404 layout-full">
    <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content vertical-align-middle">
            <header>
                <h1 class="animation-slide-top">404</h1>
                <p>Page Not Found !</p>
            </header>
            <p class="error-advise">YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p>
            <a class="btn btn-primary btn-round" href="<?= site_url('home')?>">GO TO HOME PAGE</a>

            <footer class="page-copyright">
                <p> <a target="_blank" href="https://unimasoft.id/" style="color: #a9afb5;">WEBSITE BY UNIMASOFT.ID</a> </p>
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
    <script src="<?= __GLOBAL; ?>vendor/babel-external-helpers/babel-external-helpers.js"></script>
    <script src="<?= __GLOBAL; ?>vendor/jquery/jquery.js"></script>
    <script src="<?= __GLOBAL; ?>vendor/popper-js/umd/popper.min.js"></script>
    <script src="<?= __GLOBAL; ?>vendor/bootstrap/bootstrap.js"></script>
    <script src="<?= __GLOBAL; ?>vendor/animsition/animsition.js"></script>
    <script src="<?= __GLOBAL; ?>vendor/mousewheel/jquery.mousewheel.js"></script>
    <script src="<?= __GLOBAL; ?>vendor/asscrollbar/jquery-asScrollbar.js"></script>
    <script src="<?= __GLOBAL; ?>vendor/asscrollable/jquery-asScrollable.js"></script>
    <script src="<?= __GLOBAL; ?>vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
    <script src="<?= __GLOBAL; ?>vendor/waves/waves.js"></script>

    <!-- Plugins -->
    <script src="<?= __GLOBAL; ?>vendor/switchery/switchery.js"></script>
    <script src="<?= __GLOBAL; ?>vendor/intro-js/intro.js"></script>
    <script src="<?= __GLOBAL; ?>vendor/screenfull/screenfull.js"></script>
    <script src="<?= __GLOBAL; ?>vendor/slidepanel/jquery-slidePanel.js"></script>

    <!-- Scripts -->
    <script src="<?= __GLOBAL; ?>js/Component.js"></script>
    <script src="<?= __GLOBAL; ?>js/Plugin.js"></script>
    <script src="<?= __GLOBAL; ?>js/Base.js"></script>
    <script src="<?= __GLOBAL; ?>js/Config.js"></script>

    <script src="<?= __JS ?>Section/Menubar.js"></script>
    <script src="<?= __JS ?>Section/GridMenu.js"></script>
    <script src="<?= __JS ?>Section/Sidebar.js"></script>
    <script src="<?= __JS ?>Section/PageAside.js"></script>
    <script src="<?= __JS ?>Plugin/menu.js"></script>

    <script src="<?= __GLOBAL; ?>js/config/colors.js"></script>
    <script src="<?= __JS ?>config/tour.js"></script>
    <script>
        Config.set('assets', '<?= __ASSET ?>');
    </script>

    <!-- Page -->
    <script src="<?= __JS ?>Site.js"></script>
    <script src="<?= __GLOBAL; ?>js/Plugin/asscrollable.js"></script>
    <script src="<?= __GLOBAL; ?>js/Plugin/slidepanel.js"></script>
    <script src="<?= __GLOBAL; ?>js/Plugin/switchery.js"></script>

    <script>
        (function(document, window, $) {
            'use strict';

            var Site = window.Site;
            $(document).ready(function() {
                Site.run();
            });
        })(document, window, jQuery);
    </script>

</body>

</html>