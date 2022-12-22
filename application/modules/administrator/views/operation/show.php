
<div class="row justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-eye"></i> View Operation</h4>
		<div class="card">
			<div class="card-body">
                    <div class="form-group row">
                        <label for="id_module" class="col-md-4 col-form-label"> Module</label>
                        <div class="col-md-8">
                            <?php $id_module = $this->operation->get_list('modules', array('status' => 1), '', '', '', 'id', 'ASC'); ?>
                            <select class="form-control select2" id="id_module" name="id_module" style="width: 100%;" disabled>
                                <option value="">Select</option>
                                <?php foreach ($id_module as $key => $obj) { ?>
                                    <option value="<?= $obj->id; ?>" <?php if($operation->id_module == $obj->id){ echo 'selected="selected"'; }?>><?= $obj->module_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="operation_name" class="col-md-4 col-form-label">Operation Name</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" value="<?= $operation->operation_name; ?>" placeholder="Operation Name" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="operation_slug" class="col-md-4 col-form-label">Operation Slug</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" value="<?= $operation->operation_slug; ?>" placeholder="Operation Slug" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="order_menu" class="col-md-4 col-form-label">Order Menu</label>
                        <div class="col-md-8">
                            <input class="form-control" value="<?= $operation->order_menu ?>" placeholder="Order Menu" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_menu_vissible" class="col-md-4 col-form-label">Is Menu Vissible</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="<?= isset($operation->is_menu_vissible) ? 'Yes ' : 'No'; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_view_vissible" class="col-md-4 col-form-label">Is View Vissible</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="<?= isset($operation->is_view_vissible) ? 'Yes ' : 'No'; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_add_vissible" class="col-md-4 col-form-label">Is Add Vissible</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="<?= isset($operation->is_add_vissible) ? 'Yes ' : 'No'; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_edit_vissible" class="col-md-4 col-form-label">Is Edit Vissible</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="<?= isset($operation->is_edit_vissible) ? 'Yes ' : 'No'; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_delete_vissible" class="col-md-4 col-form-label">Is Delete Vissible</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="<?= isset($operation->is_delete_vissible) ? 'Yes ' : 'No'; ?>" disabled>
                        </div>
                    </div>
                    <div id="show-activitylog"></div>
                    <?php if(is_admin()){?>
                        <button type="button" id="data_log" class="btn btn-danger button_activitylog" data-url="administrator/operation/activitylog" data-id="<?= $operation->id ?>" >Activitylogs </button>
                    <?php } ?>
                    <button type="button" id="btn_back" data-url="administrator/operation" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
			</div>
		</div>
	</div>
</div>
