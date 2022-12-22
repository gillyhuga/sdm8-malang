
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"><i class="icon md-edit"></i> Edit Budaya</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="frontend/budaya/store">
                <?= csrf(); ?>
                <input type="hidden" id="id" name="id" value="<?= $budaya->id ?>">
                    <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                            <select class="form-control select2"  id="kategori" name="kategori" style="width: 100%;">
                                <option value=""></option>
                                <option value="1"  <?php if($budaya->kategori == '1') echo 'selected'; ?>>Aqidah yang kuat</option>
                                <option value="2"  <?php if($budaya->kategori == '2') echo 'selected'; ?>>Ibadah yang benar</option>
                                <option value="3"  <?php if($budaya->kategori == '3') echo 'selected'; ?>>Akhlak karima</option>
                                <option value="4"  <?php if($budaya->kategori == '4') echo 'selected'; ?>> Disiplin dan mandiri</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-md-4 col-form-label">Deskripsi</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi"><?= $budaya->deskripsi ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="note" name="note" value="<?= $budaya->note; ?>" placeholder="Note">
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-icon btn-success waves-effect waves-classic">Update</button>
                    <button type="button" id="btn_back" data-url="frontend/budaya" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script> 
$(document).ready(function() { 
    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ focus kategori ]
    $('#kategori').focus();  


    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ select2 plugin ]
    $('.select2').select2({
        placeholder: "Select",
        allowClear: true
    });   
    (function () { 
        //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ form_validation checking ]
        $('.form_validation').formValidation({
            framework: "bootstrap4",
            button: {
                selector: '#submit',
                disabled: 'disabled'
            },
            icon: null,
            fields: { 
                kategori : {
                    validators: {
                        notEmpty: {
                            message : 'The Kategori is required'
                        },
                    }
                },
                deskripsi : {
                    validators: {
                        notEmpty: {
                            message : 'The Deskripsi is required'
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
});
</script>