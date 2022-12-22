
<div class="row justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"><i class="icon md-edit"></i> Edit Operation</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="administrator/operation/store">
                <?= csrf(); ?>
                <input type="hidden" id="id" name="id" value="<?= $operation->id ?>">
                    <div class="form-group row">
                        <label for="id_module" class="col-md-4 col-form-label"> Module</label>
                        <div class="col-md-8">
                            <?php $id_module = $this->operation->get_list('modules', array('status' => 1), '', '', '', 'id', 'ASC'); ?>
                            <select class="form-control select2" id="id_module" name="id_module" style="width: 100%;">
                                <option value="">Select</option>
                                <?php foreach ($id_module as $key => $obj) { ?>
                                    <option value="<?= $obj->id; ?>" <?php if($obj->id == $operation->id_module){ echo 'selected="selected"';} ?>><?= $obj->module_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="operation_name" class="col-md-4 col-form-label">Operation Name</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="operation_name" name="operation_name" value="<?= $operation->operation_name; ?>" placeholder="Operation Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="operation_slug" class="col-md-4 col-form-label">Operation Slug</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="operation_slug" name="operation_slug" value="<?= $operation->operation_slug; ?>" placeholder="Operation Slug">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="order_menu" class="col-md-4 col-form-label">Order Menu</label>
                        <div class="col-md-8">
                            <input class="form-control" type="number" id="order_menu" name="order_menu" value="<?= $operation->order_menu ?>" placeholder="Order Menu">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_menu_vissible" class="col-md-4 col-form-label">Is Menu Vissible</label>
                        <div class="col-md-8">
                            <select class="form-control select2" id="is_menu_vissible" name="is_menu_vissible" style="width:100%;">
                                <option value="1" <?php if($operation->is_menu_vissible == 1){ echo 'selected="selected"'; }?>>Yes</option>
                                <option value="0" <?php if($operation->is_menu_vissible == 0){ echo 'selected="selected"'; }?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_view_vissible" class="col-md-4 col-form-label">Is View Vissible</label>
                        <div class="col-md-8">
                            <select class="form-control select2" id="is_view_vissible" name="is_view_vissible" style="width:100%;">
                                <option value="1" <?php if($operation->is_view_vissible == 1){ echo 'selected="selected"'; }?>>Yes</option>
                                <option value="0" <?php if($operation->is_view_vissible == 0){ echo 'selected="selected"'; }?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_add_vissible" class="col-md-4 col-form-label">Is Add Vissible</label>
                        <div class="col-md-8">
                            <select class="form-control select2" id="is_add_vissible" name="is_add_vissible" style="width:100%;">
                                <option value="1" <?php if($operation->is_add_vissible == 1){ echo 'selected="selected"'; }?>>Yes</option>
                                <option value="0" <?php if($operation->is_add_vissible == 0){ echo 'selected="selected"'; }?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_edit_vissible" class="col-md-4 col-form-label">Is Edit Vissible</label>
                        <div class="col-md-8">
                            <select class="form-control select2" id="is_edit_vissible" name="is_edit_vissible" style="width:100%;">
                                <option value="1" <?php if($operation->is_edit_vissible == 1){ echo 'selected="selected"'; }?>>Yes</option>
                                <option value="0" <?php if($operation->is_edit_vissible == 0){ echo 'selected="selected"'; }?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_delete_vissible" class="col-md-4 col-form-label">Is Delete Vissible</label>
                        <div class="col-md-8">
                            <select class="form-control select2" id="is_delete_vissible" name="is_delete_vissible" style="width:100%;">
                                <option value="1" <?php if($operation->is_delete_vissible == 1){ echo 'selected="selected"'; }?>>Yes</option>
                                <option value="0" <?php if($operation->is_delete_vissible == 0){ echo 'selected="selected"'; }?>>No</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-icon btn-success waves-effect waves-classic">Update</button>
                    <button type="button" id="btn_back" data-url="administrator/operation" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
    $('#id_module').focus();  
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
                id_module : {
                    validators: {
                        notEmpty: {
                            message : 'The Module is required'
                        },
                    }
                },
                operation_name : {
                    validators: {
                        notEmpty: {
                            message : 'The Operation name is required'
                        },
                        remote: {
                            url      : 'administrator/operation/unique_operation_name',
                            message  : 'This Operation name has already taken',
                            type     : 'POST',
                            delay    : 250,
                            data: function() {
                                return {
                                    id : $('#id').val(),
                                    operation_name: $('#operation_name').val(),
                                };
                            },
                        },
                    }
                },
                operation_slug : {
                    validators: {
                        notEmpty: {
                            message : 'The Operation slug is required'
                        },
                        remote: {
                            url      : 'administrator/operation/unique_operation_slug',
                            message  : 'This Operation slug has already taken',
                            type     : 'POST',
                            delay    : 250,
                            data: function() {
                                return {
                                    id : $('#id').val(),
                                    id_module: $('#id_module').val(),
                                    operation_slug: $('#operation_slug').val(),
                                };
                            },
                        },
                    }
                },
                order_menu : {
                    validators: {
                        notEmpty: {
                            message : 'The Order menu is required'
                        },
                        digits: {
                            message: 'The Order menu can contain digits only'
                        },
                        remote: {
                            url      : 'administrator/operation/unique_order_menu',
                            message  : 'This Order menu has already taken',
                            type     : 'POST',
                            delay    : 250,
                            data: function() {
                                return {
                                    id : $('#id').val(),
                                    id_module: $('#id_module').val(),
                                    order_menu: $('#order_menu').val(),
                                };
                            },
                        },
                    }
                },
                is_menu_vissible : {
                    validators: {
                        notEmpty: {
                            message : 'The Is menu vissible is required'
                        },
                    }
                },
                is_view_vissible : {
                    validators: {
                        notEmpty: {
                            message : 'The Is view vissible is required'
                        },
                    }
                },
                is_add_vissible : {
                    validators: {
                        notEmpty: {
                            message : 'The Is add vissible is required'
                        },
                    }
                },
                is_edit_vissible : {
                    validators: {
                        notEmpty: {
                            message : 'The Is edit vissible is required'
                        },
                    }
                },
                is_delete_vissible : {
                    validators: {
                        notEmpty: {
                            message : 'The Is delete vissible is required'
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