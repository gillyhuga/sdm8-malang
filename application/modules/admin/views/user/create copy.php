<div class="row justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-plus"></i> Add User</h4>
        <div class="card">
            <div class="card-body">
                <form class="form_validation" id="post-data" data-url="admin/user/store">
                    <?= csrf(); ?>
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label">Nama</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hp" class="col-md-4 col-form-label">Hp</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="hp" name="hp" placeholder="Hp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-md-4 col-form-label">Alamat</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="alamat" name="alamat" placeholder="Alamat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_kelamin" class="col-md-4 col-form-label">Jenis Kelamin</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="jenis_kelamin" name="jenis_kelamin" placeholder="Jenis Kelamin">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_lahir" class="col-md-4 col-form-label">Tanggal Lahir</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="facebook" class="col-md-4 col-form-label">Facebook</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="facebook" name="facebook" placeholder="Facebook">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="instagram" class="col-md-4 col-form-label">Instagram</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="instagram" name="instagram" placeholder="Instagram">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="youtube" class="col-md-4 col-form-label">Youtube</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="youtube" name="youtube" placeholder="Youtube">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="twitter" class="col-md-4 col-form-label">Twitter</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="twitter" name="twitter" placeholder="Twitter">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="other_info" class="col-md-4 col-form-label">Other Info</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="other_info" name="other_info" placeholder="Other Info">
                        </div>
                    </div>
                    <h4 class="btn btn-sm btn-block btn-danger">Account Login</h4>
                    <div class="form-group row">
                        <label for="role_id" class="col-md-4 col-form-label">Role Permission</label>
                        <div class="col-md-8">
                            <?php $role = $this->db->get_where('roles', array('status' => 1))->result(); ?>
                            <select class="form-control select2" name="role_id" id="role_id" style="width: 100%;">
                                <option value="">Select</option>
                                <?php foreach ($role as $key => $obj) { ?>
                                    <option value="<?= $obj->id; ?>"><?= $obj->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">Email Address</label>
                        <div class="col-md-8">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label">Password</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password2" class="col-md-4 col-form-label">Confirm Password</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-icon btn-primary waves-effect waves-classic">Submit</button>
                    <button type="button" id="btn_back" data-url="admin/user" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#nama').focus();

    $('.select2').select2({
        placeholder: "Select",
        allowClear: true
    });

    (function() {
        $('.form_validation').formValidation({
            framework: "bootstrap4",
            button: {
                selector: '#submit',
                disabled: 'disabled'
            },
            icon: null,
            fields: {
                nama: {
                    validators: {
                        notEmpty: {
                            message: 'The Nama is required'
                        },
                    }
                },
                hp: {
                    validators: {
                        notEmpty: {
                            message: 'The Hp is required'
                        },
                    }
                },
                alamat: {
                    validators: {
                        notEmpty: {
                            message: 'The Alamat is required'
                        },
                    }
                },
                jenis_kelamin: {
                    validators: {
                        notEmpty: {
                            message: 'The Jenis kelamin is required'
                        },
                    }
                },
                tanggal_lahir: {
                    validators: {
                        notEmpty: {
                            message: 'The Tanggal lahir is required'
                        },
                    }
                },
                facebook: {
                    validators: {
                        notEmpty: {
                            message: 'The Facebook is required'
                        },
                    }
                },
                instagram: {
                    validators: {
                        notEmpty: {
                            message: 'The Instagram is required'
                        },
                    }
                },
                youtube: {
                    validators: {
                        notEmpty: {
                            message: 'The Youtube is required'
                        },
                    }
                },
                twitter: {
                    validators: {
                        notEmpty: {
                            message: 'The Twitter is required'
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