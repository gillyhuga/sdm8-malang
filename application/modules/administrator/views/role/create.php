
<div class="row justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-plus"></i> Add Role</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="administrator/role/store">
					<?= csrf(); ?>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Name</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="name" name="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_default" class="col-md-4 col-form-label">Is Default</label>
                        <div class="col-md-8">
                            <select class="form-control select2" id="is_default" name="is_default" style="width:100%;">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_superadmin" class="col-md-4 col-form-label">Is Superadmin</label>
                        <div class="col-md-8">
                            <select class="form-control select2" id="is_superadmin" name="is_superadmin" style="width:100%;">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="note" name="note" rows="4" placeholder="Note"></textarea>
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-icon btn-primary waves-effect waves-classic">Submit</button>
                    <button type="button" id="btn_back" data-url="administrator/role" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script> 
    $('#name').focus();  
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
                name : {
                    validators: {
                        notEmpty: {
                            message : 'The Name is required'
                        },
                        remote: {
                            url      : 'administrator/role/unique_name',
                            message  : 'This Name has already taken',
                            type     : 'POST',
                            delay    :  1000,
                            data: function() {
                                return {
                                    name: $('#name').val(),
                                };
                            },
                        },
                    }
                },
                is_default : {
                    validators: {
                        notEmpty: {
                            message : 'The Is default is required'
                        },
                    }
                },
                is_superadmin : {
                    validators: {
                        notEmpty: {
                            message : 'The Is superadmin is required'
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