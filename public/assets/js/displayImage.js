//display images before upload
$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview,gallery) {

        if (input.files) {
            var filesAmount = input.files.length;
            console.log($(gallery).find( ".img-rounded" ).remove())
            console.log($(gallery).find( ".selection__title" ).remove())
            $($.parseHTML('<h2>')).attr('class', "selection__title").html("Nueva selección").appendTo(placeToInsertImagePreview);
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    
                    $($.parseHTML('<img>')).attr('src', event.target.result).attr('class', 'img-rounded').appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };
    $('#image').on('change', function() {
        imagesPreview(this, 'div.gallery', '.gallery');
    });
    $('#imagesWithId').on('change', function() {
        imagesPreview(this, 'div.gallery2','.gallery2');
    });
});
