$(function() {
    $('#replace-photo').on('click', function(event) {
        $('#blog-post-photo').slideToggle("slow", function() {
            $('.blog-post-photo-input').fadeToggle(1000);
            $('label[for=photo]').fadeToggle(1000);
        });
    });
});