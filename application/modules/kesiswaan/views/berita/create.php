
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <h4 class="card-header btn-primary"> <i class="icon md-plus"></i> Add Berita</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="kesiswaan/berita/store">
					<?= csrf(); ?>
                    <div class="form-group row">
                        <label for="thumbnail" class="col-md-4 col-form-label">Thumbnail</label>
                        <div class="col-md-8">
                            <div id="target_thumbnail"></div>
                            <img id="no_thumbnail" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD . 'thumbnail/no_image.png' ?>" />
                            <div class="mt-2">
                                <span class="badge badge-info mt-2" style="font-size:.8rem;">Format: JPG, PNG (size: 1140x643 pixel)</span></br>
                                <input id="thumbnail" name="thumbnail" type="file" class="inputFile" onChange="showPreview_thumbnail(this);" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label">Title</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="title" name="title" placeholder="Title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                            <?php $kategori = $this->berita->get_list('fr_kategori_berita', array('status' => 1), '', '', '', 'id', 'ASC'); ?>
                            <select class="form-control select2" id="kategori" name="kategori" style="width: 100%;">
                                <option value="">Select</option>
                                <?php foreach ($kategori as $key => $obj) { ?>
                                    <option value="<?= $obj->id; ?>"><?= $obj->nama; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-md-4 col-form-label">Content</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="content" name="content" placeholder="content"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="note" name="note" placeholder="Note">
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-icon btn-primary waves-effect waves-classic">Submit</button>
                    <button type="button" id="btn_back" data-url="kesiswaan/berita" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script> 
    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ image review thumbnail ]
    function showPreview_thumbnail(objFileInput) {
        if (objFileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function(e) {
                $('#no_thumbnail').hide();
                $('#target_thumbnail').show();
                $("#target_thumbnail").html('<img src="' + e.target.result + '" width="120px" height="120px"  style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;"/>');
            }
            fileReader.readAsDataURL(objFileInput.files[0]);
        }else{
            $('#target_thumbnail').hide();
            $('#no_thumbnail').show();
            $("#no_thumbnail").html('<img src="' + APP_URL + 'assets/backend/uploads/thumbnail/no_user.png" width="120px" height="120px"  style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;"/>');
        }
    }

    
$( document ).ready(function() { 
    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ focus title ]
    $('#title').focus(); 



         


    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ select2 plugin ]
    $('.select2').select2({
        placeholder: "Select",
        allowClear: true
    });    

    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ summernote content ]
    $('#content').summernote({
        dialogsInBody: true,
        height: 100,
        placeholder: 'content here...',
        callbacks: {
            onImageUpload: function(image) {
                uploadImage_content(image[0]);
            },
            onMediaDelete : function(target) {
                deleteImage_content(target[0].src);
            }
        }
    });

    function uploadImage_content(image) {
        var data = new FormData();
        data.append("content", image);
        $.ajax({
            url: 'kesiswaan/berita/upload_content',
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function(url) {
                $('#content').summernote("insertImage", url);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function deleteImage_content(src) {
        $.ajax({
            data: {src : src},
            type: "POST",
            url: 'kesiswaan/berita/delete_content',
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
                content : {
                    validators: {
                        callback: {
                            message: 'The Content is required',
                            callback: function(value, validator, $field) {
                                var code = $('[name="content"]').summernote('code');
                                return (code !== '' && code !== '<p><br></p>');
                            }
                        }
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
        .find('[name="content"]')
        .summernote({
            height: 120
        })
        .on('summernote.change', function(customEvent, contents, $editable) {
            $('.form_validation').formValidation('revalidateField', 'content');
        }).end() 
    })();
});
</script>