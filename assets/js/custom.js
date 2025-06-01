jQuery(document).ready(function($){
  $("*").dblclick(function(e){
    var selectedText = window.getSelection().toString().trim();
    if(selectedText.length > 1){

        $("#wdlook-wordMeaningModal").show();
        $(".wdlook-word-close").click(function(){
            $("#wdlook-wordMeaningModal").hide();
        })
        $("#wdlook-selectedWord").text(selectedText);
        var apiurl = "https://api.dictionaryapi.dev/api/v2/entries/en/"+selectedText;
        $.get(apiurl, function(data, status){
            console.log(data);
            if (Array.isArray(data) && data.length > 0) {
                // Get the first definition from the first meaning
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
        }).fail(function() {
            $("#wdlook-wordDefinition").text("No definition found.");
        });
    }
  });
});