
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <h4 class="card-header btn-primary"> <i class="icon md-plus"></i> Add Slider</h4>
		<div class="card">
			<div class="card-body">
				<form class="form_validation" id="post-data" data-url="frontend/slider/store">
					<?= csrf(); ?>
                    <div class="form-group row">
                        <label for="slider" class="col-md-4 col-form-label">Slider</label>
                        <div class="col-md-8">
                            <div id="target_slider"></div>
                            <img id="no_slider" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD . 'thumbnail/no_image.png' ?>" />
                            <div class="mt-2">
                                <span class="badge badge-info mt-2" style="font-size:.8rem;">Format: JPG, PNG (size: 1920x820 pixel)</span></br>
                                <input id="slider" name="slider" type="file" class="inputFile" onChange="showPreview_slider(this);" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label">Title</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="title" name="title" rows="4" placeholder="Title"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="subtitle" class="col-md-4 col-form-label">Subtitle</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="subtitle" name="subtitle" rows="4" placeholder="Subtitle"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="order_menu" class="col-md-4 col-form-label">Order Menu</label>
                        <div class="col-md-8">
                            <input class="form-control" type="number" id="order_menu" name="order_menu" placeholder="Order Menu">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="note" name="note" placeholder="Note">
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-icon btn-primary waves-effect waves-classic">Submit</button>
                    <button type="button" id="btn_back" data-url="frontend/slider" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script> 
    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ image review slider ]
    function showPreview_slider(objFileInput) {
        if (objFileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function(e) {
                $('#no_slider').hide();
                $('#target_slider').show();
                $("#target_slider").html('<img src="' + e.target.result + '" width="120px" height="120px"  style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;"/>');
            }
            fileReader.readAsDataURL(objFileInput.files[0]);
        }else{
            $('#target_slider').hide();
            $('#no_slider').show();
            $("#no_slider").html('<img src="' + APP_URL + 'assets/backend/uploads/thumbnail/no_user.png" width="120px" height="120px"  style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;"/>');
        }
    }


$( document ).ready(function() { 
    //---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ focus title ]
    $('#title').focus(); 



             
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
                    slider : {
                        validators: {
                            notEmpty: {
                                message : 'The Slider is required'
                            },
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
                subtitle : {
                    validators: {
                        notEmpty: {
                            message : 'The Subtitle is required'
                        },
                    }
                },
                order_menu : {
                    validators: {
                        notEmpty: {
                            message : 'The Order menu is required'
                        },
                        digits: {
                            message: 'The Order menu can contain digits only'
                        },
                        remote: {
                            url      : 'frontend/slider/unique_order_menu',
                            message  : 'This Order menu has already taken',
                            type     : 'POST',
                            delay    :  1000,
                            data: function() {
                                return {
                                    order_menu: $('#order_menu').val(),
                                };
                            },
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