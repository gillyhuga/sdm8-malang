<div class="row justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-edit"></i> Reset Privilege</h4>
        <div class="card">
            <div class="card-body">
                <form class="form_validation" id="post-data" data-url="administrator/privilege/store">
                    <?= csrf(); ?>
                    <input type="hidden" id="uuid" name="uuid" value="<?= $privilege->uuid; ?>">
                    <input type="hidden" id="type" name="type" value="reset">
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">Old Permission Access</label>
                        <div class="col-md-8">
                            <select class="form-control select2" name="old_permission" id="old_permission" style="width: 100%;">
                                <option value="">Select</option>
                                <?php foreach ($permission as $key => $obj) { ?>
                                    <option value="<?= $obj->id; ?>"><?= $obj->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new" class="col-md-4 col-form-label">New Permission Access</label>
                        <div class="col-md-8">
                            <select class="form-control select2" name="new_permission" id="new_permission" style="width: 100%;">
                                <option value="">Select</option>
                                <?php foreach ($permission as $key => $obj) { ?>
                                    <option value="<?= $obj->id; ?>"><?= $obj->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="auth" class="col-md-4 col-form-label">Admin Password</label>
                        <div class="col-md-8">
                            <input type="hidden" id="_auth" name="_auth" value="<?= $this->session->userdata('uuid'); ?>">
                            <input class="form-control" type="password" id="auth" name="auth" placeholder="Admin Password">
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-icon btn-primary waves-effect waves-classic">Submit</button>
                    <button type="button" id="btn_back" data-url="administrator/privilege" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#old_permission').focus();
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
                old_permission: {
                    validators: {
                        notEmpty: {
                            message: 'The old permission is required'
                        },
                        remote: {
                            message: 'The old permission not authenticate!',
                            url: '<?= site_url('administrator/privilege/check_old_privilege') ?>',
                            type: 'POST',
                            delay: 250,
                            data: function() {
                                return {
                                    id: $('#uuid').val(),
                                };
                            },
                        }
                    }
                },
                new_permission: {
                    validators: {
                        notEmpty: {
                            message: 'The new permission is required'
                        },
                        remote: {
                            message: 'The old and new permission is equal',
                            url: '<?= site_url('administrator/privilege/check_new_privilege') ?>',
                            type: 'POST',
                            delay: 250,
                            data: function() {
                                return {
                                    id: $('#uuid').val(),
                                    old_permission: $('#old_permission').val(),
                                };
                            },
                        }
                    }
                },
                auth: {
                    validators: {
                        notEmpty: {
                            message: 'The admin password required'
                        },
                        remote: {
                            message: 'Your password not authentication',
                            url: '<?= site_url('administrator/privilege/check_auth') ?>',
                            type: 'POST',
                            delay: 250,
                            data: function() {
                                return {
                                    id: $('#uuid').val(),
                                    password: $('#auth').val(),
                                    _auth: $('#_auth').val(),
                                };
                            },
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