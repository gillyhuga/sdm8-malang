
<div class="row justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-eye"></i> View Module</h4>
		<div class="card">
			<div class="card-body">
                    <div class="form-group row">
                        <label for="module_name" class="col-md-4 col-form-label">Module Name</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" value="<?= $module->module_name; ?>" placeholder="Module Name" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="module_slug" class="col-md-4 col-form-label">Module Slug</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" value="<?= $module->module_slug; ?>" placeholder="Module Slug" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="module_icon" class="col-md-4 col-form-label">Module Icon</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" value="<?= $module->module_icon; ?>" placeholder="Module Icon" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="module_order" class="col-md-4 col-form-label">Module Order</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" value="<?= $module->module_order; ?>" placeholder="Module Order" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <textarea class="form-control"  rows="4" placeholder="Note" disabled><?= $module->note ?></textarea>
                        </div>
                    </div>
                    <div id="show-activitylog"></div>
                    <?php if(is_admin()){?>
                        <button type="button" id="data_log" class="btn btn-danger button_activitylog" data-url="administrator/module/activitylog" data-id="<?= $module->id ?>" >Activitylogs </button>
                    <?php } ?>
                    <button type="button" id="btn_back" data-url="administrator/module" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
			</div>
		</div>
	</div>
</div>
