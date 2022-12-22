
<div class="row justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-eye"></i> View User</h4>
		<div class="card">
			<div class="card-body">
                    <div class="form-group row">
                        <label for="photo" class="col-md-4 col-form-label">Photo</label>
                        <div class="col-md-8">
                <?php if(!empty($user->photo)){ ?>
                    <img id="no_photo" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/'.$user->photo ?>" />
                <?php }else{ ?>
                    <img id="no_photo" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/no_user.png'?>" />
                <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label">Nama</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" value="<?= $user->nama; ?>" placeholder="Nama" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_kelamin" class="col-md-4 col-form-label">Jenis Kelamin</label>
                        <div class="col-md-8">
                            <select class="form-control select2"  id="jenis_kelamin" name="jenis_kelamin" style="width: 100%;" disabled>
                                <option value="0" <?php if($user->jenis_kelamin == 0) echo 'selected'; ?>>Laki-laki</option>
                                <option value="1" <?php if($user->jenis_kelamin == 1) echo 'selected'; ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hp" class="col-md-4 col-form-label">Hp</label>
                        <div class="col-md-8">
                            <input class="form-control" value="<?= $user->hp ?>" placeholder="Hp" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-md-4 col-form-label">Alamat</label>
                        <div class="col-md-8">
                            <textarea class="form-control"  rows="4" placeholder="Alamat" disabled><?= $user->alamat ?></textarea>
                        </div>
                    </div>
                    <div id="show-activitylog"></div>
                    <?php if(is_superadmin()){?>
                        <button type="button" id="data_log" class="btn btn-danger button_activitylog" data-url="master/user/activitylog" data-id="<?= $user->uuid ?>" >Activitylogs </button>
                    <?php } ?>
                    <button type="button" id="btn_back" data-url="master/user" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
			</div>
		</div>
	</div>
</div>
