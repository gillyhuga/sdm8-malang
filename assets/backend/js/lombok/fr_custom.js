
"use strict";

$(document).on("click", ".ebook_detail", function () {
	const id = $(this).data("id");
	$.ajax({
		url: 'home/ebook_detail',
		type: "POST",
		dataType: "JSON",
		data: {
			id: id,
		},
		success: function (response) {
			$("#main-view").html(response.html);
		},
	});
});


$('body').on("click", ".berita_detail", function () {
	const id = $(this).data("id");
	$.ajax({
		url: 'home/berita_detail',
		type: "POST",
		dataType: "JSON",
		data: {
			id: id,
		},
		success: function (response) {
			$("#main-view").html(response.html);
		},
	});
});



$(document).on("click", "#btn_back", function () {
	const URL = $(this).data("url");
	$.ajax({
		url: URL,
		type: "POST",
		dataType: "JSON",
		data: {},
		success: function (response) {
			$("#main-view").html(response.html);
		},
	});
});