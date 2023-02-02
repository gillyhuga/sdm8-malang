      <!-- Breadcrumbs Start -->
      <div class="rs-breadcrumbs breadcrumbs-overlay">
          <div class="breadcrumbs-img">
              <img src="<?= site_url('assets/frontend/') ?>images/breadcrumbs/1.jpg" alt="Breadcrumbs Image">
          </div>
          <div class="breadcrumbs-text ">
              <h1 class="page-title">Visi dan Misi</h1>
          </div>
      </div>
      <!-- Breadcrumbs End -->

      <!-- Choose Section Start -->
      <div class="why-choose-us style3 pt-100 pb-100 md-pt-80 md-pb-80">
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-lg-6 js-tilt md-mb-40">
                      <div class="img-part">
                          <img src="<?= site_url('assets/frontend/') ?>images/choose/home12/2.jpg"
                              style="border-radius: 4%;" alt="">
                      </div>
                  </div>
                  <div class="col-lg-6 pl-60 md-pl-15">
                      <div class="sec-title3 mb-30">
                          <h2 class=" title new-title margin-0 pb-15">Visi dan Misi </h2>
                      </div>
                      <div class="services-part mb-20">
                          <div class="services-icon">
                              <img src="<?= site_url('assets/frontend/') ?>images/choose/home12/icon/1.png" alt="">
                          </div>
                          <div class="services-text">
                              <h2 class="title"> Visi</h2>
                              <?php foreach ($visi_misi as $key => $obj) { ?>
                              <?php if ($obj->kategori != '1') continue; ?>
                              <p class="services-txt"> <?= $obj->deskripsi; ?></p> <br>
                              <?php } ?>
                          </div>
                      </div>
                      <div class="services-part mb-20">
                          <div class="services-icon">
                              <img src="<?= site_url('assets/frontend/') ?>images/choose/home12/icon/2.png" alt="">
                          </div>
                          <div class="services-text">
                              <h2 class="title"> Misi</h2><br>
                              <?php foreach ($visi_misi as $key => $obj) { ?>
                              <?php if ($obj->kategori != '0') continue; ?>
                              <p class="services-txt"> <?= $obj->deskripsi; ?></p> <br>
                              <?php } ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Choose Section End -->