
<div class="row justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-plus"></i> Add Module</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="administrator/module/store">
					<?= csrf(); ?>
                    <div class="form-group row">
                        <label for="module_name" class="col-md-4 col-form-label">Module Name</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="module_name" name="module_name" placeholder="Module Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="module_slug" class="col-md-4 col-form-label">Module Slug</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="module_slug" name="module_slug" placeholder="Module Slug">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="module_icon" class="col-md-4 col-form-label">Module Icon</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="module_icon" name="module_icon" placeholder="Module Icon">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="module_order" class="col-md-4 col-form-label">Module Order</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="module_order" name="module_order" placeholder="Module Order">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="note" name="note" rows="4" placeholder="Note"></textarea>
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-icon btn-primary waves-effect waves-classic">Submit</button>
                    <button type="button" id="btn_back" data-url="administrator/module" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script> 
    $('#module_name').focus();  
    (function () {  
        $('.form_validation').formValidation({
            framework: "bootstrap4",
            button: {
                selector: '#submit',
                disabled: 'disabled'
            },
            icon: null,
            fields: { 
                module_name : {
                    validators: {
                        notEmpty: {
                            message : 'The Module name is required'
                        },
                        remote: {
                            url      : 'administrator/module/unique_module_name',
                            message  : 'This Module name has already taken',
                            type     : 'POST',
                            delay    :  1000,
                            data: function() {
                                return {
                                    module_name: $('#module_name').val(),
                                };
                            },
                        },
                    }
                },
                module_slug : {
                    validators: {
                        notEmpty: {
                            message : 'The Module slug is required'
                        },
                        remote: {
                            url      : 'administrator/module/unique_module_slug',
                            message  : 'This Module slug has already taken',
                            type     : 'POST',
                            delay    :  1000,
                            data: function() {
                                return {
                                    module_slug: $('#module_slug').val(),
                                };
                            },
                        },
                    }
                },
                module_icon : {
                    validators: {
                        notEmpty: {
                            message : 'The Module icon is required'
                        },
                    }
                },
                module_order : {
                    validators: {
                        notEmpty: {
                            message : 'The Module order is required'
                        },
                        remote: {
                            url      : 'administrator/module/unique_module_order',
                            message  : 'This Module order has already taken',
                            type     : 'POST',
                            delay    :  1000,
                            data: function() {
                                return {
                                    module_order: $('#module_order').val(),
                                };
                            },
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