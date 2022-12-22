      <!-- Breadcrumbs Start -->
      <div class="rs-breadcrumbs breadcrumbs-overlay">
          <div class="breadcrumbs-img">
              <img src="<?= site_url('assets/frontend/') ?>images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
          </div>
          <div class="breadcrumbs-text white-color">
              <h1 class="page-title">Budaya Sekolah</h1>
          </div>
      </div>
      <!-- Breadcrumbs End -->



      <!-- Choose Section Start -->
      <div class="why-choose-us style3">
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-lg-12 pl-60 md-pl-15">
                      <div class="sec-title3 mb-30">
                          <h2 class=" title new-title margin-0 pb-15">Budaya Sekolah </h2>
                      </div>
                      <div class="services-part mb-20">
                          <div class="services-icon">
                              <img src="<?= site_url('assets/frontend/') ?>images/choose/home12/icon/2.png" alt="">
                          </div>
                          <div class="services-text">
                              <h2 class="title">Aqidah yang kuat</h2><br>
                              <?php $no=1;  foreach ($budaya_sekolah as $key => $obj) { ?>
                                  <?php if ($obj->kategori != '1')  continue; ?>
                                  <p class="services-txt">(<?= $no++; ?>).  <?= $obj->deskripsi; ?></p> <br>
                              <?php } ?>
                          </div>
                      </div>
                      <div class="services-part mb-20">
                          <div class="services-icon">
                              <img src="<?= site_url('assets/frontend/') ?>images/choose/home12/icon/2.png" alt="">
                          </div>
                          <div class="services-text">
                              <h2 class="title">Ibadah yang benar</h2><br>
                              <?php $no=1; foreach ($budaya_sekolah as $key => $obj) { ?>
                                  <?php if ($obj->kategori != '2')  continue; ?>
                                  <p class="services-txt">(<?= $no++; ?>).  <?= $obj->deskripsi; ?></p> <br>
                              <?php } ?>
                          </div>
                      </div>
                      <div class="services-part mb-20">
                          <div class="services-icon">
                              <img src="<?= site_url('assets/frontend/') ?>images/choose/home12/icon/2.png" alt="">
                          </div>
                          <div class="services-text">
                              <h2 class="title">Akhlak karimah</h2><br>
                              <?php $no=1; foreach ($budaya_sekolah as $key => $obj) { ?>
                                  <?php if ($obj->kategori != '3')  continue; ?>
                                  <p class="services-txt">(<?= $no++; ?>).  <?= $obj->deskripsi; ?></p> <br>
                              <?php } ?>
                          </div>
                      </div>
                      <div class="services-part mb-20">
                          <div class="services-icon">
                              <img src="<?= site_url('assets/frontend/') ?>images/choose/home12/icon/2.png" alt="">
                          </div>
                          <div class="services-text">
                              <h2 class="title">Disiplin dan mandiri</h2><br>
                              <?php $no=1; foreach ($budaya_sekolah as $key => $obj) { ?>
                                  <?php if ($obj->kategori != '4')  continue; ?>
                                  <p class="services-txt">(<?= $no++; ?>).  <?= $obj->deskripsi; ?></p> <br>
                              <?php } ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Choose Section End -->