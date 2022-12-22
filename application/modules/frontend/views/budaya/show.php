
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-eye"></i> View Budaya</h4>
		<div class="card">
			<div class="card-body">
                    <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                            <select class="form-control select2"  id="kategori" name="kategori" style="width: 100%;" disabled>
                                <option value="0" <?php if($budaya->kategori == 0) echo 'selected'; ?>>Aqidah yang kuat</option>
                                <option value="1" <?php if($budaya->kategori == 1) echo 'selected'; ?>>Ibadah yang benar</option>
                                <option value="2" <?php if($budaya->kategori == 2) echo 'selected'; ?>>Akhlak karima</option>
                                <option value="3" <?php if($budaya->kategori == 3) echo 'selected'; ?>> Disiplin dan mandiri</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-md-4 col-form-label">Deskripsi</label>
                        <div class="col-md-8">
                        <textarea class="form-control"  rows="4" placeholder="Deskripsi" disabled><?= $budaya->deskripsi ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?= $budaya->note; ?>" placeholder="Note" disabled>
                        </div>
                    </div>
                <div id="show-activitylog"></div>
                <?php if(is_superadmin()){?>
                    <button type="button" id="data_log" class="btn btn-danger button_activitylog" data-url="frontend/budaya/activitylog" data-id="<?= $budaya->id ?>" >Activitylogs </button>
                <?php } ?>
                <button type="button" id="btn_back" data-url="frontend/budaya" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
			</div>
		</div>
	</div>
</div>
