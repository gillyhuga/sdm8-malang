      <!-- Breadcrumbs Start -->
      <div class="rs-breadcrumbs breadcrumbs-overlay">
          <div class="breadcrumbs-img">
          </div>
          <div class="breadcrumbs-text white-color">
              <h1 class="page-title">Galleri</h1>
          </div>
      </div>
      <!-- Breadcrumbs End -->

      <div class="rs-gallery1 pt-100 pb-100 md-pt-70 md-pb-70">
          <div class="container">
              <div class="row">
                  <?php foreach ($test as $obj) : ?>
                      <div class="col-lg-4 mb-30 col-md-6">
                          <div class="gallery-item">
                              <div class="gallery-img">
                                  <a class="image-popup" href="<?= __UPLOAD; ?>original/<?= $obj->foto; ?>"><img src="<?= __UPLOAD; ?>original/<?= $obj->foto; ?>" alt=""></a>
                              </div>
                              <div class="title">
                                  Group Study Time
                              </div>
                          </div>
                      </div>
                  <?php endforeach; ?>
              </div>
          </div>
      </div>