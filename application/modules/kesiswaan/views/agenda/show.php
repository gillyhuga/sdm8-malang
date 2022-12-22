
<div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <h4 class="card-header btn-primary"> <i class="icon md-eye"></i> View Agenda</h4>
		<div class="card">
			<div class="card-body">
                    <div class="form-group row">
                        <label for="foto" class="col-md-4 col-form-label">Foto</label>
                        <div class="col-md-8">
                        <?php if(!empty($agenda->foto)){ ?>
                            <img id="no_foto" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/'.$agenda->foto ?>" />
                        <?php }else{ ?>
                            <img id="no_foto" width="120px" height="120px" style="border: 4px solid #eff2f7;margin: 7px;  border-radius: 4px;" src="<?= __UPLOAD.'thumbnail/no_image.png'?>" />
                        <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label">Title</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?= $agenda->title; ?>" placeholder="Title" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                        <?php $kategori = $this->agenda->get_list('fr_kategori_berita', array('status' => 1), '', '', '', 'id', 'ASC'); ?>
                        <select class="form-control select2" id="kategori" name="kategori" style="width: 100%;" disabled>
                            <option value="">Select</option>
                            <?php foreach ($kategori as $key => $obj) { ?>
                                <option value="<?= $obj->id; ?>" <?php if($agenda->kategori == $obj->id){ echo 'selected="selected"'; }?>><?= $obj->nama; ?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal" class="col-md-4 col-form-label">Tanggal</label>
                        <div class="col-md-8">
                        <input class="form-control datepicker" type="text"  value="<?= __date($agenda->tanggal)?>" placeholder="Tanggal" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_mulai" class="col-md-4 col-form-label">Jam Mulai</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?= $agenda->tanggal_mulai; ?>" placeholder="Jam Mulai" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_selesai" class="col-md-4 col-form-label">Jam Selesai</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?= $agenda->tanggal_selesai; ?>" placeholder="Jam Selesai" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?= $agenda->note; ?>" placeholder="Note" disabled>
                        </div>
                    </div>
                <div id="show-activitylog"></div>
                <?php if(is_superadmin()){?>
                    <button type="button" id="data_log" class="btn btn-danger button_activitylog" data-url="kesiswaan/agenda/activitylog" data-id="<?= $agenda->id ?>" >Activitylogs </button>
                <?php } ?>
                <button type="button" id="btn_back" data-url="kesiswaan/agenda" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
			</div>
		</div>
	</div>
</div>
