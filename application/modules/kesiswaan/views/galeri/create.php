
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-12 col-lg-8">
        <h4 class="card-header btn-primary"> <i class="icon md-plus"></i> Add Galeri</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="kesiswaan/galeri/store">
					<?= csrf(); ?>
                    <div class="form-group row">
                        <label for="foto" class="col-md-4 col-form-label">Foto</label>
                        <div class="col-md-8">
                            <div id="target_foto"></div>
                            <img id="no_foto" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD . 'thumbnail/no_image.png' ?>" />
                            <div class="mt-2">
                                <span class="badge badge-info mt-2" style="font-size:.8rem;">Format: JPG, PNG (size: 520x520 pixel)</span></br>
                                <input id="foto" name="foto" type="file" class="inputFile" onChange="showPreview_foto(this);" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                            <?php $kategori = $this->galeri->get_list('fr_kategori_berita', array('status' => 1), '', '', '', 'id', 'ASC'); ?>
                            <select class="form-control select2" id="kategori" name="kategori" style="width: 100%;">
                                <option value="">Select</option>
                                <?php foreach ($kategori as $key => $obj) { ?>
                                    <option value="<?= $obj->id; ?>"><?= $obj->nama; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-md-4 col-form-label">Deskripsi</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal" class="col-md-4 col-form-label">Tanggal</label>
                        <div class="col-md-8">
                            <input class="form-control datepicker" type="text" id="tanggal" name="tanggal" placeholder="Tanggal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="note" name="note" placeholder="Note">
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-icon btn-primary waves-effect waves-classic">Submit</button>
                    <button type="button" id="btn_back" data-url="kesiswaan/galeri" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script> 


    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ select2 plugin ]
    $('.select2').select2({
        placeholder: "Select",
        allowClear: true
    }); 


    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ image review foto ]
    function showPreview_foto(objFileInput) {
        if (objFileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function(e) {
                $('#no_foto').hide();
                $('#target_foto').show();
                $("#target_foto").html('<img src="' + e.target.result + '" width="120px" height="120px"  style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;"/>');
            }
            fileReader.readAsDataURL(objFileInput.files[0]);
        }else{
            $('#target_foto').hide();
            $('#no_foto').show();
            $("#no_foto").html('<img src="' + APP_URL + 'assets/backend/uploads/thumbnail/no_user.png" width="120px" height="120px"  style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;"/>');
        }
    }  


$(document).ready(function() { 
    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ focus kategori ]
    $('#kategori').focus(); 


    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ date tanggal ]
    var year = (new Date).getFullYear();
    $('.datepicker').daterangepicker({
        autoUpdateInput: false,
        locale: {
            format: 'DD MMMM YYYY',
        },
        singleDatePicker: true,
        showDropdowns: true,
        drops: "down",
        maxDate: new Date(year+10, 11, 31)
    });
    $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD MMMM YYYY'));
    });
    $('.datepicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
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
                    foto : {
                        validators: {
                            notEmpty: {
                                message : 'The Foto is required'
                            },
                            file: {
                                extension: 'jpeg,jpg,png',
                                type: 'image/jpeg,image/jpg,image/png',
                                maxSize: 2048 * 1024, //2MB
                                message: 'The selected file is not valid'
                            }
                        }
                    },
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
                tanggal : {
                    validators: {
                        notEmpty: {
                            message : 'The Tanggal is required'
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