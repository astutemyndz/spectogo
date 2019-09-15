/* Load Header And Footer */
jQuery(function($) {
    var functions = {
        fileLoader: function( params ) {
            /* Template File Load Function. */
            var params = jQuery.parseJSON(params);
            var path = "template/include/"+ params.filename +"."+ params.extension;
            var file = $.get(path).done(function(data) {
                $(params.target).append(data);
            })
            .fail(function(error) {
                if(error.status == 404 ) {
                    var path = "template/error/"+ params.filename +"_error."+ params.extension;
                    var file = $.get(path)
                    .done(function(data) {
                        $(params.target).append(data);
                    });
                }
            });
        }
    };

    $(document).ready(function(){
        functions.fileLoader(JSON.stringify({'filename':'header','extension':'html','target':'#header'}));
        functions.fileLoader(JSON.stringify({'filename':'footer','extension':'html','target':'#footer'}));
    });

});


jQuery(document).ready(function(){
	jQuery(".prescription_box").hover(function () {	
	   jQuery(this).toggleClass("bg-primary");
	});
});

