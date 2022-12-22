
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
        <h4 class="card-header btn-primary"> <i class="icon md-eye"></i> View Slider</h4>
		<div class="card">
			<div class="card-body">
                    <div class="form-group row">
                        <label for="slider" class="col-md-4 col-form-label">Slider</label>
                        <div class="col-md-8">
                        <?php if(!empty($slider->slider)){ ?>
                            <img id="no_slider" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/'.$slider->slider ?>" />
                        <?php }else{ ?>
                            <img id="no_slider" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/no_image.png'?>" />
                        <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label">Title</label>
                        <div class="col-md-8">
                        <textarea class="form-control"  rows="4" placeholder="Title" disabled><?= $slider->title ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="subtitle" class="col-md-4 col-form-label">Subtitle</label>
                        <div class="col-md-8">
                        <textarea class="form-control"  rows="4" placeholder="Subtitle" disabled><?= $slider->subtitle ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="order_menu" class="col-md-4 col-form-label">Order Menu</label>
                        <div class="col-md-8">
                        <input class="form-control" value="<?= $slider->order_menu ?>" placeholder="Order Menu" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?= $slider->note; ?>" placeholder="Note" disabled>
                        </div>
                    </div>
                <div id="show-activitylog"></div>
                <?php if(is_superadmin()){?>
                    <button type="button" id="data_log" class="btn btn-danger button_activitylog" data-url="frontend/slider/activitylog" data-id="<?= $slider->id ?>" >Activitylogs </button>
                <?php } ?>
                <button type="button" id="btn_back" data-url="frontend/slider" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
			</div>
		</div>
	</div>
</div>
