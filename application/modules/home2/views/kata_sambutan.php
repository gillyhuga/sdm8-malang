      <!-- Breadcrumbs Start -->
      <div class="rs-breadcrumbs breadcrumbs-overlay">
          <div class="breadcrumbs-img">
              <img src="<?= site_url('assets/frontend/')?>images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
          </div>
          <div class="breadcrumbs-text white-color">
              <h1 class="page-title">Sambutan Kepala Sekolah</h1>
          </div>
      </div>
      <!-- Breadcrumbs End -->            


      
  <!-- About Section Start -->
  <div id="rs-about" class="rs-about style4 pt-100 pb-100 md-pt-80 md-pb-80">
      <div class="container">
          <div class="row">
              <div class="col-lg-5 md-mb-50">
                  <div class="img-part">
                      <img class="about-main" src="<?= site_url('assets/frontend/') ?>images/about/home5/about-main.png" alt="About Image">
                      <img class="circle-bg shape" src="<?= site_url('assets/frontend/') ?>images/about/home5/about-circle-bg.png" alt="About Image">
                      <img class="small-circle shape animated pulse infinite" src="<?= site_url('assets/frontend/') ?>images/about/home5/small-circle-shape.png" alt="About Image">
                      <img class="deep-bg shape" src="<?= site_url('assets/frontend/') ?>images/about/home5/about-deep-bg.png" alt="About Image">
                  </div>
              </div>
              <div class="col-lg-6 offset-lg-1">
                  <div class="about-content">
                      <div class="sec-title mb-46 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms">
                          <h2 class="title mb-15 sm-mb-5">Sekapur Sirih!</h2>
                          <div class="sub-title">Kepala sekolah</div>
                          <p class="desc"><?= $kata_sambutan->kata_sambutan; ?></p>
                          <div class="desc">
                              <span>Hormat kami</span>
                              <h2 class="sub-title"><?= $kata_sambutan->nama_kepala; ?></h2>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- About Section End -->

      