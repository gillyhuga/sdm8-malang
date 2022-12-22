<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
  <?= $this->load->view('layout/meta'); ?>
  <title><?= $this->setting->title; ?></title>
  <?= $this->load->view('layout/css'); ?>
  <?= $this->load->view('layout/datatables/css'); ?>
  <?= $this->load->view('layout/advanced/css'); ?>
  <?= $this->load->view('layout/editor/css'); ?>

</head>

<body class="animsition">
  <?= $this->load->view('layout/nav'); ?>
  <?= $this->load->view('layout/sidebar'); ?>
  
  <!-- Page -->
  <div class="page" id="view_fullscreen">
    <?= $this->load->view('layout/modal'); ?>
    <div class="page-content"  >
      <div id="main-view"></div>
    </div>
  </div>
  <!-- End Page -->
  <?= $this->load->view('layout/footer'); ?>
  <!-- Footer -->
  <script>
    var APP_URL = '<?= base_url() ?>';
  </script>
  <?= $this->load->view('layout/js'); ?>
  <?= $this->load->view('layout/datatables/js'); ?>
  <?= $this->load->view('layout/advanced/js'); ?>
  <?= $this->load->view('layout/editor/js'); ?>
</body>

</html>