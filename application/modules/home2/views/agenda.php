      <!-- Breadcrumbs Start -->
      <div class="rs-breadcrumbs breadcrumbs-overlay">
          <div class="breadcrumbs-img">
              <img src="<?= site_url('assets/frontend/') ?>images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
          </div>
          <div class="breadcrumbs-text white-color">
              <h1 class="page-title">Agenda</h1>
          </div>
      </div>
      <!-- Breadcrumbs End -->

      <!-- Events Section Start -->
      <div class="rs-event modify1 orange-color pt-100 pb-100 md-pt-70 md-pb-70">
          <div class="container">
              <div class="row">
                  <?php foreach ($agenda as $key => $obj) { ?>
                      <div class="col-lg-4 mb-30 col-md-6">
                          <div class="event-item">
                              <div class="event-short">
                                  <div class="featured-img">
                                      <img src="<?= __UPLOAD; ?>thumbnail/<?= $obj->foto; ?>" alt="Image">
                                      <div class="dates">
                                          <?= __date($obj->tanggal); ?>
                                      </div>
                                  </div>
                                  <div class="content-part">
                                      <h4 class="title"><a href="#"><?= $obj->title; ?></a></h4>
                                      <div class="time-sec">
                                          <div class="timesec"><i class="fa fa-clock-o"></i><?= $obj->jam_mulai; ?> -
                                              <?= $obj->jam_selesai; ?></div>
                                          <?php $data = $this->home->get_single('fr_kategori_berita', array('id' => $obj->kategori)); ?>
                                          <div class="address"><i class="fa fa-map-o"></i> <?= $data->nama; ?></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  <?php } ?>
              </div>
          </div>
      </div>
      <!-- Events Section End -->