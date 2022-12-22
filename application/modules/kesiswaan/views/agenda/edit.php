
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <h4 class="card-header btn-primary"><i class="icon md-edit"></i> Edit Agenda</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="kesiswaan/agenda/store">
                <?= csrf(); ?>
                <input type="hidden" id="id" name="id" value="<?= $agenda->id ?>">
                    <div class="form-group row">
                        <label for="foto" class="col-md-4 col-form-label">Foto</label>
                        <div class="col-md-8">
                            <div id="target_foto"></div>
                            <input type="hidden" name="prev_foto" id="prev_foto" value="<?= $agenda->foto ?>" />
                            <?php if(!empty($agenda->foto)){ ?>
                                <img id="no_foto" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/'.$agenda->foto ?>" />
                            <?php }else{ ?>
                                <img id="no_foto" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/no_image.png'?>" />
                            <?php } ?>
                            <div class="mt-2">
                                <span class="badge badge-info mt-2" style="font-size:.8rem;">Format: JPG, PNG (size: 870x492 pixel)</span></br>
                                <input id="foto" name="foto" type="file" class="inputFile" onChange="showPreview_foto(this);" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label">Title</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="title" name="title" value="<?= $agenda->title; ?>" placeholder="Title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                            <?php $kategori = $this->agenda->get_list('fr_kategori_berita', array('status' => 1), '', '', '', 'id', 'ASC'); ?>
                            <select class="form-control select2" id="kategori" name="kategori" style="width: 100%;">
                                <option value="">Select</option>
                                <?php foreach ($kategori as $key => $obj) { ?>
                                    <option value="<?= $obj->id; ?>" <?php if($obj->id == $agenda->kategori){ echo 'selected="selected"';} ?>><?= $obj->nama; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-md-4 col-form-label">Deskripsi</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="deskripsi"><?= $agenda->deskripsi; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_mulai" class="col-md-4 col-form-label">Jam Mulai</label>
                        <div class="col-md-8">
                            <input class="form-control datetimepicker" type="text" id="tanggal_mulai" name="tanggal_mulai" value="<?= $agenda->tanggal_mulai; ?>" placeholder="Jam Mulai">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_selesai" class="col-md-4 col-form-label">Jam Selesai</label>
                        <div class="col-md-8">
                            <input class="form-control datetimepicker" type="text" id="tanggal_selesai" name="tanggal_selesai" value="<?= $agenda->tanggal_selesai; ?>" placeholder="Jam Selesai">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="note" name="note" value="<?= $agenda->note; ?>" placeholder="Note">
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-icon btn-success waves-effect waves-classic">Update</button>
                    <button type="button" id="btn_back" data-url="kesiswaan/agenda" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script> 
$(document).ready(function() { 
    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ focus title ]
    $('#title').focus(); 

    
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


    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ select2 plugin ]
    $('.select2').select2({
        placeholder: "Select",
        allowClear: true
    }); 


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
       $('#deskripsi').summernote({
            dialogsInBody: true,
            height: 100,
            placeholder: 'deskripsi here...',
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage_deskripsi(image[0]);
                },
                onMediaDelete : function(target) {
                    deleteImage_deskripsi(target[0].src);
                }
            }
        });

        
    $('.datepicker').on('change', function() {
       $('.form_validation').formValidation('revalidateField', 'tanggal');
    });


            //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ datetime $obj ]
    $('.datetimepicker').daterangepicker({
        autoUpdateInput: false,
        timePicker: true,
        timePicker24Hour:true,
        locale: {
            format: 'DD MMMM YYYY HH:mm',
        },
        singleDatePicker: true,
        showDropdowns: true,
        drops: "down",
    });
    $('.datetimepicker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD MMMM YYYY HH:mm'));
    });
    $('.datetimepicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });


        function uploadImage_deskripsi(image) {
            var data = new FormData();
            data.append("deskripsi", image);
            $.ajax({
                url: 'kesiswaan/agenda/upload_deskripsi',
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "POST",
                success: function(url) {
                    $('#deskripsi').summernote("insertImage", url);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function deleteImage_deskripsi(src) {
            $.ajax({
                data: {src : src},
                type: "POST",
                url: 'kesiswaan/agenda/delete_deskripsi',
                cache: false,
                success: function(response) {
                    console.log(response);
                }
            });
        }
       
    (function () { 
        //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ form_validation checking ]
        $('.form_validation').formValidation({
            framework: "bootstrap4",
            button: {
                selector: '#submit',
                disabled: 'disabled'
            },
            excluded: [':disabled'],
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
                title : {
                    validators: {
                        notEmpty: {
                            message : 'The Title is required'
                        },
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
                        callback: {
                            message: 'The Deskripsi is required',
                            callback: function(value, validator, $field) {
                                var code = $('[name="deskripsi"]').summernote('code');
                                return (code !== '' && code !== '<p><br></p>');
                            }
                        }
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
        .find('[name="deskripsi"]')
        .summernote({
            height: 120
        })
        .on('summernote.change', function(customEvent, contents, $editable) {
            $('.form_validation').formValidation('revalidateField', 'deskripsi');
        }).end() 
    })();
});
</script>