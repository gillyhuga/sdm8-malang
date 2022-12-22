
<div class="row justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-edit"></i> Reset Token</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="administrator/token/store">
					<?= csrf(); ?>
                    <input type="hidden" id="uuid" name="uuid" value="<?= $token->uuid; ?>">
                    <input type="hidden" id="type" name="type" value="reset">
                    <div class="form-group row">
                        <label for="" class="col-md-4 col-form-label">Token</label>
                        <div class="col-md-8">
                            <input type="hidden" id="old_token" name="old_token" value="<?= $token->mytoken;?>">
                            <input class="form-control" type="text" id="mytoken" name="mytoken" value="<?= $token->mytoken;?>" placeholder="Token">
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
                    <button type="button" id="btn_back" data-url="administrator/token" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script> 
    $('#token').focus();  
    (function () {  
        $('.form_validation').formValidation({
            framework: "bootstrap4",
            button: {
                selector: '#submit',
                disabled: 'disabled'
            },
            icon: null,
            fields: { 
                mytoken : {
                    validators: {
                        notEmpty: {
                            message: 'The token is required'
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
                            url: '<?=site_url('administrator/password/check_auth')?>',
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