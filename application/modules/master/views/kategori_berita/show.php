
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-eye"></i> View Kategori_berita</h4>
		<div class="card">
			<div class="card-body">
                    <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                            <select class="form-control select2"  id="kategori" name="kategori" style="width: 100%;" disabled>
                                <option value="0" <?php if($kategori_berita->kategori == 0) echo 'selected'; ?>>Berita</option>
                                <option value="1" <?php if($kategori_berita->kategori == 1) echo 'selected'; ?>>Agenda</option>
                                <option value="2" <?php if($kategori_berita->kategori == 2) echo 'selected'; ?>>Galleri</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label">Nama</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?= $kategori_berita->nama; ?>" placeholder="Nama" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?= $kategori_berita->note; ?>" placeholder="Note" disabled>
                        </div>
                    </div>
                <div id="show-activitylog"></div>
                <?php if(is_superadmin()){?>
                    <button type="button" id="data_log" class="btn btn-danger button_activitylog" data-url="master/kategori_berita/activitylog" data-id="<?= $kategori_berita->id ?>" >Activitylogs </button>
                <?php } ?>
                <button type="button" id="btn_back" data-url="master/kategori_berita" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
			</div>
		</div>
	</div>
</div>
