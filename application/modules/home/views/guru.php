      <!-- Breadcrumbs Start -->
      <div class="rs-breadcrumbs breadcrumbs-overlay">
          <div class="breadcrumbs-img">
              <img src="<?= site_url('assets/frontend/') ?>images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
          </div>
          <div class="breadcrumbs-text white-color">
              <h1 class="page-title">Guru dan Tenaga Pendidik</h1>
          </div>
      </div>
      <!-- Breadcrumbs End -->


      <div id="rs-team" class="rs-team style1 inner-style orange-color pt-94 pb-100 md-pt-64 md-pb-70 gray-bg">
          <div class="container">
              <div class="sec-title mb-50 md-mb-30 text-center">
                  <div class="sub-title orange">Instructor</div>
                  <h2 class="title mb-0">Expert Teachers</h2>
              </div>
              <div class="row">
                  <?php foreach ($guru as $key => $obj) { ?>
                      <div class="col-lg-4 col-sm-6 mb-30">
                          <div class="team-item">
                              <img src="<?= __UPLOAD; ?>thumbnail/<?= $obj->foto?>" alt="">
                              <div class="content-part">
                                  <h4 class="name"><a href="team-single.html"><?= $obj->nama;?></a></h4>
                                  <span class="designation"><?= $obj->bidang_ilmu;?></span>
                              </div>
                          </div>
                      </div>
                  <?php } ?>
              </div>
          </div>
      </div>