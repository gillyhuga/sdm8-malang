<h4 class="btn btn-sm btn-block btn-danger" style="text-align: center;">------------ Activity logs ------------</h4>
<table class="table table-bordered">
    <tbody>
        <!-- Created -->
        <tr>
            <td style="width: 35%;"> Created By</td>
            <td class="text-end" style="color:blue"><?= isset($log->created_by) ? @__user_email($log->created_by) : '' ?></td>
        </tr>
        <tr>
            <td style="width: 35%;">Created At</td>
            <td class="text-end"><?= isset($log->created_at) ? @__datetime($log->created_at) : '' ?></td>
        </tr>
        <!-- Modified -->
        <tr>
            <td style="width: 35%;">Modified By</td>
            <td class="text-end"  style="color:blue"><?= isset($log->modified_by) ? @__user_email($log->modified_by) : '-' ?></td>
        </tr>
        <tr>
            <td style="width: 35%;">Modified At</td>
            <td class="text-end"><?= isset($log->modified_at) ? @__datetime($log->modified_at) : '-' ?></td>
        </tr>
        <!-- Deleted -->
        <tr>
            <td style="width: 35%;">Deleted By</td>
            <td class="text-end"  style="color:blue"><?= isset($log->deleted_by) ? @__user_email($log->deleted_by) : '-' ?></td>
        </tr>
        <tr>
            <td style="width: 35%;">Deleted At</td>
            <td class="text-end"><?= isset($log->deleted_at) ? @__datetime($log->deleted_at) : '-' ?></td>
        </tr>
        <!-- Restored -->
        <tr>
            <td style="width: 35%;">Restored by</td>
            <td class="text-end"  style="color:blue"><?= isset($log->restored_by) ? @__user_email($log->restored_by) : '-' ?></td>
        </tr>
        <tr>
            <td style="width: 35%;">Restored At</td>
            <td class="text-end"><?= isset($log->restored_at) ? @__datetime($log->restored_at) : '-' ?></td>
        </tr>
    </tbody>
</table>