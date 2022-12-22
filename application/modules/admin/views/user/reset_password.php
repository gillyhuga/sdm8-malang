
<div class="row justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-edit"></i> Reset Password</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="admin/user/store">
					<?= csrf(); ?>
                    <input type="hidden" id="uuid" name="uuid" value="<?= $password->uuid; ?>">
                    <input type="hidden" id="type" name="type" value="reset">
                    <input type="hidden" id="_data" name="_data" value="password">
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label">New Password</label>
                        <div class="col-md-8">
                            <input class="form-control" type="password" id="password" name="password" placeholder="New Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password2" class="col-md-4 col-form-label">Confirm Password</label>
                        <div class="col-md-8">
                            <input class="form-control" type="password" id="password2" name="password2" placeholder="Confirm Password">
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
                    <button type="button" id="btn_back" data-url="admin/user" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script> 
    $('#password').focus();  
    (function () {  
        $('.form_validation').formValidation({
            framework: "bootstrap4",
            button: {
                selector: '#submit',
                disabled: 'disabled'
            },
            icon: null,
            fields: { 
                password : {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        },
                        regexp: {
                            regexp: '^.{8,}$',
                            message: 'The password can only minimum 8 characters'
                        }
                    }
                },
                password2 : {
                    validators: {
                        notEmpty: {
                            message: 'The confirm Password is required'
                        },
                        regexp: {
                            regexp: '^.{8,}$',
                            message: 'The password can only minimum 8 characters'
                        },
                        identical: {
                            field: 'password',
                            message: 'The password and its confirm are not equal'
                        },
                    }
                },
                auth: {
                    validators: {
                        notEmpty: {
                            message: 'The admin password required'
                        },
                        remote: {
                            message: 'Your password not authentication',
                            url: '<?=site_url('admin/user/check_auth')?>',
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