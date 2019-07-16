(function( $ ) {
	$(function() {
		var url = SarniaSearchAutocomplete.url + "?action=auto_search";
		$(".searchform input[name=s]").autocomplete({
			source: function(request, response) {
        $.getJSON(url, { term: request.term }, function(items) {
            response($.map(items, function(item) {
              return {
                label: $('<span></span>').html(item.label).text(),
                link: item.link,
              };
            }));
        });
    },
			delay: 500,
      minLength: 3,
      select: function(event, ui) { 
        if (ui.item.link) {
          window.location.href = ui.item.link;
        }
      }
		});	
	});
})( jQuery );