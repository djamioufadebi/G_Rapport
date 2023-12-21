
// tabs.js

$(document).ready(function() {
    $('.nav-link[data-bs-toggle="tab"]').on('click', function(e) {
        e.preventDefault();
        $(this).tab('show');
    });
});
