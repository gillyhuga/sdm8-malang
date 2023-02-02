      <!-- Breadcrumbs Start -->
      <div class="rs-breadcrumbs breadcrumbs-overlay">
          <div class="breadcrumbs-img">
              <img src="<?= site_url('assets/frontend/') ?>images/breadcrumbs/1.jpg" alt="Breadcrumbs Image">
          </div>
          <div class="breadcrumbs-text ">
              <h1 class="page-title">Berita</h1>
          </div>
      </div>
      <!-- Breadcrumbs End -->
      <!-- Blog Section Start -->
      <div class="rs-inner-blog orange-color pt-100 pb-100 md-pt-70 md-pb-70">
          <div class="container">
              <div class="row">
                  <div class="col-lg-4 col-md-12 order-last">
                      <div class="widget-area">
                          <div class="search-widget mb-50">
                              <div class="search-wrap">
                                  <input type="search" placeholder="Searching..." name="s" class="search-input" value="">
                                  <button type="submit" value="Search"><i class=" flaticon-search"></i></button>
                              </div>
                          </div>
                          <div class="recent-posts-widget mb-50">
                              <h3 class="widget-title">Recent Posts</h3>
                              <?php foreach ($latest as $key => $obj) { ?>
                                <div class="show-featured ">
                                  <div class="post-img">
                                      <a href="#"><img src="<?= __UPLOAD; ?>/thumbnail/<?= $obj->thumbnail?>" alt=""></a>
                                  </div>
                                  <div class="post-desc">
                                      <a href="#"><?= $obj->title; ?></a>
                                      <span class="date">
                                          <i class="fa fa-calendar"></i>
                                          <?= __date($obj->created_at); ?>
                                      </span>
                                  </div>
                              </div>
                              <?php } ?>
                          </div>
                          <div class="widget-archives mb-50">
                              <h3 class="widget-title">Archives</h3>
                              <ul>
                                  <li><a href="#">September 2022</a></li>
                                  <li><a href="#">September 2022</a></li>
                              </ul>
                          </div>
                          <div class="widget-archives mb-50">
                              <h3 class="widget-title">Categories</h3>
                              <ul>
                                <?php foreach ($kategori as $key => $obj) { ?>
                                    <li><a href="#"><?= $obj->nama; ?></a></li>
                                <?php } ?>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-8 pr-50 md-pr-15">
                      <div class="row">
                          <?php foreach ($berita as $key => $obj) { ?>
                              <div class="col-lg-12 mb-70">
                                  <div class="blog-item">
                                      <div class="blog-img">
                                          <a href="#"><img src="<?= __UPLOAD; ?>/original/<?= $obj->thumbnail?>" alt=""></a>
                                      </div>
                                      <div class="blog-content">
                                          <h3 class="blog-title"><a href="#"><?= $obj->title; ?></a></h3>
                                          <div class="blog-meta">
                                              <ul class="btm-cate">
                                                  <li>
                                                      <div class="blog-date">
                                                          <i class="fa fa-calendar-check-o"></i> <?= __date($obj->created_at); ?>
                                                      </div>
                                                  </li>
                                                  <li>
                                                      <div class="author">
                                                          <i class="fa fa-user-o"></i> admin
                                                      </div>
                                                  </li>
                                                  <li>
                                                      <div class="tag-line">
                                                          <i class="fa fa-book"></i>
                                                          <?php $data = $this->home->get_single('fr_kategori_berita', array('id' => $obj->kategori)); ?>
                                                          <a href="#"><?= $data->nama; ?></a>
                                                      </div>
                                                  </li>
                                              </ul>
                                          </div>
                                          <div class="blog-desc">
                                               <?= cutText($obj->content, 400); ?>
                                          </div>
                                          <div class="blog-button">
                                              <a class="blog-btn berita_detail"  data-id="<?= $obj->id;?>" href="#">Continue Reading</a>
                                            </div>
                                      </div>
                                  </div>
                              </div>
                          <?php } ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Blog Section End -->
      