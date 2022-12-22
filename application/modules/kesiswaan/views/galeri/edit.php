
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-12 col-lg-8">
        <h4 class="card-header btn-primary"><i class="icon md-edit"></i> Edit Galeri</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="kesiswaan/galeri/store">
                <?= csrf(); ?>
                <input type="hidden" id="id" name="id" value="<?= $galeri->id ?>">
                    <div class="form-group row">
                        <label for="foto" class="col-md-4 col-form-label">Foto</label>
                        <div class="col-md-8">
                            <div id="target_foto"></div>
                            <input type="hidden" name="prev_foto" id="prev_foto" value="<?= $galeri->foto ?>" />
                            <?php if(!empty($galeri->foto)){ ?>
                                <img id="no_foto" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/'.$galeri->foto ?>" />
                            <?php }else{ ?>
                                <img id="no_foto" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/no_image.png'?>" />
                            <?php } ?>
                            <div class="mt-2">
                                <span class="badge badge-info mt-2" style="font-size:.8rem;">Format: JPG, PNG (size: 520x520 pixel)</span></br>
                                <input id="foto" name="foto" type="file" class="inputFile" onChange="showPreview_foto(this);" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                            <?php $kategori_list = $this->galeri->get_list('fr_kategori_berita', array('status' => 1), '', '', '', 'id', 'ASC'); ?>
                            <select class="form-control select2" id="kategori" name="kategori" style="width: 100%;">
                                <option value="">Select</option>
                                <?php foreach ($kategori_list as $key => $obj) { ?>
                                    <option value="<?= $obj->id; ?>" <?php if($obj->id == $galeri->kategori){ echo 'selected="selected"';} ?>><?= $obj->nama; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-md-4 col-form-label">Deskripsi</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi"><?= $galeri->deskripsi ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal" class="col-md-4 col-form-label">Tanggal</label>
                        <div class="col-md-8">
                            <input class="form-control datepicker" type="text" id="tanggal" name="tanggal" value="<?= date('d F, Y', strtotime($galeri->tanggal)); ?>" placeholder="Tanggal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="note" name="note" value="<?= $galeri->note; ?>" placeholder="Note">
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-icon btn-success waves-effect waves-classic">Update</button>
                    <?php if(is_admin()){ ?>
                        <button type="button" id="btn_back" data-url="kesiswaan/galeri" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
                    <?php }else{ ?>
                        <button type="button" id="btn_back" data-url="dashboard/home" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
                    <?php } ?>
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

    
    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ image preview foto ]
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
            $("#no_foto").html('<img src="' + APP_URL + 'assets/backend/uploads/thumbnail/no_image.png" width="120px" height="120px"  style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;"/>');
        }
    } 


$(document).ready(function() { 
    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ focus kategori ]
    $('#kategori').focus(); 


    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ date tanggal ]
    var year = (new Date).getFullYear();
    $('.datepicker').daterangepicker({
        locale: {
            format: 'DD MMMM YYYY',
        },
        singleDatePicker: true,
        showDropdowns: true,
        drops: "down",
        maxDate: new Date(year+10, 11, 31)
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