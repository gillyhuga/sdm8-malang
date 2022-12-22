
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <h4 class="card-header btn-primary"> <i class="icon md-eye"></i> View Berita</h4>
		<div class="card">
			<div class="card-body">
                    <div class="form-group row">
                        <label for="thumbnail" class="col-md-4 col-form-label">Thumbnail</label>
                        <div class="col-md-8">
                        <?php if(!empty($berita->thumbnail)){ ?>
                            <img id="no_thumbnail" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/'.$berita->thumbnail ?>" />
                        <?php }else{ ?>
                            <img id="no_thumbnail" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/no_image.png'?>" />
                        <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label">Title</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?= $berita->title; ?>" placeholder="Title" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                        <?php $kategori = $this->berita->get_list('fr_kategori_berita', array('status' => 1), '', '', '', 'id', 'ASC'); ?>
                        <select class="form-control select2" id="kategori" name="kategori" style="width: 100%;" disabled>
                            <option value="">Select</option>
                            <?php foreach ($kategori as $key => $obj) { ?>
                                <option value="<?= $obj->id; ?>" <?php if($berita->kategori == $obj->id){ echo 'selected="selected"'; }?>><?= $obj->nama; ?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?= $berita->note; ?>" placeholder="Note" disabled>
                        </div>
                    </div>
                <div id="show-activitylog"></div>
                <?php if(is_superadmin()){?>
                    <button type="button" id="data_log" class="btn btn-danger button_activitylog" data-url="kesiswaan/berita/activitylog" data-id="<?= $berita->id ?>" >Activitylogs </button>
                <?php } ?>
                <button type="button" id="btn_back" data-url="kesiswaan/berita" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
			</div>
		</div>
	</div>
</div>
