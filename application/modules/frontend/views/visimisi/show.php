
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-eye"></i> View Visimisi</h4>
		<div class="card">
			<div class="card-body">
                    <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                            <select class="form-control select2"  id="kategori" name="kategori" style="width: 100%;" disabled>
                                <option value="0" <?php if($visimisi->kategori == 0) echo 'selected'; ?>>Visi</option>
                                <option value="1" <?php if($visimisi->kategori == 1) echo 'selected'; ?>>Misi</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-md-4 col-form-label">Deskripsi</label>
                        <div class="col-md-8">
                        <textarea class="form-control"  rows="4" placeholder="Deskripsi" disabled><?= $visimisi->deskripsi ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?= $visimisi->note; ?>" placeholder="Note" disabled>
                        </div>
                    </div>
                <div id="show-activitylog"></div>
                <?php if(is_superadmin()){?>
                    <button type="button" id="data_log" class="btn btn-danger button_activitylog" data-url="frontend/visimisi/activitylog" data-id="<?= $visimisi->id ?>" >Activitylogs </button>
                <?php } ?>
                <button type="button" id="btn_back" data-url="frontend/visimisi" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
			</div>
		</div>
	</div>
</div>
