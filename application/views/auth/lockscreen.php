<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap material admin template">
  <meta name="author" content="">

  <title>Lockscreen</title>

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
  <link rel="stylesheet" href="<?= __EXAMPLE; ?>css/pages/lockscreen.css">

  <!-- Fonts -->
  <link rel="stylesheet" href="<?= __FONT; ?>material-design/material-design.min.css">
  <link rel="stylesheet" href="<?= __FONT; ?>brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

  <style>
    .main-screen {
      z-index: 98;
      padding: 0;
      height: 100%;
      width: 100%;
    }


    .slideshow {
      display: block;
      width: 100%;
      padding: 0;
      margin: 0;
      z-index: 99;
      list-style: none;
    }

    .image {
      position: absolute;
      z-index: 0;
      width: 100%;
      height: 100%;
      left: 0;
      top: 0;
      overflow: hidden;
      display: block;

      transition: opacity 1s ease-in-out;
      -moz-transition: opacity 1s ease-in-out;
      -webkit-transition: opacity 1s ease-in-out;
      filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='.myBackground.jpg', sizingMethod='scale');
      -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='myBackground.jpg', sizingMethod='scale')";

    }

    .image {
      opacity: 0;
    }

    .active {
      opacity: 1;
    }


    /* .image:nth-of-type(1) {
      background:
        url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/148866/bg-img.jpg') no-repeat center center;
      background-size: cover;

    }

    .image:nth-of-type(2) {
      background: url('https://d262ilb51hltx0.cloudfront.net/fit/t/1600/1280/gradv/29/81/55/1*wWCapE3Hmi4kN4Es33XUlQ.jpeg') no-repeat center center;
      background-size: cover;
    }

    .image:nth-of-type(3) {
      background: url('https://d262ilb51hltx0.cloudfront.net/fit/t/1600/1280/gradv/29/81/55/1*lvMMN_BQ0IZU2JWjzHfU7g.jpeg') no-repeat center center;
      background-size: cover;
    }

 */

    .image:nth-of-type(1) {
      background: url(<?= site_url('assets/backend/uploads/wallpaper/11.jpg') ?>)no-repeat center center;
      background-size: cover;
    }

    .image:nth-of-type(2) {
      background: url(<?= site_url('assets/backend/uploads/wallpaper/22.jpeg') ?>)no-repeat center center;
      background-size: cover;
    }

    .image:nth-of-type(3) {
      background: url(<?= site_url('assets/backend/uploads/wallpaper/33.jpg') ?>)no-repeat center center;
      background-size: cover;
    }

    .image:nth-of-type(4) {
      background: url(<?= site_url('assets/backend/uploads/wallpaper/44.jpg') ?>)no-repeat center center;
      background-size: cover;
    }

    section {
      margin: 100px auto 100px auto;
      height: 500px;
      width: 600px;
      background: tomato;
      text-align: center;
      padding-top: 300px;
      color: white;
      font-size: 4em;
      overflow: hidden;
    }
  </style>
  <!-- Scripts -->
  <script src="<?= __VENDOR; ?>breakpoints/breakpoints.js"></script>
  <script>
    Breakpoints();
  </script>
</head>

<body class="animsition page-locked layout-full page-dark">
  <div class="main-screen">
    <ul class="slideshow">
      <li class="image active">
      </li>
      <li class="image">
      </li>
      <li class="image">
      </li>
      <li class="image">
      </li>
    </ul>

    <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
      <div class="page-content vertical-align-middle">
        <div class="avatar avatar-100">
          <img src="<?= !empty($this->session->userdata('photo')) ? __UPLOAD . 'thumbnail/' . $this->session->userdata('photo') : __UPLOAD . 'thumbnail/user.png' ?>" alt="">
        </div>
        <p class="locked-user"><?= $this->session->userdata('fullname'); ?></p>
        <?= form_open(site_url('lockscreen/post'), array('name' => 'login', 'id' => 'login', 'autocomplete' => 'off'), '') ?>
        <div class="input-group">
          <input type="hidden" name="email" value="<?= $this->session->userdata('email'); ?>">
          <input type="password" class="form-control last" id="password" name="password" placeholder="Enter password">
          <span class="input-group-btn">
            <button type="submit" id="submit" disabled class="btn btn-primary"><i class="icon md-lock-open" aria-hidden="true"></i>
              <span class="sr-only">unLock</span>
            </button>
          </span>
        </div>
        <?php if ($this->session->flashdata('error')) { ?>
          <div class="input-group">
            <div class="popover bs-popover-bottom error">
              <div class="arrow"></div>
              <h3 class="popover-header">Ops..sorry your password could not be verified please try again!</h3>
            </div>
          </div>
        <?php } ?>
        <?= form_close() ?>
        <span class="live-clock" style="font-size:34px"><?= date('H:i:s') ?></span>
        <footer class="page-copyright page-copyright-inverse">
          <p>WEBSITE BY <?= $this->session->userdata('footer_app'); ?> </p>
          <p>© <?= date('Y') ?>. All RIGHT RESERVED.</p>
          <div class="social">
            <a href="javascript:void(0)">
              <i class="icon bd-twitter" aria-hidden="true"></i>
            </a>
            <a href="javascript:void(0)">
              <i class="icon bd-facebook" aria-hidden="true"></i>
            </a>
            <a href="javascript:void(0)">
              <i class="icon bd-dribbble" aria-hidden="true"></i>
            </a>
          </div>
        </footer>
      </div>
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

  <script>
    $(document).ready(function() {
      function play() {
        setInterval(function() {
          var next = $(".slideshow .active").removeClass("active").next(".image");
          if (!next.length) {
            next = $(".slideshow .image:first");
          }
          next.addClass("active");
        }, 5000);
      }
      play();

    });
  </script>

  <script>
    (function(document, window, $) {
      'use strict';

      var Site = window.Site;
      $(document).ready(function() {
        Site.run();
      });
    })(document, window, jQuery);
    $(document).ready(function() {
      $("#password").on("keyup", function() {
        const regexp_ = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$");
        if (regexp_.test(this.value)) {
          $("#submit").prop("disabled", false);
        } else {
          console.log('OPS');
          $("#submit").prop("disabled", true);
        }
      });

      setInterval(() => {
        $('.error').remove();
      }, 5000);

      setInterval(function() {
        var date = new Date();
        var h = date.getHours(),
          m = date.getMinutes(),
          s = date.getSeconds();
        h = ("0" + h).slice(-2);
        m = ("0" + m).slice(-2);
        s = ("0" + s).slice(-2);

        var time = h + ":" + m + ":" + s;
        $('.live-clock').html(time);
      }, 1000);
    });
  </script>


</body>

</html>