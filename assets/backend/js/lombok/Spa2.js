$(function () {
	var History = window.History;
	if (History.enabled) {
		// var page = get_url_value("page"); original
		var no_ajax =$('#no_ajax').val();
		var no_ajax_url = $('#no_ajax_url').val();
		if(no_ajax == ''){
			if(no_ajax_url == ''){
				var path = "home/page";
				load_page_content(path);
			}else{
				var page = get_url_value("page");
				var path = page;
				load_page_content(path);
			}
		}else{
			var path = get_url_value(no_ajax_url);
			load_page_content(path);
			History.pushState({ path: path }, title, "./?page=" + path); // When we do this, History.Adapter will also execute its contents.
		}
	
	} else {
		alert('false')
		return false;
	}

	// Content update and back/forward button handler
	History.Adapter.bind(window, "statechange", function () {
		var State = History.getState();
		load_page_content(State.data.path);
	});

	$(".menu-area .it-menu a").on("click", function (e) {
		e.preventDefault();
		var urlPath = $(this).attr("href");
		var title = $(this).text();
		History.pushState({ path: urlPath }, title, "./?page=" + urlPath); // When we do this, History.Adapter will also execute its contents.
	});


	function load_page_content(page) {
		if(page == '#') return false;
		$.ajax({
			type: "POST",
			url: page,
			dataType: "JSON",
			data: {},
			success: function (response) {
			if (response.status === 401 || response.status === 440) {
					toastr.warning(response.message);
				}
				$("#main-view").html(response.html);
			},
			error: function () {
				toastr.error("404 Page Not Found!");
			},
		});
	}

	function get_url_value(variable) {
		var query = window.location.search.substring(1);
		var vars = query.split("&");
		for (var i = 0; i < vars.length; i++) {
			var pair = vars[i].split("=");
			if (pair[0] == variable) {
				return pair[1];
			}
		}
		return false;
	}
});

// disable F5 and Atl+F5 browser reload
// $(function () {
// 	$(document).keydown(function (e) {
// 		return (e.which || e.keyCode) != 116;
// 	});
// });
