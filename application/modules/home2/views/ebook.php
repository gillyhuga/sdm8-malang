      <!-- Breadcrumbs Start -->
      <div class="rs-breadcrumbs breadcrumbs-overlay">
          <div class="breadcrumbs-img">
              <img src="<?= site_url('assets/frontend/') ?>images/breadcrumbs/1.jpg" alt="Breadcrumbs Image">
          </div>
          <div class="breadcrumbs-text ">
              <h1 class="page-title">Ebook Detail</h1>
          </div>
      </div>
      <!-- Breadcrumbs End -->

      <div id="rs-single-shop" class="rs-single-shop shop-rp orange-color pt-100 pb-100 md-pt-70 md-pb-70">
          <div class="container">
              <div class="row">
                  <div class="col-md-6 col-sm-12 sm-mb-30">
                      <div class="single-product-image">
                          <div class="images-single">
                              <img src="<?= __UPLOAD ?>/original/<?= $ebook->cover;?>" alt="Single Product">
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                      <div class="single-price-info pl-30">
                          <h4 class="product-title"><?= $ebook->author;?></h4>
                          <p class="some-text"><?= $ebook->abstract;?></p>
                          <p class="category"><span>Category:</span><a href="#"> Business</a></p>
                          <a href="<?= __UPLOAD; ?>files/<?= $ebook->file;?>" target="_blank" class="btn btn-outline-primary">Read book</a>
                          <button type="button" id="btn_back" data-url="home/ebook_list" class="btn btn-success">Back list</button>
                      </div>
                  </div>
              </div>

          </div>
      </div>