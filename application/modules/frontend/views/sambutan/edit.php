
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <h4 class="card-header btn-primary"><i class="icon md-edit"></i> Edit Sambutan</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="frontend/sambutan/store">
                <?= csrf(); ?>
                <input type="hidden" id="id" name="id" value="<?= $sambutan->id ?>">
                    <div class="form-group row">
                        <label for="foto" class="col-md-4 col-form-label">Foto</label>
                        <div class="col-md-8">
                            <div id="target_foto"></div>
                            <input type="hidden" name="prev_foto" id="prev_foto" value="<?= $sambutan->foto ?>" />
                            <?php if(!empty($sambutan->foto)){ ?>
                                <img id="no_foto" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/'.$sambutan->foto ?>" />
                            <?php }else{ ?>
                                <img id="no_foto" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/no_image.png'?>" />
                            <?php } ?>
                            <div class="mt-2">
                                <span class="badge badge-info mt-2" style="font-size:.8rem;">Format: JPG, PNG (size: x pixel)</span></br>
                                <input id="foto" name="foto" type="file" class="inputFile" onChange="showPreview_foto(this);" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kata_sambutan" class="col-md-4 col-form-label">Kata Sambutan</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="kata_sambutan" name="kata_sambutan" placeholder="kata_sambutan"><?= $sambutan->kata_sambutan; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_kepala" class="col-md-4 col-form-label">Nama Kepala</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="nama_kepala" name="nama_kepala" value="<?= $sambutan->nama_kepala; ?>" placeholder="Nama Kepala">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="note" name="note" value="<?= $sambutan->note; ?>" placeholder="Note">
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-icon btn-success waves-effect waves-classic">Update</button>
                    <button type="button" id="btn_back" data-url="frontend/sambutan" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script> 
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
    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ focus kata_sambutan ]
    $('#kata_sambutan').focus(); 

    
  
       $('#kata_sambutan').summernote({
            dialogsInBody: true,
            height: 100,
            placeholder: 'kata_sambutan here...',
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage_kata_sambutan(image[0]);
                },
                onMediaDelete : function(target) {
                    deleteImage_kata_sambutan(target[0].src);
                }
            }
        });

        function uploadImage_kata_sambutan(image) {
            var data = new FormData();
            data.append("kata_sambutan", image);
            $.ajax({
                url: 'frontend/sambutan/upload_kata_sambutan',
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "POST",
                success: function(url) {
                    $('#kata_sambutan').summernote("insertImage", url);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function deleteImage_kata_sambutan(src) {
            $.ajax({
                data: {src : src},
                type: "POST",
                url: 'frontend/sambutan/delete_kata_sambutan',
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
                kata_sambutan : {
                    validators: {
                        callback: {
                            message: 'The Kata sambutan is required',
                            callback: function(value, validator, $field) {
                                var code = $('[name="kata_sambutan"]').summernote('code');
                                return (code !== '' && code !== '<p><br></p>');
                            }
                        }
                    }
                },
                nama_kepala : {
                    validators: {
                        notEmpty: {
                            message : 'The Nama kepala is required'
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
        .find('[name="kata_sambutan"]')
        .summernote({
            height: 120
        })
        .on('summernote.change', function(customEvent, contents, $editable) {
            $('.form_validation').formValidation('revalidateField', 'kata_sambutan');
        }).end() 
    })();
});
</script>