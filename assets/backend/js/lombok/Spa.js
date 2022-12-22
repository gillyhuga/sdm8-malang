$(function () {
	var History = window.History;
	if (History.enabled) {
		var page = get_url_value("page");
		var path = page ? page : "dashboard/home";
		// Load the page
		load_page_content(path);
	} else {
		return false;
	}

	// Content update and back/forward button handler
	History.Adapter.bind(window, "statechange", function () {
		var State = History.getState();
		// Do ajax
		load_page_content(State.data.path);
		// Log the history object to your browser's console
		// History.log(State);
	});

	$(".__sidebar .site-menu-item a").on("click", function (e) {
		e.preventDefault();
		var urlPath = $(this).attr("href");
		var title = $(this).text();
		$(".site-menu-item  li").parent().find("li").removeClass("active");
		$(this).parent().addClass("active").siblings().removeClass("active");
		History.pushState({ path: urlPath }, title, "./?page=" + urlPath); // When we do this, History.Adapter will also execute its contents.
	});

	$(".__sidebar .site-menu-item a").on("contextmenu",function(e){
		return false;
	 }); 

	// $(".__breadcrumb .ln_menu").on("click", function (e) {
	$('body').on("click", ".__breadcrumb a", function (e) {
		e.preventDefault();
		var urlPath = $(this).attr("href");
		var title = $(this).text();
		console.log('loadding herer....');
		console.log(title);
		console.log(urlPath);
		History.pushState({ path: urlPath }, title, "./?page=" + urlPath); // When we do this, History.Adapter will also execute its contents.
	});

	$('body').on("contextmenu", ".__breadcrumb a", function (e) {
		return false;
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
