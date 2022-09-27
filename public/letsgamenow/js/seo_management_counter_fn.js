function seo_managament_check_and_set_counts() {

    var meta_title_count = $("#meta_title").val().length;
    $('#meta_title_count').text(meta_title_count);
    var meta_title_count_color = 'green';
    if (!isNaN(meta_title_count)) {
        if (meta_title_count >= 60) {
            meta_title_count_color = 'red';
        } else {
            meta_title_count_color = 'green';
        }
        $('#meta_title_count').css('color', meta_title_count_color);
    }

    var meta_keywords_count = $("#meta_keywords").val().replace(/^[\s,.;]+/, "").replace(/[\s,.;]+$/, "").split(/[\s,.;]+/).length;
    $('#meta_keywords_count').text(meta_keywords_count);
    var meta_keywords_count_color = 'green';
    if (!isNaN(meta_keywords_count)) {
        if (meta_keywords_count >= 10) {
            meta_keywords_count_color = 'red';
        } else {
            meta_keywords_count_color = 'green';
        }
        $('#meta_keywords_count').css('color', meta_keywords_count_color);
    }

    var meta_description_count = $("#meta_description").val().length;
    $('#meta_description_count').text(meta_description_count);
    var meta_description_count_color = 'green';
    if (!isNaN(meta_description_count)) {
        if (meta_description_count >= 155) {
            meta_description_count_color = 'red';
        } else {
            meta_description_count_color = 'green';
        }
        $('#meta_description_count').css('color', meta_description_count_color);
    }
}