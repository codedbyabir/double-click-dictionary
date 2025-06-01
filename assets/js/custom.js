jQuery(document).ready(function ($) {
    // Close button handler - bind once
    $(".wdlook-word-close").on("click", function () {
        $("#wdlook-wordMeaningModal").hide();
    });

    // Double-click event on the document
    $(document).on("dblclick", function (e) {
        var selectedText = window.getSelection().toString().trim();

        if (selectedText.length > 1) {
            $("#wdlook-selectedWord").text(selectedText);
            $("#wdlook-wordDefinition").text("Loading...");
            $("#wdlook-wordMeaningModal").show();

            var apiurl = "https://api.dictionaryapi.dev/api/v2/entries/en/" + encodeURIComponent(selectedText);

            $.get(apiurl, function (data, status) {
                if (Array.isArray(data) && data.length > 0) {
                    var meanings = data[0].meanings;
                    if (meanings && meanings.length > 0 && meanings[0].definitions && meanings[0].definitions.length > 0) {
                        var definition = meanings[0].definitions[0].definition;
                        $("#wdlook-wordDefinition").text(definition);
                    } else {
                        $("#wdlook-wordDefinition").text("No definition found.");
                    }
                } else {
                    $("#wdlook-wordDefinition").text("No definition found.");
                }
            }).fail(function () {
                $("#wdlook-wordDefinition").text("No definition found.");
            });
        }
    });
});
