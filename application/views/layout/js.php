<!-- Core  -->
<script src="<?= __VENDOR; ?>babel-external-helpers/babel-external-helpers.js"></script>
<script src="<?= __VENDOR; ?>jquery/jquery.js"></script>
<script>
    var BASE_URL = '<?= base_url() ?>';
    var BROADCAST_URL = '<?= BROADCAST_URL ?>';
    var BROADCAST_PORT = '<?= BROADCAST_PORT ?>';
    var WEBSOCKET_URL = 'ws://' + BROADCAST_URL + ':' + BROADCAST_PORT
  </script>
  
<script src="<?= __VENDOR; ?>moment/moment.min.js"></script>
<script src="<?= __VENDOR; ?>daterangepicker/daterangepicker.min.js"></script>

<script src="<?= __JS; ?>lombok/History.js"></script>
<script src="<?= __JS; ?>lombok/Spa.js"></script>
<script src="<?= __JS; ?>lombok/Custom.js"></script>

<script src="<?= __VENDOR; ?>popper-js/umd/popper.min.js"></script>
<script src="<?= __VENDOR; ?>bootstrap/bootstrap.js"></script>
<script src="<?= __VENDOR; ?>animsition/animsition.js"></script>
<script src="<?= __VENDOR; ?>mousewheel/jquery.mousewheel.js"></script>
<script src="<?= __VENDOR; ?>asscrollbar/jquery-asScrollbar.js"></script>
<script src="<?= __VENDOR; ?>asscrollable/jquery-asScrollable.js"></script>
<script src="<?= __VENDOR; ?>ashoverscroll/jquery-asHoverScroll.js"></script>
<script src="<?= __VENDOR; ?>waves/waves.js"></script>

<script src="<?= __VENDOR; ?>bootbox/bootbox.js"></script>
<script src="<?= __VENDOR; ?>bootstrap-sweetalert/sweetalert.js"></script>
<script src="<?= __VENDOR; ?>toastr/toastr.js"></script>
<script src="<?= __VENDOR; ?>jquery-ui/jquery-ui.js"></script>
<script src="<?=__VENDOR?>fullcalendar/fullcalendar.min.js"></script>
<script src="<?= __JS; ?>lombok/fullscreen.js"></script>


        
<!-- Plugins -->
<script src="<?= __VENDOR; ?>switchery/switchery.js"></script>
<script src="<?= __VENDOR; ?>intro-js/intro.js"></script>
<script src="<?= __VENDOR; ?>slidepanel/jquery-slidePanel.js"></script>

<script src="<?= __VENDOR; ?>formvalidation/formValidation.min.js"></script>
<script src="<?= __VENDOR; ?>formvalidation/framework/bootstrap4.min.js"></script>
<script src="<?= __VENDOR; ?>bootstrap-sweetalert/sweetalert.js"></script>
<script src="<?= __VENDOR; ?>bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

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
<script src="<?= __JS; ?>Plugin/raty.js"></script>
<!-- Page -->
<script src="<?= __JS; ?>Site.js"></script>
<script src="<?= __JS; ?>Plugin/asscrollable.js"></script>
<script src="<?= __JS; ?>Plugin/slidepanel.js"></script>
<script src="<?= __JS; ?>Plugin/switchery.js"></script>

<script>
    (function(document, window, $) {
        'use strict';

        var Site = window.Site;
        $(document).ready(function() {
            Site.run();
        });
    })(document, window, jQuery);
</script>