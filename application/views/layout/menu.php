<div class="row mt-2">
    <div class="col-12 form-group">
        <select style="width: 100%;" class="form-control select2 menu_search" id="menu_search" name="menu_search" onchange="menu_selected()">
            <option value="">Search</option>
            <?php $menu = $this->db->get_where('operations', array('status' => 1, 'is_deleted' => 0))->result(); ?>
            <?php foreach ($menu as $key => $obj) { ?>
                <?php $moduler = $this->db->get_where('modules', array('id' => $obj->id_module))->row(); ?>
                <?php if ($moduler->module_slug == 'setting') continue; ?>
                <?php if(has_permission(MENU, strtolower($moduler->module_slug),  $obj->operation_slug)){ ?>
                    <option value="<?= strtolower($moduler->module_slug) . '/' . $obj->operation_slug; ?>"><?= $moduler ->module_name ?> | <?= $obj->operation_name; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>

<script>
    $(".select2").select2({
        dropdownParent: $("#fira-show")
    });
    $('.menu_search').focus();
</script>