
<div class="row justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-plus"></i> Add User</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="master/user/store">
					<?= csrf(); ?>
                    <div class="form-group row">
                        <label for="photo" class="col-md-4 col-form-label">Photo</label>
                        <div class="col-md-8">
                            <div id="target_photo"></div>
                            <img id="no_photo" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD . 'thumbnail/no_user.png' ?>" />
                            <div class="mt-2">
                                <span class="badge badge-info mt-2" style="font-size:.8rem;">Format: JPG, PNG (size: x pixel)</span>
                                <input id="photo" name="photo" type="file" class="inputFile" onChange="showPreview_photo(this);" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label">Nama</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_kelamin" class="col-md-4 col-form-label">Jenis Kelamin</label>
                        <div class="col-md-8">
                            <select class="form-control select2"  id="jenis_kelamin" name="jenis_kelamin" style="width: 100%;">
                                <option value="0">Laki-laki</option>
                                <option value="1">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hp" class="col-md-4 col-form-label">Hp</label>
                        <div class="col-md-8">
                            <input class="form-control" type="number" id="hp" name="hp" placeholder="Hp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-md-4 col-form-label">Alamat</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="alamat" name="alamat" rows="4" placeholder="Alamat"></textarea>
                        </div>
                    </div>     
                    <input type="hidden" id="filestore" name="filestore" value="HYSwzJY=="/>
                    <input type="hidden" id="url" name="url" value="master/user"/>
                    <h4 class="btn btn-sm btn-block btn-danger">Account Login</h4>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label">Role</label>
                        <div class="col-md-8">
                            <select class="form-control select2" name="role" id="roel" style="width: 100%;">
                                <option value="">Select</option>
                                <?php $roles = $this->db->get_where('roles', array('status' => 1))->result(); ?>
                                <?php foreach ($roles as $key => $obj) { ?>
                                    <?php if ($obj->id == '1') continue; ?>
                                    <option value="<?= $obj->id; ?>"><?= $obj->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">Email</label>
                        <div class="col-md-8">
                            <input class="form-control" type="email" id="email" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label">Password</label>
                        <div class="col-md-8">
                            <input class="form-control" type="password" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="confirm_password" class="col-md-4 col-form-label">Password Confirm</label>
                        <div class="col-md-8">
                            <input class="form-control" type="password" id="confirm_password" name="confirm_password" placeholder="Password Confirm">
                        </div>
                    </div> 
                    <button type="submit" id="submit" class="btn btn-icon btn-primary waves-effect waves-classic">Submit</button>
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
                email : {
                    validators: {
                        notEmpty: {
                            message: 'The Email is required'
                        },
                        remote: {
                            message: 'This email has already been taken',
                            url:  'master/user/check_exist_email',
                            type: 'POST',
                            delay: 250,
                            data: function() {
                                return {
                                    email: $('#email').val(),
                                }
                            }
                        },
                    }
                },
                password : {
                    validators: {
                        notEmpty: {
                            message: 'The Password is required'
                        },
                        regexp: {
                            regexp: '^.{8,}$',
                            message: 'The Password can only minimum 8 characters'
                        }
                    }
                },
                confirm_password : {
                    validators: {
                        notEmpty: {
                            message: 'The Confirm Password is required'
                        },
                        regexp: {
                            regexp: '^.{8,}$',
                            message: 'The Password can only minimum 8 characters'
                        },
                        identical: {
                            field: 'password',
                            message: 'The password and its confirm are not the same'
                        }
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