
<div class="row justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-edit"></i> Reset Email</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="admin/user/store">
					<?= csrf(); ?>
                    <input type="hidden" id="uuid" name="uuid" value="<?= $email->uuid; ?>">
                    <input type="hidden" id="type" name="type" value="reset">
                    <input type="hidden" id="_data" name="_data" value="email">
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">New Email</label>
                        <div class="col-md-8">
                            <input class="form-control" type="email" id="email" name="email" placeholder="New Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email2" class="col-md-4 col-form-label">Confirm Email</label>
                        <div class="col-md-8">
                            <input class="form-control" type="email" id="email2" name="email2" placeholder="Confirm Email">
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
    $('#email').focus();  
    (function () {  
        $('.form_validation').formValidation({
            framework: "bootstrap4",
            button: {
                selector: '#submit',
                disabled: 'disabled'
            },
            icon: null,
            fields: { 
                email : {
                    validators: {
                        notEmpty: {
                            message: 'The email is required'
                        },
                        emailAddress: {
                            message: 'The email address is not valid'
                        },
                        remote: {
                            message: 'Your email has been taken',
                            url: '<?=site_url('admin/user/check_email')?>',
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
                email2 : {
                    validators: {
                        notEmpty: {
                            message: 'The confirm Password is required'
                        },
                        emailAddress: {
                            message: 'The email address is not valid'
                        },
                        identical: {
                            field: 'email',
                            message: 'The email and its confirm are not equal'
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