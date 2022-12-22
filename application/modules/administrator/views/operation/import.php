
<div class="row justify-content-md-center">
<div class="col-12 col-md-6">
    <div class="card">
        <div class="card-body">
            <form class="form_validation" id="post-data" data-url="administrator/operation/upload">
                <?= csrf(); ?>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">Import File</label>
                    <div class="col-md-8">
                        <input type="file" class="form-lombok" name="file" accept=".xls, .xlsx" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">Download Format File</label>
                    <div class="col-md-8">
                        <a href="<?= __UPLOAD ?>download/operation.xlsx" target="_blank" class="btn btn-success">Download</a>
                    </div>
                </div>
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                <button type="button" id="btn_back" data-url="administrator/operation" class="btn btn-light waves-effect">Close</button>
            </form>
        </div>
    </div>
</div>
</div>

<script>  
(function () {  
    $('.form_validation').formValidation({
        framework: "bootstrap4",
        button: {
            selector: '#submit',
            disabled: 'disabled'
        },
        icon: null,
        fields: { 
            file: {
                validators: {
                    notEmpty: {
                        message: 'The file required'
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
</script>