$(".btn-export").click(function() {
    var request = window.location.search;
    $("#search-filter").attr("action", window.location.origin + "/export/user" + request);
    $("#search-filter").submit();
});

$("#search-submit").click(function() {
    $("#search-filter").attr("action", "");
    $("#search-filter").submit();
    $('#search-filter')
        .find('input[name]')
        .filter(function() {
            return !this.value;
        })
        .prop('name', '');
});

$("#filter-submit").click(function() {
    $("#search-filter").attr("action", "");
    $("#search-filter").submit();
    $('#search-filter')
        .find('input[name]')
        .filter(function() {
            return !this.value;
        })
        .prop('name', '');
});