  <!-- Slider Section Start -->
  <div class="rs-slider style1">
      <div class="rs-carousel owl-carousel " style="opacity: 0.7;" data-loop="true" data-items="1" data-margin="0" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="1" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="true" data-ipad-device-dots2="false" data-md-device="1" data-md-device-nav="true" data-md-device-dots="false">
          <?php foreach ($slider as $key => $obj) { ?>
              <div class="slider-content slide1 " style="background: url(assets/backend/uploads/original/<?= $obj->slider; ?>);   background-size: cover;  background-position: center; background-repeat: no-repeat;">
                  <div class="container">
                      <div class="sl-title  white-color wow bounceInLeft" data-wow-delay="300ms" data-wow-duration="2000ms">
                          <?= $obj->title; ?>
                      </div>
                      <h1 class="sl-sub-title white-color wow fadeInRight" data-wow-delay="600ms" data-wow-duration="2000ms">
                          <?= $obj->subtitle; ?>
                      </h1>
                  </div>
              </div>
          <?php } ?>
      </div>
  </div>
  <!-- Banner Section End -->

  <!-- About Section Start -->
  <div id="rs-about" class="rs-about style4 pt-100 pb-100 md-pt-80 md-pb-80">
      <div class="container">
          <div class="row">
              <div class="col-lg-5 md-mb-50">
                  <div class="img-part">
                      <img class="about-main" style="height: 350px; left: 50%; transform: translateX(-50%);" src="<?= __UPLOAD; ?>original/<?= $kata_sambutan->foto; ?>" alt="About Image">
                      <img class="circle-bg shape"  src="<?= site_url('assets/frontend/') ?>images/about/home5/about-circle-bg.png" alt="About Image">
                      <img class="small-circle shape animated pulse infinite" src="<?= site_url('assets/frontend/') ?>images/about/home5/small-circle-shape.png" alt="About Image">
                      <!-- <img class="deep-bg shape"  src="<?= site_url('assets/frontend/') ?>images/about/home5/about-deep-bg.png" alt="About Image"> -->
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



  <!-- Choose Section Start -->
  <div class="why-choose-us style3">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-6 js-tilt md-mb-40">
                  <div class="img-part">
                      <img src="<?= site_url('assets/frontend/') ?>images/choose/home12/1.png" alt="">

                  </div>
              </div>
              <div class="col-lg-6 pl-60 md-pl-15">
                  <div class="sec-title3 mb-30">
                      <h2 class=" title new-title margin-0 pb-15">VISI dan Misi </h2>
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


  <div id="rs-team" class="rs-team home11-style gray-bg3 pt-100 pb-100 md-pt-70 md-pb-70">
      <div class="container">
          <div class="sec-title4 text-center text-center mb-45">
              <div class="sub-title" style="color:#0c8b51;">Meet Our Staffs</div>
              <h2 class="title black-color">Excellent Teachers</h2>
          </div>
          <div class="rs-carousel owl-carousel nav-style2" data-loop="true" data-items="4" data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="true" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="4" data-md-device-nav="true" data-md-device-dots="false">
              <?php foreach ($guru_staf as $key => $obj) { ?>
                  <div class="team-item">
                      <div class="team-thumbnail">
                          <div class="team-img">
                              <img src="<?= __UPLOAD ?>original/<?= $obj->foto; ?>" alt="">
                              <!-- <ul class="team-social-link">
                                  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                  <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                  <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                              </ul> -->
                          </div>
                          <div class="team-header">
                              <h4 class="name"><a href="#" style="color:#0c8b51;"><?= $obj->nama; ?></a></h4>
                              <span class="subject"><?= $obj->bidang_ilmu; ?></span>
                          </div>
                      </div>
                  </div>
              <?php } ?>
          </div>
      </div>
  </div>
  <!-- Team Section End -->



  <!-- Counter Section End -->
  <div class="rs-counter home12-style pt-80">
      <div class="container">
          <div class="row couter-area bg8">
              <div class="col-lg-3 col-md-6 md-mb-30">
                  <div class="counter-item text-center">
                      <h2 class="rs-count pr-0">50</h2>
                      <span class="prefix">k</span>
                      <h4 class="title mb-0">Lulusan</h4>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6 md-mb-30">
                  <div class="counter-item text-center">
                      <h2 class="number rs-count kplus">70</h2>
                      <h4 class="title mb-0">Guru & Karyawan</h4>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6 sm-mb-30">
                  <div class="counter-item text-center">
                      <h2 class="rs-count plus">120</h2>
                      <h4 class="title mb-0">Siswa</h4>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6">
                  <div class="counter-item text-center">
                      <h2 class="rs-count percent">99</h2>
                      <h4 class="title mb-0">Kelas</h4>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Counter Section Start -->

  <!-- Faq Section Start -->
  <!-- <div class="rs-faq-part style1 pt-100 pb-100 md-pt-70 md-pb-70">
      <div class="container">
          <div class="row">
              <div class="col-lg-6 padding-0 col-md-12 md-mb-40">
                  <div class="main-part new-style">
                      <div class="title mb-21">
                          <h2 class="text-part mb-0">Frequently Asked Questions</h2>
                      </div>
                      <div class="faq-content">
                          <div class="accordion" id="accordionExample">
                              <div class="accordion-item card">
                                  <div class="accordion-header card-header" id="headingOne">
                                      <button class="accordion-button card-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">What are the
                                          requirements ?</button>
                                  </div>
                                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                      <div class="accordion-body card-body">Lorem ipsum dolor sit amet,
                                          consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper
                                          mattis, pulvinar dapibus leo ducimus qui blanditiis praesentium ducimus
                                          qui.</div>
                                  </div>
                              </div>
                              <div class="accordion-item card">
                                  <div class="accordion-header card-header" id="headingTwo">
                                      <button class="card-link accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Does Educavo offer
                                          free courses?</button>
                                  </div>
                                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                      <div class="accordion-body card-body">Lorem ipsum dolor sit amet,
                                          consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper
                                          mattis, pulvinar dapibus leo ducimus qui blanditiis praesentium ducimus
                                          qui.</div>
                                  </div>
                              </div>
                              <div class="accordion-item card">
                                  <div class="accordion-header card-header" id="headingThree">
                                      <button class="card-link accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">What is the transfer
                                          application process?</button>
                                  </div>
                                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                      <div class="accordion-body card-body">Lorem ipsum dolor sit amet,
                                          consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper
                                          mattis, pulvinar dapibus leo ducimus qui blanditiis praesentium ducimus
                                          qui.</div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6 padding-0 col-md-12">
                  <div class="rs-free-contact">
                      <div class="sec-title3">
                          <h2 class="title white-color">Register Free Courses</h2>
                      </div>
                      <form id="contact-form" method="post" action="mailer.php">
                          <div class="row">
                              <div class="col-lg-6 mb-30 col-md-12">
                                  <input class="from-control" type="text" id="name" name="name" placeholder="Name" required="">
                              </div>
                              <div class="col-lg-6 mb-30 col-md-12">
                                  <input class="from-control" type="text" id="email" name="email" placeholder="Email" required="">
                              </div>
                              <div class="col-lg-6 mb-30 col-md-12">
                                  <input class="from-control" type="text" id="phone" name="phone" placeholder="Phone" required="">
                              </div>
                              <div class="col-lg-6 mb-30 col-md-12">
                                  <input class="from-control" type="text" id="subject" name="subject" placeholder="Subject" required="">
                              </div>

                              <div class="col-lg-12 mb-35">
                                  <textarea class="from-control" id="message" name="message" placeholder=" Message" required=""></textarea>
                              </div>
                          </div>
                          <div class="form-btn">
                              <input class=" readon submit-requset" type="submit" value="Submit-Requset">
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div> -->
  <!-- faq Section Start -->

  <!-- Testimonial Section Start -->
  <div class="rs-testimonial home12-style">
      <div class="container">
          <div class="sec-title4 mb-50 md-mb-30 text-center">
              <div class="sub-title primary">Testimonial</div>
              <h2 class="title mb-0">What Our Students Says</h2>
          </div>
          <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="true" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="3" data-md-device-nav="false" data-md-device-dots="false">

              <?php foreach ($testimonial as $key => $obj) { ?>
                  <div class="testi-item">
                      <div class="item-content-basic">
                          <div class="desc"><img class="quote" src="<?= site_url('assets/frontend/') ?>images/testimonial/home12/quote.png" alt=""><?= $obj->testimonial; ?></div>
                          <div class="testi-content">
                              <div class="img-wrap">
                                  <img src="<?= __UPLOAD ?>original/<?= $obj->foto; ?>" alt="">
                              </div>
                              <div class="name">
                                  <?= $obj->nama ?>
                              </div>
                          </div>
                      </div>
                  </div>
              <?php } ?>
          </div>
      </div>
  </div>
  <!-- Testimonial Section End -->


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
                                  <div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> <?=  ___datetime($obj->tanggal_selesai); ?></div>
                              </div>
                              <h4 class="title"><a href="#"><?= $obj->title; ?></a></h4>
                              <div class="event-btm">
                                  <!-- <div class="date-part">
                                      <div class="date">
                                          <i class="fa fa-calendar-check-o"></i>
                                          <?= __datetime($obj->tanggal_mulai) ?>
                                      </div>
                                  </div> -->
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

  <!-- Blog Section Start -->
  <div id="rs-blog" class="rs-blog main-home modify1 pb-100 pt-100 md-pt-70 md-pb-70">
      <div class="container">
          <div class="sec-title4 text-center mb-50">
              <div class="sub-title"> News Update</div>
              <h2 class="title">Latest News & Article's</h2>
          </div>
          <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="3" data-md-device-nav="false" data-md-device-dots="false">

              <?php foreach ($berita as $key => $obj) { ?>
                  <div class="blog-item">
                      <div class="image-part">
                          <img src="<?= __UPLOAD; ?>thumbnail/<?= $obj->thumbnail; ?>" alt="">
                      </div>
                      <div class="blog-content">
                          <div class="blog-meta">
                              <span class="date"><i class="fa fa-calendar-check-o"></i><?= __date($obj->created_at); ?></span>
                              <span class="admin"><i class="fa fa-user"></i> admin</span>
                          </div>
                          <h3 class="title"><a href="blog-single.html"><?= $obj->title; ?></a></h3>
                          <div class="btn-btm">
                              <div class="cat-list">
                                  <ul class="post-categories">
                                      <?php $ketegori = $this->db->get_where('fr_kategori_berita', array('id' => $obj->kategori))->row(); ?>
                                      <li><a href="#"><?= $ketegori->nama; ?></a></li>
                                  </ul>
                              </div>
                              <div class="rs-view-btn">
                                  <a href="<?= site_url('home/berita_detail/'.$obj->id); ?>" class="blog-btn" data-id="<?= $obj->id; ?>">Continue Reading</a>
                              </div>
                          </div>
                      </div>
                  </div>
              <?php } ?>
          </div>
      </div>
  </div>
  <!-- Blog Section End -->

  <!-- About Section Start -->
  <div class="rs-about style5 pt-110 pb-110 md-pt-70 md-pb-70">
      <div class="container">
          <div class="row">
              <div class="col-lg-4">
                  <div class="about-content">
                      <div class="sec-title mb-46 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms">
                          <h2 class="title mb-15">Don’t Hesitate to <br>Contact Me</h2>
                          <div class="sub-title">Contact Me Now</div>
                      </div>
                      <ul class="contact-part wow fadeInUp" data-wow-delay="400ms" data-wow-duration="2000ms">
                          <li>
                              <div class="img-part">
                                  <img src="<?= site_url('assets/frontend/') ?>images/about/icon/1.png" alt="">
                              </div>
                              <div class="desc">
                                  <span>Phone Number</span>
                                  <span><a href="tel:<?= $_setting->phone; ?>"><?= $_setting->phone; ?></a></span>
                              </div>
                          </li>
                          <li>
                              <div class="img-part">
                                  <img src="<?= site_url('assets/frontend/') ?>images/about/icon/2.png" alt="">
                              </div>
                              <div class="desc">
                                  <span>Email Address</span>
                                  <span><a href="mailto:<?= $_setting->email; ?>"><?= $_setting->email; ?></a></span>
                              </div>
                          </li>
                          <li>
                              <div class="img-part">
                                  <img src="<?= site_url('assets/frontend/') ?>images/about/icon/3.png" alt="">
                              </div>
                              <div class="desc">
                                  <span>Address</span>
                                  <span class="address"><?= $_setting->address; ?></span>
                              </div>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- About Section End -->

  <script src="<?= site_url('assets/frontend/') ?>js/main.js"></script>