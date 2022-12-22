
<div class="row justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"><i class="icon md-edit"></i> Edit User</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="master/user/store">
                <?= csrf(); ?>
                <input type="hidden" id="uuid" name="uuid" value="<?= $user->uuid ?>">
                    <div class="form-group row">
                        <label for="photo" class="col-md-4 col-form-label">Photo</label>
                        <div class="col-md-8">
                            <div id="target_photo"></div>
                            <input type="hidden" name="prev_photo" id="prev_photo" value="<?= $user->photo ?>" />
                            <?php if(!empty($user->photo)){ ?>
                                <img id="no_photo" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/'.$user->photo ?>" />
                            <?php }else{ ?>
                                <img id="no_photo" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/no_user.png'?>" />
                            <?php } ?>
                            <div class="mt-2">
                                <span class="badge badge-info mt-2" style="font-size:.8rem;">Format: JPG, PNG (size: x pixel)</span>
                                <input id="photo" name="photo" type="file" class="inputFile" onChange="showPreview_photo(this);" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label">Nama</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="nama" name="nama" value="<?= $user->nama; ?>" placeholder="Nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_kelamin" class="col-md-4 col-form-label">Jenis Kelamin</label>
                        <div class="col-md-8">
                            <select class="form-control select2"  id="jenis_kelamin" name="jenis_kelamin" style="width: 100%;">
                                <option value="0"  <?php if($user->jenis_kelamin == 0) echo 'selected'; ?>>Laki-laki</option>
                                <option value="1"  <?php if($user->jenis_kelamin == 1) echo 'selected'; ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hp" class="col-md-4 col-form-label">Hp</label>
                        <div class="col-md-8">
                            <input class="form-control" type="number" id="hp" name="hp" value="<?= $user->hp ?>" placeholder="Hp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-md-4 col-form-label">Alamat</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="alamat" name="alamat" rows="4" placeholder="Alamat"><?= $user->alamat ?></textarea>
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-icon btn-success waves-effect waves-classic">Update</button>
                    <button type="button" id="btn_back" data-url="master/user" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
    $('#role').focus(); 
    function showPreview_photo(objFileInput) {
        if (objFileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function(e) {
                $('#no_photo').hide();
                $('#target_photo').show();
                $("#target_photo").html('<img src="' + e.target.result + '" width="120px" height="120px"  style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;"/>');
            }
            fileReader.readAsDataURL(objFileInput.files[0]);
        }else{
            $('#target_photo').hide();
            $('#no_photo').show();
            $("#no_photo").html('<img src="' + APP_URL + 'assets/backend/uploads/thumbnail/no_user.png" width="120px" height="120px"  style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;"/>');
        }
    }
         
    $('.select2').select2({
        placeholder: "Select",
        allowClear: true
    });
    (function () {  
        $('.form_validation').formValidation({
            framework: "bootstrap4",
            button: {
                selector: '#submit',
                disabled: 'disabled'
            },
            icon: null,
            fields: { 
                role : {
                    validators: {
                        notEmpty: {
                            message : 'The Role is required'
                        },
                    }
                },
                email : {
                    validators: {
                        notEmpty: {
                            message : 'The Email is required'
                        },
                    }
                },
                nama : {
                    validators: {
                        notEmpty: {
                            message : 'The Nama is required'
                        },
                    }
                },
                jenis_kelamin : {
                    validators: {
                        notEmpty: {
                            message : 'The Jenis kelamin is required'
                        },
                    }
                },
                hp : {
                    validators: {
                        notEmpty: {
                            message : 'The Hp is required'
                        },
                    }
                },
                alamat : {
                    validators: {
                        notEmpty: {
                            message : 'The Alamat is required'
                        },
                    }
                },
            },
            err: {
                clazz: 'invalid-feedback'
            },
            control: {
                valid: 'is-valid',
                invalid: 'is-invalid'
            },
            row: {
                invalid: 'has-danger',
            },
        })
    })();
</script>