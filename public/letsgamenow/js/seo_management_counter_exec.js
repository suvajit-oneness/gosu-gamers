$('#reset_form').click(function () {
    $('#seo_form')[0].reset();
    seo_managament_check_and_set_counts();
});

// initial state, check fields and set the count on page load
seo_managament_check_and_set_counts();


// dynamically check count and set numbers - start
$('#meta_title').on('input', function (e) {
    seo_managament_check_and_set_counts();
});
$('#meta_keywords').on('input', function (e) {
    seo_managament_check_and_set_counts();
});
$('#meta_description').on('input', function (e) {
    seo_managament_check_and_set_counts();
});
// dynamically check count and set numbers - end