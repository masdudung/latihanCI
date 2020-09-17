$(document).ready(function () {

    if ($("#users_table").length) {
        $('#users_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": user_ajax_url,
                "type": "POST"
            }
        });
    }

    if ($("#countries_table").length) {
        $('#countries_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": country_ajax_url,
                "type": "POST"
            }
        });
    }
});