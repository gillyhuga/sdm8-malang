<!DOCTYPE html>
<html lang="zxx">
<?php $setting = $this->db->get_where('settings', array('id' => 1))->row(); ?>

<head>
    <!-- meta tag -->
    <meta charset="utf-8">
    <title><?= $title_for_layout; ?></title>
    <meta name="description" content="">
    <!-- responsive tag -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= site_url('assets/frontend/') ?>images/fav.png">
    <!-- Bootstrap v5.0.2 css -->
    <link rel="stylesheet" type="text/css" href="<?= site_url('assets/frontend/') ?>css/bootstrap.min.css">
    <!-- font-awesome css -->
    <link rel="stylesheet" type="text/css" href="<?= site_url('assets/frontend/') ?>css/font-awesome.min.css">
    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="<?= site_url('assets/frontend/') ?>css/animate.css">
    <!-- owl.carousel css -->
    <link rel="stylesheet" type="text/css" href="<?= site_url('assets/frontend/') ?>css/owl.carousel.css">
    <!-- slick css -->
    <link rel="stylesheet" type="text/css" href="<?= site_url('assets/frontend/') ?>css/slick.css">
    <!-- off canvas css -->
    <link rel="stylesheet" type="text/css" href="<?= site_url('assets/frontend/') ?>css/off-canvas.css">
    <!-- linea-font css -->
    <link rel="stylesheet" type="text/css" href="<?= site_url('assets/frontend/') ?>fonts/linea-fonts.css">
    <!-- flaticon css  -->
    <link rel="stylesheet" type="text/css" href="<?= site_url('assets/frontend/') ?>fonts/flaticon.css">
    <!-- magnific popup css -->
    <link rel="stylesheet" type="text/css" href="<?= site_url('assets/frontend/') ?>css/magnific-popup.css">
    <!-- Main Menu css -->
    <link rel="stylesheet" href="<?= site_url('assets/frontend/') ?>css/rsmenu-main.css">
    <!-- spacing css -->
    <link rel="stylesheet" type="text/css" href="<?= site_url('assets/frontend/') ?>css/rs-spacing.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="<?= site_url('assets/frontend/') ?>style.css">
    <!-- This stylesheet dynamically changed from style.less -->
    <!-- responsive css -->
    <link rel="stylesheet" type="text/css" href="<?= site_url('assets/frontend/') ?>css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
</head>

<body class="defult-home">

    <!--Preloader area start here-->
    <div id="loader" class="loader green-color">
        <div class="loader-container">
            <div class='loader-icon'>
                <img src="<?= __UPLOAD ?>original/<?= $setting->logo; ?>" alt="">
            </div>
        </div>
    </div>
    <!--Preloader area End here-->


    <!--Full width header Start-->
    <div class="full-width-header header-style1 home1-modifiy home12-modifiy">
        <!--Header Start-->
        <header id="rs-header" class="rs-header">
            <!-- Topbar Area Start -->
            <div class="topbar-area home11-topbar">
                <div class="container">
                    <div class="row y-middle">
                        <div class="col-md-8">
                            <ul class="topbar-contact">
                                <li style="height: 8px;">
                                    <i class="flaticon-location"></i>
                                    Kampus 1 : <?= $setting->address; ?>
                                </li>
                                <li>
                                    <i class="flaticon-location"></i>
                                    Kampus 2 : Jl. Sumpil 1 No.53B, Purwodadi, Kec. Blimbing, Kota Malang
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 ">
                            <ul class="toolbar-sl-share" style="">
                                <li class="opening">
                                    <i class="flaticon-email"></i>
                                    <a href="mailto:<?= $setting->email; ?>"><?= $setting->email; ?></a>
                                </li>
                                <li class="opening">
                                    <i class="fa flaticon-call"></i>
                                    <a href="tel:+<?= $setting->phone; ?>"><?= $setting->phone; ?></a>
                                </li>

                                <li><a href="<?= $setting->facebook_url; ?>"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="<?= $setting->twitter_url; ?>"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="<?= $setting->youtube_url; ?>"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="<?= $setting->instagram_url; ?>"><i class="fa fa-instagram"></i></a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Topbar Area End -->

            <!-- Menu Start -->
            <div class="menu-area menu-sticky">
                <div class="container">
                    <div class="row y-middle">
                        <div class="col-lg-2">
                            <div class="logo-cat-wrap">
                                <div class="logo-part it-menu">
                                    <a href="/">
                                        <img src="<?= __UPLOAD ?>original/<?= $setting->logo; ?>" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 text-end">
                            <div class="rs-menu-area">
                                <div class="main-menu">
                                    <div class="mobile-menu">
                                        <a class="rs-menu-toggle">
                                            <i class="fa fa-bars"></i>
                                        </a>
                                    </div>
                                    <nav class="rs-menu">
                                        <ul class="nav-menu">
                                            <li class="current-menu-item it-menu">
                                                <a href="<?= site_url('home'); ?>">Beranda</a>
                                            </li>
                                            <li class="menu-item-has-children">
                                                <a href="#">Tentang kami</a>
                                                <ul class="sub-menu">
                                                    <li><a href="<?= site_url('home/sambutan_kepala'); ?>">Sambutan
                                                            kepala</a></li>
                                                    <li><a href="<?= site_url('home/profil'); ?>">Profil sekolah</a>
                                                    </li>
                                                    <li><a href="<?= site_url('home/budaya_sekolah'); ?>">Budaya
                                                            sekolah</a></li>
                                                    <li><a href="<?= site_url('home/visi_misi'); ?>">Visi dan Misi</a>
                                                    </li>
                                                    <li><a href="<?= site_url('home/guru'); ?>">Guru dan Tenaga
                                                            Pendidik</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children">
                                                <a href="#">Kesiswaan</a>
                                                <ul class="sub-menu">
                                                    <li><a href="<?= site_url('home/alquran'); ?>">Alquran</a></li>
                                                    <li><a href="<?= site_url('home/ismubaris'); ?>">Ismubaris</a></li>
                                                    <li><a href="<?= site_url('home/komite'); ?>">Komite sekolah</a>
                                                    </li>
                                                    <li><a href="<?= site_url('home/alumni'); ?>">ALumni</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children">
                                                <a href="#">E-Library</a>
                                                <ul class="sub-menu">
                                                    <li><a href="<?= site_url('home/ebook'); ?>">Karya Guru dan
                                                            Siswa</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children">
                                                <a href="#">Informasi</a>
                                                <ul class="sub-menu">
                                                    <li><a href="<?= site_url('home/agenda'); ?>">Agenda </a></li>
                                                    <li><a href="<?= site_url('home/berita'); ?>">Berita</a></li>
                                                    <li><a href="<?= site_url('home/galeri'); ?>">Galleri</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <!-- //.nav-menu -->
                                    </nav>
                                </div> <!-- //.main-menu -->
                            </div>
                        </div>
                        <div class="col-lg-1 text-end">
                            <div class="expand-btn-inner">
                                <ul>
                                    <li>
                                        <a class="hidden-xs rs-search" data-bs-toggle="modal"
                                            data-bs-target="#searchModal" href="#">
                                            <i class="flaticon-search"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Menu End -->

            <!-- Canvas Menu start -->
            <nav class="right_menu_togle hidden-md">
                <div class="close-btn">
                    <div id="nav-close">
                        <div class="line">
                            <span class="line1"></span><span class="line2"></span>
                        </div>
                    </div>
                </div>
                <div class="canvas-logo">
                    <a href="index.html"><img src="<?= site_url('assets/frontend/') ?>images/logo-dark.png"
                            alt="logo"></a>
                </div>
                <div class="offcanvas-text">
                    <p>We denounce with righteous indige nationality and dislike men who are so beguiled and demo by the
                        charms of pleasure of the moment data com so blinded by desire.</p>
                </div>
                <div class="offcanvas-gallery">
                    <div class="gallery-img">
                        <a class="image-popup" href="<?= site_url('assets/frontend/') ?>images/gallery/1.jpg"><img
                                src="<?= site_url('assets/frontend/') ?>images/gallery/1.jpg" alt=""></a>
                    </div>
                    <div class="gallery-img">
                        <a class="image-popup" href="<?= site_url('assets/frontend/') ?>images/gallery/2.jpg"><img
                                src="<?= site_url('assets/frontend/') ?>images/gallery/2.jpg" alt=""></a>
                    </div>
                    <div class="gallery-img">
                        <a class="image-popup" href="<?= site_url('assets/frontend/') ?>images/gallery/3.jpg"><img
                                src="<?= site_url('assets/frontend/') ?>images/gallery/3.jpg" alt=""></a>
                    </div>
                    <div class="gallery-img">
                        <a class="image-popup" href="<?= site_url('assets/frontend/') ?>images/gallery/4.jpg"><img
                                src="<?= site_url('assets/frontend/') ?>images/gallery/4.jpg" alt=""></a>
                    </div>
                    <div class="gallery-img">
                        <a class="image-popup" href="<?= site_url('assets/frontend/') ?>images/gallery/5.jpg"><img
                                src="<?= site_url('assets/frontend/') ?>images/gallery/5.jpg" alt=""></a>
                    </div>
                    <div class="gallery-img">
                        <a class="image-popup" href="<?= site_url('assets/frontend/') ?>images/gallery/6.jpg"><img
                                src="<?= site_url('assets/frontend/') ?>images/gallery/6.jpg" alt=""></a>
                    </div>
                </div>
                <div class="map-img">
                    <img src="<?= site_url('assets/frontend/') ?>images/map.jpg" alt="">
                </div>
                <div class="canvas-contact">
                    <ul class="social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </nav>
            <!-- Canvas Menu end -->
        </header>
        <!--Header End-->
    </div>
    <!--Full width header End-->

    <!-- Main content Start -->
    <div class="main-content">
        <?= $content_for_layout; ?>
    </div>
    <!-- Main content End -->
    <!-- Footer Start -->
    <!-- Footer Start -->
    <footer id="rs-footer" class="rs-footer">
        <div class="footer-top no-gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12 footer-widget md-mb-50">
                        <h4 class="widget-title">Tentang Kami</h4>
                        <ul class="site-map">
                            <li><a href="#">Sambutan Kepala Sekolah</a></li>
                            <li><a href="#">Profile Sekolah</a></li>
                            <li><a href="#">Budaya Sekolah</a></li>
                            <li><a href="#">Visi & Misi</a></li>
                            <li><a href="#">Guru & Tenaga Pendidik</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 footer-widget md-mb-50">
                        <h4 class="widget-title">Kesiswaan</h4>
                        <ul class="site-map">
                            <li><a href="#">Alquran</a></li>
                            <li><a href="#">Ilmubaris</a></li>
                            <li><a href="#">Komite Sekolah</a></li>
                            <li><a href="#">Alumni</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 footer-widget md-mb-50">
                        <h4 class="widget-title">Informasi</h4>
                        <ul class="site-map">
                            <li><a href="#">Agenda</a></li>
                            <li><a href="#">Berita</a></li>
                            <li><a href="#">Galleri</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 footer-widget">
                        <h4 class="widget-title">Hubungi Kami</h4>
                        <ul class="address-widget">
                            <li>
                                <i class="flaticon-location"></i>
                                <div class="desc">Kampus 1 : <?= $setting->address; ?></div>

                            </li>
                            <li>
                                <i class="flaticon-location"></i>
                                <div class="desc">Kampus 2 : Jl. Sumpil 1 No.53B, Purwodadi, Kec. Blimbing, Kota Malang
                                </div>

                            </li>
                            <li>
                                <i class="flaticon-call"></i>
                                <div class="desc">
                                    <a href="tel:<?= $setting->phone; ?>"><?= $setting->phone; ?></a>
                                    <a href="tel:<?= $setting->phone2; ?>"><?= $setting->phone2; ?></a>
                                </div>
                            </li>
                            <li>
                                <i class="flaticon-email"></i>
                                <div class="desc">
                                    <a href="mailto:<?= $setting->email; ?>"><?= $setting->email; ?></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row y-middle">
                    <div class="col-lg-4 md-mb-20">
                        <div class="footer-logo md-text-center">
                            <a href="index.html"><img src="<?= __UPLOAD; ?>original/<?= $setting->logo; ?>"
                                    alt="<?= $setting->logo; ?>"></a>
                        </div>
                    </div>
                    <div class="col-lg-4 md-mb-20">
                        <div class="copyright text-center md-text-start">
                            <p>&copy; <?= date('Y'); ?> All Rights Reserved. Developed By <a
                                    href="https://unimasoft.id">Unimasoft.ID</a></p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-end md-text-start">
                        <ul class="footer-social">
                            <li><a href="<?= $setting->facebook_url; ?>"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?= $setting->twitter_url; ?>"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?= $setting->instagram_url; ?>"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="<?= $setting->google_plus_url; ?>"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="<?= $setting->youtube_url; ?>"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->
    <!-- Footer End -->


    <!-- start scrollUp  -->
    <div id="scrollUp" class="green-color">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- End scrollUp  -->


    <!-- Search Modal Start -->
    <div class="modal fade search-modal" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
        aria-hidden="true">
        <button type="button" class="close" data-bs-dismiss="modal">
            <span class="flaticon-cross"></span>
        </button>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="search-block clearfix">
                    <form>
                        <div class="form-group">
                            <input class="form-control" placeholder="Search Here..." type="text">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Modal End -->

    <!-- modernizr js -->
    <script src="<?= site_url('assets/frontend/') ?>js/modernizr-2.8.3.min.js"></script>
    <!-- jquery latest version -->
    <script src="<?= site_url('assets/frontend/') ?>js/jquery.min.js"></script>

    <!-- Bootstrap v5.0.2 js -->
    <script src="<?= site_url('assets/frontend/') ?>js/bootstrap.min.js"></script>
    <!-- Menu js -->
    <script src="<?= site_url('assets/frontend/') ?>js/rsmenu-main.js"></script>
    <!-- op nav js -->
    <script src="<?= site_url('assets/frontend/') ?>js/jquery.nav.js"></script>
    <!-- owl.carousel js -->
    <script src="<?= site_url('assets/frontend/') ?>js/owl.carousel.min.js"></script>
    <!-- Slick js -->
    <script src="<?= site_url('assets/frontend/') ?>js/slick.min.js"></script>
    <!-- isotope.pkgd.min js -->
    <script src="<?= site_url('assets/frontend/') ?>js/isotope.pkgd.min.js"></script>
    <!-- imagesloaded.pkgd.min js -->
    <script src="<?= site_url('assets/frontend/') ?>js/imagesloaded.pkgd.min.js"></script>
    <!-- wow js -->
    <script src="<?= site_url('assets/frontend/') ?>js/wow.min.js"></script>
    <!-- Skill bar js -->
    <script src="<?= site_url('assets/frontend/') ?>js/skill.bars.jquery.js"></script>
    <script src="<?= site_url('assets/frontend/') ?>js/jquery.counterup.min.js"></script>
    <!-- counter top js -->
    <script src="<?= site_url('assets/frontend/') ?>js/waypoints.min.js"></script>
    <!-- video js -->
    <script src="<?= site_url('assets/frontend/') ?>js/jquery.mb.YTPlayer.min.js"></script>
    <!-- magnific popup js -->
    <script src="<?= site_url('assets/frontend/') ?>js/jquery.magnific-popup.min.js"></script>
    <!-- tilt js -->
    <script src="<?= site_url('assets/frontend/') ?>js/tilt.jquery.min.js"></script>
    <!-- plugins js -->
    <script src="<?= site_url('assets/frontend/') ?>js/plugins.js"></script>
    <!-- contact form js -->
    <script src="<?= site_url('assets/frontend/') ?>js/contact.form.js"></script>
    <!-- main js -->
    <script src="<?= site_url('assets/frontend/') ?>js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>