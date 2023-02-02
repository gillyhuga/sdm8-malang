      <!-- Breadcrumbs Start -->
      <div class="rs-breadcrumbs breadcrumbs-overlay">
          <div class="breadcrumbs-img">
              <img src="<?= site_url('assets/frontend/') ?>images/breadcrumbs/1.jpg" alt="Breadcrumbs Image">
          </div>
          <div class="breadcrumbs-text ">
              <h1 class="page-title">Galleri</h1>
          </div>
      </div>
      <!-- Breadcrumbs End -->

      <div class="rs-gallery pt-100 pb-100 md-pt-70 md-pb-70">
          <div class="container">
              <div class="row">
                  <?php foreach ($test as $key => $obj) { ?>
                      <div class="col-lg-4 mb-30 col-md-6">
                          <div class="gallery-item">
                              <div class="gallery-img">
                                  <a class="image-popup" href="<?= __UPLOAD; ?>thumbnail/<?= $obj->foto; ?>"><img src="<?= __UPLOAD; ?>original/<?= $obj->foto; ?>" alt=""></a>
                              </div>
                              <div class="title">
                                  <?php $data = $this->home->get_single('fr_kategori_berita', array('id' => $obj->kategori)); ?>
                                  <?= $data->nama; ?>
                              </div>
                          </div>
                      </div>
                      <P></P>
                  <?php } ?>
              </div>
          </div>
      </div>
    <!-- <script src="<?= site_url('assets/frontend/') ?>js/main.js"></script> -->