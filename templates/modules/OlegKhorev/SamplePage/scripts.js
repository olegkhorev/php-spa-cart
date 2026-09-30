function init_sample_page() {
    $('.sample-page-execute_module_button').unbind('click').on('click', function() {
        alert("{lng[Hello world!]}");
    });
}
