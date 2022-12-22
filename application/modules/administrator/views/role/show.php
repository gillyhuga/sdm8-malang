
<div class="row justify-content-md-center">
    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-eye"></i> View Role</h4>
		<div class="card">
			<div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Name</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" value="<?= $role->name; ?>" placeholder="Name" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_default" class="col-md-4 col-form-label">Is Default</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="<?= isset($role->is_default) ? 'Yes ' : 'No'; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_superadmin" class="col-md-4 col-form-label">Is Superadmin</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="<?= isset($role->is_superadmin) ? 'Yes ' : 'No'; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <textarea class="form-control"  rows="4" placeholder="Note" disabled><?= $role->note ?></textarea>
                        </div>
                    </div>
                    <div id="show-activitylog"></div>
                    <?php if(is_superadmin()){?>
                        <button type="button" id="data_log" class="btn btn-danger button_activitylog" data-url="administrator/role/activitylog" data-id="<?= $role->id ?>" >Activitylogs </button>
                    <?php } ?>
                    <button type="button" id="btn_back" data-url="administrator/role" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
			</div>
		</div>
	</div>
</div>
