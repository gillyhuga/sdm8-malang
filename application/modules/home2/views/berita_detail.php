      <!-- Breadcrumbs Start -->
      <div class="rs-breadcrumbs breadcrumbs-overlay">
          <div class="breadcrumbs-img">
              <img src="<?= site_url('assets/frontend/') ?>images/breadcrumbs/1.jpg" alt="Breadcrumbs Image">
          </div>
          <div class="breadcrumbs-text ">
              <h1 class="page-title">Detail Berita</h1>
          </div>
      </div>
      <!-- Breadcrumbs End -->


      <!-- Blog Section Start -->
      <div class="rs-inner-blog orange-color pt-100 pb-100 md-pt-70 md-pb-70">
          <div class="container">
              <div class="blog-deatails">
                  <div class="bs-img">
                      <a href="#"><img src="<?= __UPLOAD; ?>original/<?= $berita->thumbnail;?>" alt=""></a>
                  </div>
                  <div class="blog-full">
                      <ul class="single-post-meta">
                          <li>
                              <span class="p-date"> <i class="fa fa-calendar-check-o"></i> <?= __date($berita->created_at);?> </span>
                          </li>
                          <li>
                              <span class="p-date"> <i class="fa fa-user-o"></i> admin </span>
                          </li>
                          <li class="Post-cate">
                              <div class="tag-line">
                                  <i class="fa fa-book"></i>
                                  <?php $data=  $this->db->get_where('fr_kategori_berita', array('id' => $berita->kategori))->row(); ?>
                                  <a href="#"><?= $data->nama;?></a>
                              </div>
                          </li>
                          <li class="post-comment"> <i class="fa fa-comments-o"></i> 0</li>
                      </ul>
                      <div class="blog-desc">
                          <p>
                              <?= $berita->content; ?>
                          </p>
                          <button type="button" id="btn_back" data-url="home/berita" class="btn btn-outline-success">Back list</button>
                          <button type="button" id="btn_back" data-url="home/page" class="btn btn-outline-primary">Back to beranda</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Blog Section End -->