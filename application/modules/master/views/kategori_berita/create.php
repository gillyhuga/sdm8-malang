
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-plus"></i> Add Kategori_berita</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="master/kategori_berita/store">
					<?= csrf(); ?>
                    <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                            <select class="form-control select2" id="kategori" name="kategori" style="width: 100%;">
                            <option value=""></option>
                                <option value="1">Berita</option>
                                <option value="2">Agenda</option>
                                <option value="3">Galleri</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label">Nama</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="note" name="note" placeholder="Note">
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-icon btn-primary waves-effect waves-classic">Submit</button>
                    <button type="button" id="btn_back" data-url="master/kategori_berita" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script> 
$( document ).ready(function() { 
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
                nama : {
                    validators: {
                        notEmpty: {
                            message : 'The Nama is required'
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