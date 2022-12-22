
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-12 col-lg-8">
        <h4 class="card-header btn-primary"> <i class="icon md-eye"></i> View Galeri</h4>
		<div class="card">
			<div class="card-body">
                    <div class="form-group row">
                        <label for="foto" class="col-md-4 col-form-label">Foto</label>
                        <div class="col-md-8">
                        <?php if(!empty($galeri->foto)){ ?>
                            <img id="no_foto" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= @__UPLOAD.'thumbnail/'.$galeri->foto ?>" />
                        <?php }else{ ?>
                            <img id="no_foto" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= @__UPLOAD.'thumbnail/no_image.png'?>" />
                        <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                        <?php $kategori_single = $this->galeri->get_single('fr_kategori_berita', array('id' => $galeri->kategori)); ?>
                        <input class="form-control" type="text" value="<?= @$kategori_single->nama ?>" placeholder="Kategori" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-md-4 col-form-label">Deskripsi</label>
                        <div class="col-md-8">
                        <textarea class="form-control"  rows="4" placeholder="Deskripsi" readonly><?= $galeri->deskripsi ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal" class="col-md-4 col-form-label">Tanggal</label>
                        <div class="col-md-8">
                        <input class="form-control datepicker" type="text"  value="<?= @__date($galeri->tanggal)?>" placeholder="Tanggal" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?= $galeri->note; ?>" placeholder="Note" readonly>
                        </div>
                    </div>
                <div id="show-activitylog"></div>
                <?php if(is_superadmin()){?>
                    <button type="button" id="data_log" class="btn btn-danger button_activitylog" data-url="kesiswaan/galeri/activitylog" data-id="<?= $galeri->id ?>" >Activitylogs </button>
                <?php } ?>
                <button type="button" id="btn_back" data-url="kesiswaan/galeri" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
			</div>
		</div>
	</div>
</div>
