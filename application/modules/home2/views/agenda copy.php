      <!-- Breadcrumbs Start -->
      <div class="rs-breadcrumbs breadcrumbs-overlay">
          <div class="breadcrumbs-img">
              <img src="<?= site_url('assets/frontend/') ?>images/breadcrumbs/1.jpg" alt="Breadcrumbs Image">
          </div>
          <div class="breadcrumbs-text ">
              <h1 class="page-title">Agenda</h1>
          </div>
      </div>
      <!-- Breadcrumbs End -->
  <!-- Events Section Start -->
  <div class="rs-event home12style">
      <div class="container">
          <div class="sec-title4 text-center mb-50">
              <div class="sub-title">Join Events</div>
              <h2 class="title purple-color">Upcoming Events</h2>
          </div>
          <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="true" data-autoplay-timeout="7000" data-smart-speed="2000" data-dots="true" data-nav="false" data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="true" data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="true" data-ipad-device2="1" data-ipad-device-nav2="false" data-ipad-device-dots2="true" data-md-device="3" data-md-device-nav="false" data-md-device-dots="true">
              <?php foreach ($agenda as $key => $obj) { ?>
                  <div class="event-item home12-style">
                      <div class="event-short">
                          <div class="featured-img">
                              <img src="<?= __UPLOAD ?>thumbnail/<?= $obj->foto; ?>" alt="Image">
                          </div>
                          <div class="content-part">
                              <div class="all-dates-time">
                                  <?php $ketegori = $this->db->get_where('fr_kategori_berita', array('id' => $obj->kategori))->row(); ?>
                                  <div class="address"><i class="fa fa-map-o"></i> <?= $ketegori->nama; ?></div>
                                  <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> <?= __time($obj->jam_mulai); ?> - <?= __time($obj->jam_selesai); ?></div>
                              </div>
                              <h4 class="title"><a href="#"><?= $obj->title; ?></a></h4>
                              <div class="event-btm">
                                  <div class="date-part">
                                      <div class="date">
                                          <i class="fa fa-calendar-check-o"></i>
                                          <?= __date($obj->tanggal) ?>
                                      </div>
                                  </div>
                                  <div class="btn-part">
                                      <a href="#">Join Event</a>
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

      <!-- Events Section Start -->
      <!-- <div class="rs-event modify1 orange-color pt-100 pb-100 md-pt-70 md-pb-70">
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
      </div> -->
      <!-- Events Section End -->