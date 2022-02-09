$(document).ready(function(e) {
    $('#exampleInputFile').change(function() {
        document.getElementById('new_image').innerHTML = 'Ảnh mới'
        let reader = new FileReader();

        reader.onload = (e) => {

            $('#preview-image').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);

    });

});