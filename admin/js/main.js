$(document).ready(function () {
    $('#summernote').summernote({
        height: 200
    });

    $('#selectAllBoxes').click(function () {
        if (this.checked) {
            $('.checkBoxes').each(function () {
                this.checked = true;
            })
        } else {
            $('.checkBoxes').each(function () {
                this.checked = false;
            })
        }
    })
});
