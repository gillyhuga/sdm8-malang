<div class="row justify-content-md-center">
    <div class="col-12 col-md-12">
        <h4 class="card-header btn-primary"><i class="icon md-edit"></i> Edit Role Permission</h4>
        <div class="card">
            <div class="card-body">
                <form class="form_validation" id="post-data" data-url="administrator/permission/store">
                    <?= csrf(); ?>
                    <input type="hidden" name="role_id" id="role_id" value="<?= $role_id; ?>" />
                    <table class="table table-hover" data-role="content" data-plugin="selectable" data-row-selectable="true">
                        <thead class="bg-grey-100">
                            <tr>
                                <th>NO</th>
                                <th>Module Name</th>
                                <th>Controller</th>
                                <th>
                                    <li class="list-inline-item">
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="__menu">
                                            <label>MENU</label>
                                        </div>
                                    </li>
                                </th>
                                <th>
                                    <li class="list-inline-item">
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="__view">
                                            <label>VIEW</label>
                                        </div>
                                    </li>
                                </th>
                                <th>
                                    <li class="list-inline-item">
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="__add">
                                            <label>ADD</label>
                                        </div>
                                    </li>
                                </th>
                                <th>
                                    <li class="list-inline-item">
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="__edit">
                                            <label>EDIT</label>
                                        </div>
                                    </li>
                                </th>
                                <th>
                                    <li class="list-inline-item">
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="__delete">
                                            <label>DELETE</label>
                                        </div>
                                    </li>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($modules) && !empty($modules)) : ?>
                                <?php $module = 1;
                                foreach ($modules as $obj) : ?>
                                    <?php $operations = get_operation_by_module($obj->id); ?>
                                    <?php if(empty($operations)) continue; ?>
                                    <tr>
                                        <td class="table-active"><?= $module; ?></td>
                                        <td class="table-active"> <?= $obj->module_name; ?></td>
                                        <td class="table-active">
                                            <li class="list-inline-item">
                                                <div class="checkbox-custom checkbox-success">
                                                    <input type="checkbox" class="select_all" data-id="<?= $obj->module_slug?>"> 
                                                    <label for="">Select All</label>
                                                </div>
                                            </li>
                                        </td>
                                        <td class="table-active">
                                            <li class="list-inline-item">
                                                <div class="checkbox-custom checkbox-success">
                                                    <input type="checkbox" class="select_custom" data-custom="<?= $obj->module_slug; ?>1" >
                                                    <label for=""></label>
                                                </div>
                                            </li>
                                        </td>
                                        <td class="table-active">
                                            <li class="list-inline-item">
                                                <div class="checkbox-custom checkbox-success">
                                                <input type="checkbox" class="select_custom" data-custom="<?= $obj->module_slug; ?>2" >
                                                    <label for=""></label>
                                                </div>
                                            </li>
                                        </td>
                                        <td class="table-active">
                                            <li class="list-inline-item">
                                                <div class="checkbox-custom checkbox-success">
                                                <input type="checkbox" class="select_custom" data-custom="<?= $obj->module_slug; ?>3" >
                                                    <label for=""></label>
                                                </div>
                                            </li>
                                        </td>
                                        <td class="table-active">
                                            <li class="list-inline-item">
                                                <div class="checkbox-custom checkbox-success">
                                                <input type="checkbox" class="select_custom" data-custom="<?= $obj->module_slug; ?>4" >
                                                    <label for=""></label>
                                                </div>
                                            </li>
                                        </td>
                                        <td class="table-active">
                                            <li class="list-inline-item">
                                                <div class="checkbox-custom checkbox-success">
                                                <input type="checkbox" class="select_custom" data-custom="<?= $obj->module_slug; ?>5" >
                                                    <label for=""></label>
                                                </div>
                                            </li>
                                        </td>
                                    </tr>
                                    <?php if (isset($operations) && !empty($operations)) : ?>
                                        <?php $operaton = 1;
                                        foreach ($operations as $op) : ?>
                                            <tr>
                                                <?php $permission = get_permission_by_operation($role_id, $op->id); ?>
                                                <td colspan="2"> <?= $module; ?>.<?php echo $operaton++; ?></td>
                                                <td> <?= $op->operation_name; ?></td>
                                                <input type="hidden" name="operation[<?= $op->id; ?>]" id="operatio[]" value="<?= $op->id; ?>" />
                                                <td>
                                                    <?php if ($op->is_menu_vissible) { ?>
                                                        <li class="list-inline-item">
                                                            <div class="checkbox-custom checkbox-primary">
                                                                <input type="checkbox" class="fn_menu <?= $obj->module_slug; ?> <?= $obj->module_slug ?>1" name="is_menu[<?php echo $op->id; ?>]" value="1" id="index_<?php echo $op->id; ?>" <?php if (isset($permission->is_menu) && $permission->is_menu == 1) {echo 'checked="checked"';}?>>
                                                                <label for=""></label>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($op->is_view_vissible) { ?>
                                                        <li class="list-inline-item">
                                                            <div class="checkbox-custom checkbox-primary">
                                                                <input type="checkbox" class="fn_view  <?= $obj->module_slug; ?>  <?= $obj->module_slug ?>2"name="is_view[<?php echo $op->id; ?>]" value="1" id="view_<?php echo $op->id; ?>" <?php if (isset($permission->is_view) && $permission->is_view == 1) {echo 'checked="checked"';}?>>
                                                                <label for=""></label>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($op->is_add_vissible) { ?>
                                                        <li class="list-inline-item">
                                                            <div class="checkbox-custom checkbox-primary">
                                                                <input type="checkbox" class="fn_add  <?= $obj->module_slug; ?>  <?= $obj->module_slug ?>3" name="is_add[<?php echo $op->id; ?>]" value="1" id="add_<?php echo $op->id; ?>" <?php if (isset($permission->is_add) && $permission->is_add == 1) {echo 'checked="checked"';}?>>
                                                                <label for=""></label>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($op->is_edit_vissible) { ?>
                                                        <li class="list-inline-item">
                                                            <div class="checkbox-custom checkbox-primary">
                                                                <input type="checkbox" class="fn_edit  <?= $obj->module_slug; ?>  <?= $obj->module_slug ?>4" name="is_edit[<?php echo $op->id; ?>]" value="1" id="edit_<?php echo $op->id; ?>" <?php if (isset($permission->is_edit) && $permission->is_edit == 1) {echo 'checked="checked"';}?>>
                                                                <label for=""></label>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($op->is_delete_vissible) { ?>
                                                        <li class="list-inline-item">
                                                            <div class="checkbox-custom checkbox-primary">
                                                                <input type="checkbox" class="fn_delete  <?= $obj->module_slug; ?>  <?= $obj->module_slug ?>5" name="is_delete[<?php echo $op->id; ?>]" value="1" id="delete_<?php echo $op->id; ?>" <?php if (isset($permission->is_delete) && $permission->is_delete == 1) {echo 'checked="checked"';}?>>
                                                                <label for=""></label>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php $module++;
                                endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <button type="submit" id="submit" class="btn btn-icon btn-primary waves-effect waves-classic">Submit</button>
                    <button type="button" id="btn_back" data-url="administrator/permission" class="btn btn-icon btn-default waves-effect waves-classict">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        $('.form_validation').formValidation({
            framework: "bootstrap4",
            button: {
                selector: '#submit',
                disabled: 'disabled'
            },
            icon: null,
        })

    $('.select_all').click(function() {
        const id = $(this).data("id");
        if ($(this).is(':checked')) {
            $("."+id).prop("checked", true);
        } else {
            $("."+id).prop("checked", false);
        }
    });

    $('.select_custom').click(function() {
        const id = $(this).data("custom");
        if ($(this).is(':checked')) {
            $("."+id).prop("checked", true);
        } else {
            $("."+id).prop("checked", false);
        }
    });


        /* Permission */
    $('#__menu').click(function() {
        if ($(this).is(':checked')) {
            $(".fn_menu").prop("checked", true);
        } else {
            $(".fn_menu").prop("checked", false);
        }
    });




    $('#__view').click(function() {
        if ($(this).is(':checked')) {
            $(".fn_view").prop("checked", true);
        } else {
            $(".fn_view").prop("checked", false);
        }
    });
    $('#__add').click(function() {
        if ($(this).is(':checked')) {
            $(".fn_add").prop("checked", true);
        } else {
            $(".fn_add").prop("checked", false);
        }
    });
    $('#__edit').click(function() {
        if ($(this).is(':checked')) {
            $(".fn_edit").prop("checked", true);
        } else {
            $(".fn_edit").prop("checked", false);
        }
    });
    $('#__delete').click(function() {
        if ($(this).is(':checked')) {
            $(".fn_delete").prop("checked", true);
        } else {
            $(".fn_delete").prop("checked", false);
        }
    });
    
    })();
</script>