
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-eye"></i> View Guru</h4>
		<div class="card">
			<div class="card-body">
                    <div class="form-group row">
                        <label for="foto" class="col-md-4 col-form-label">Foto</label>
                        <div class="col-md-8">
                        <?php if(!empty($guru->foto)){ ?>
                            <img id="no_foto" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/'.$guru->foto ?>" />
                        <?php }else{ ?>
                            <img id="no_foto" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/no_image.png'?>" />
                        <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label">Nama</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?= $guru->nama; ?>" placeholder="Nama" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bidang_ilmu" class="col-md-4 col-form-label">Bidang Ilmu</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?= $guru->bidang_ilmu; ?>" placeholder="Bidang Ilmu" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?= $guru->note; ?>" placeholder="Note" disabled>
                        </div>
                    </div>
                <div id="show-activitylog"></div>
                <?php if(is_superadmin()){?>
                    <button type="button" id="data_log" class="btn btn-danger button_activitylog" data-url="frontend/guru/activitylog" data-id="<?= $guru->id ?>" >Activitylogs </button>
                <?php } ?>
                <button type="button" id="btn_back" data-url="frontend/guru" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
			</div>
		</div>
	</div>
</div>
