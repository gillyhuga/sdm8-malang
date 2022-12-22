
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-plus"></i> Add Testimoni</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="frontend/testimoni/store">
					<?= csrf(); ?>
                    <div class="form-group row">
                        <label for="foto" class="col-md-4 col-form-label">Foto</label>
                        <div class="col-md-8">
                            <div id="target_foto"></div>
                            <img id="no_foto" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD . 'thumbnail/no_image.png' ?>" />
                            <div class="mt-2">
                                <span class="badge badge-info mt-2" style="font-size:.8rem;">Format: JPG, PNG (size: x pixel)</span></br>
                                <input id="foto" name="foto" type="file" class="inputFile" onChange="showPreview_foto(this);" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="testimonial" class="col-md-4 col-form-label">Testimonial</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="testimonial" name="testimonial" placeholder="testimonial"></textarea>
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
                    <button type="button" id="btn_back" data-url="frontend/testimoni" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script> 
$( document ).ready(function() { 
    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ focus testimonial ]
    $('#testimonial').focus(); 


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
             

    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ summernote testimonial ]
    $('#testimonial').summernote({
        dialogsInBody: true,
        height: 100,
        placeholder: 'testimonial here...',
        callbacks: {
            onImageUpload: function(image) {
                uploadImage_testimonial(image[0]);
            },
            onMediaDelete : function(target) {
                deleteImage_testimonial(target[0].src);
            }
        }
    });

    function uploadImage_testimonial(image) {
        var data = new FormData();
        data.append("testimonial", image);
        $.ajax({
            url: 'frontend/testimoni/upload_testimonial',
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function(url) {
                $('#testimonial').summernote("insertImage", url);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function deleteImage_testimonial(src) {
        $.ajax({
            data: {src : src},
            type: "POST",
            url: 'frontend/testimoni/delete_testimonial',
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
                testimonial : {
                    validators: {
                        callback: {
                            message: 'The Testimonial is required',
                            callback: function(value, validator, $field) {
                                var code = $('[name="testimonial"]').summernote('code');
                                return (code !== '' && code !== '<p><br></p>');
                            }
                        }
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
        .find('[name="testimonial"]')
        .summernote({
            height: 120
        })
        .on('summernote.change', function(customEvent, contents, $editable) {
            $('.form_validation').formValidation('revalidateField', 'testimonial');
        }).end() 
    })();
});
</script>