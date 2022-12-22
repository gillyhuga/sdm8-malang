<div class="row justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
        <h4 class="card-header btn-primary"><i class="icon md-edit"></i> Edit Setting</h4>
        <div class="card">
            <div class="card-body">
                <form class="form_validation" id="post-data" data-url="setting/setting/store">
                    <?= csrf(); ?>
                    <input type="hidden" id="id" name="id" value="<?= $data->id ?>">
                    <div class="form-group row">
                        <label for="logo" class="col-md-4 col-form-label">Logo</label>
                        <div class="col-md-8">
                            <div id="target_logo"></div>
                            <input type="hidden" name="prev_logo" id="prev_logo" value="<?= $data->logo ?>" />
                            <?php if (!empty($data->logo)) { ?>
                                <img id="no_logo" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD . 'thumbnail/' . $data->logo ?>" />
                            <?php } else { ?>
                                <img id="no_logo" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD . 'thumbnail/no_image.png' ?>" />
                            <?php } ?>
                            <div class="mt-2">
                                <span class="badge badge-info mt-2" style="font-size:.8rem;">Format: JPG, PNG (size: 200x200 pixel)</span><br>
                                <input id="logo" name="logo" type="file" class="inputFile" onChange="showPreview_logo(this);" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Name</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="name" name="name" value="<?= $data->name; ?>" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label">Title</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="title" name="title" value="<?= $data->title; ?>" placeholder="Title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label">Address</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="address" name="address" rows="2" placeholder="Address"><?= $data->address ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label">Phone</label>
                        <div class="col-md-8">
                            <input class="form-control" type="number" id="phone" name="phone" value="<?= $data->phone ?>" placeholder="Phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="login" class="col-md-4 col-form-label">Login</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="login" name="login" value="<?= $data->login; ?>" placeholder="Login">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">Email</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="email" name="email" value="<?= $data->email; ?>" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meta_author" class="col-md-4 col-form-label">Meta Author</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="meta_author" name="meta_author" value="<?= $data->meta_author; ?>" placeholder="Meta Author">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meta_description" class="col-md-4 col-form-label">Meta Description</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="meta_description" name="meta_description" placeholder="Mete Description" rows="8" placeholder="Footer"><?= $data->meta_description ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="currency" class="col-md-4 col-form-label">Currency</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="currency" name="currency" value="<?= $data->currency; ?>" placeholder="Currency">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="currency_symbol" class="col-md-4 col-form-label">Currency Symbol</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="currency_symbol" name="currency_symbol" value="<?= $data->currency_symbol; ?>" placeholder="Currency Symbol">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="footer" class="col-md-4 col-form-label">Footer</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="footer" name="footer" rows="2" placeholder="Footer"><?= $data->footer ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="enable_frontend" class="col-md-4 col-form-label">Enable Frontend</label>
                        <div class="col-md-8">
                            <select class="form-control select2" id="enable_frontend" name="enable_frontend" style="width:100%;">
                                <option value="1" <?php if ($data->enable_frontend == 1) {
                                                        echo 'selected="selected"';
                                                    } ?>>Yes</option>
                                <option value="0" <?php if ($data->enable_frontend == 0) {
                                                        echo 'selected="selected"';
                                                    } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="facebook_url" class="col-md-4 col-form-label">Facebook Url</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="facebook_url" name="facebook_url" value="<?= $data->facebook_url; ?>" placeholder="Facebook Url">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="twitter_url" class="col-md-4 col-form-label">Twitter Url</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="twitter_url" name="twitter_url" value="<?= $data->twitter_url; ?>" placeholder="Twitter Url">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="google_plus_url" class="col-md-4 col-form-label">Google Plus Url</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="google_plus_url" name="google_plus_url" value="<?= $data->google_plus_url; ?>" placeholder="Google Plus Url">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="youtube_url" class="col-md-4 col-form-label">Youtube Url</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="youtube_url" name="youtube_url" value="<?= $data->youtube_url; ?>" placeholder="Youtube Url">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="instagram_url" class="col-md-4 col-form-label">Instagram Url</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="instagram_url" name="instagram_url" value="<?= $data->instagram_url; ?>" placeholder="Instagram Url">
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-icon btn-success waves-effect waves-classic">Update</button>
                    <button type="button" id="btn_back" data-url="dashboard/home" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#name').focus();

    function showPreview_logo(objFileInput) {
        if (objFileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function(e) {
                $('#no_logo').hide();
                $('#target_logo').show();
                $("#target_logo").html('<img src="' + e.target.result + '" width="120px" height="120px"  style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;"/>');
            }
            fileReader.readAsDataURL(objFileInput.files[0]);
        } else {
            $('#target_logo').hide();
            $('#no_logo').show();
            $("#no_logo").html('<img src="' + APP_URL + 'assets/backend/uploads/thumbnail/no_user.png" width="120px" height="120px"  style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;"/>');
        }
    }

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
                logo: {
                    validators: {
                        file: {
                            extension: 'jpeg,jpg,png',
                            type: 'image/jpeg,image/jpg,image/png',
                            maxSize: 2048 * 1024, //2MB
                            message: 'The selected file is not valid'
                        }
                    }
                },
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The Name is required'
                        },
                    }
                },
                title: {
                    validators: {
                        notEmpty: {
                            message: 'The Title is required'
                        },
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: 'The Address is required'
                        },
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'The Phone is required'
                        },
                    }
                },
                meta_author: {
                    validators: {
                        notEmpty: {
                            message: 'The Meta author is required'
                        },
                    }
                },
                meta_description: {
                    validators: {
                        notEmpty: {
                            message: 'The Mete description is required'
                        },
                    }
                },
                login: {
                    validators: {
                        notEmpty: {
                            message: 'The Login is required'
                        },
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The Email is required'
                        },
                    }
                },
                currency: {
                    validators: {
                        notEmpty: {
                            message: 'The Currency is required'
                        },
                    }
                },
                currency_symbol: {
                    validators: {
                        notEmpty: {
                            message: 'The Currency symbol is required'
                        },
                    }
                },
                footer: {
                    validators: {
                        notEmpty: {
                            message: 'The Footer is required'
                        },
                    }
                },
                enable_frontend: {
                    validators: {
                        notEmpty: {
                            message: 'The Enable frontend is required'
                        },
                    }
                },
                default_time_zone: {
                    validators: {
                        notEmpty: {
                            message: 'The Default time zone is required'
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