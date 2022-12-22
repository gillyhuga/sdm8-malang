      <!-- Breadcrumbs Start -->
      <div class="rs-breadcrumbs breadcrumbs-overlay">
          <div class="breadcrumbs-img">
              <img src="<?= site_url('assets/frontend/') ?>images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
          </div>
          <div class="breadcrumbs-text white-color">
              <h1 class="page-title">Ebook Karya Guru</h1>
          </div>
      </div>
      <!-- Breadcrumbs End -->



      <!-- Main content Start -->
          <!--Shop part start-->
          <div class="rs-shop-part orange-color pt-130 pb-130 md-pt-80 md-pb-80">
              <div class="container">
                  <div class="row rs-vertical-middle shorting mb-25">
                      <div class="col-sm-6 col-12">
                          <p class="woocommerce-result-count">Showing 1-9 of 12 results</p>
                      </div>
                      <div class="col-sm-6 col-12">
                          <select class="from-control">
                              <option>Default sorting</option>
                              <option>Sort by popularity</option>
                              <option>Sort by average rating</option>
                              <option>Sort by lates</option>
                              <option>Sort by price: low to high</option>
                              <option>Sort by price: high to low</option>
                          </select>
                      </div>
                  </div>
                  <div class="row">

                      <?php foreach ($ebooks as $key => $obj) { ?>
                          <div class="col-lg-4 col-md-6 col-12 mb-53">
                              <div class="product-list">
                                  <div class="image-product">
                                      <img src="<?= __UPLOAD; ?>thumbnail/<?= $obj->cover;?>" alt="">
                                  </div>
                                  <div class="content-desc text-center">
                                      <h2 class="loop-product-title pt-15 ebook_detail" data-id="<?= $obj->id;?>"><a href="#" ><?= $obj->title;?></a></h2>
                                  </div>
                              </div>
                          </div>
                      <?php } ?>
                  </div>
                  <div class="pagenav-link orange-color text-center">
                      <ul>
                          <li>1</li>
                          <li><a href="#">2</a></li>
                          <li><a href="#"><i class="flaticon-next"></i></a></li>
                      </ul>
                  </div>
              </div>
          </div>
          <!--Shop part end-->
      <!-- Main content End -->