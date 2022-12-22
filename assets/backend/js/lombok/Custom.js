"use strict";

//-[ 01 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_create ]
$(document).on("click", "#button_create", function () {
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


//-[ 02 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_show ]
$(document).on("click", "#button_show", function () {
	const URL = $(this).data("url");
	const id = $(this).data("id");
	$.ajax({
		url: URL,
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


//-[ 03 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_edit ]
$(document).on("click", "#button_edit", function () {
	const URL = $(this).data("url");
	const id = $(this).data("id");
	$.ajax({
		url: URL,
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


//-[ 04 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_destroy ]
$(document).on("click", "#button_destroy", function () {
	const URL = $(this).data("url");
	const id = $(this).data("id");
	swal(
		{
			title: "Are you sure?",
			text: "You're going to delete this data!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes, delete it!",
			closeOnConfirm: true,
			animation: false,
		},
		function () {
			$.ajax({
				url: URL,
				type: "POST",
				dataType: "JSON",
				data: {
					id: id,
				},
				stateSave: true,
				success: function (response) {
					var socket = new WebSocket(WEBSOCKET_URL);
					socket.onopen = function (e) {
						console.log("Connection established!");
						socket.send(response.socket);
					};
					myalert(response);
					$("#show_all").DataTable().ajax.reload(null, false);
				},
			});
		}
	);
});


//-[ 05 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_bulkdestroy ]
$(document).on("click", "#button_bulkdestroy", function () {
	const URL = $(this).data("url");
	var checkbox = $(".checkbox:checked");
	var is_deleted = $("#trash").val();
	if (checkbox.length > 0) {
		var data_arr = [];
		$(checkbox).each(function () {
			data_arr.push($(this).val());
		});
		swal(
			{
				title: "Are you sure?",
				text: "You're going to delete these data!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete all!",
				closeOnConfirm: true,
				animation: false,
			},
			function () {
				$.ajax({
					url: URL,
					type: "POST",
					dataType: "JSON",
					data: {
						data_arr: data_arr,
					},
					stateSave: true,
					success: function (response) {
						var socket = new WebSocket(WEBSOCKET_URL);
						socket.onopen = function (e) {
							console.log("Connection established!");
							socket.send(response.socket);
						};
						myalert(response);
						if (is_deleted == 1) {
							$(".button_create").hide();
							$(".button_import").hide();
							$(".button_export").hide();
							$("#button_refresh").hide();
							$(".button_status").hide();
							$(".button_qrcode").hide();
							$(".button_print").hide();
							$(".button_bulkdestroy").show();
							$(".button_filter").show();
							$("#button_bulkrestore").show();
						} else {
							$(".button_create").show();
							$(".button_import").show();
							$(".button_export").show();
							$("#button_refresh").show();
							$(".button_filter").show();
							$(".button_status").hide();
							$(".button_qrcode").hide();
							$(".button_print").hide();
							$(".button_bulkdestroy").hide();
							$("#button_bulkrestore").hide();
						}
						$("#check_all").prop("checked", false);
						$("#show_all").DataTable().ajax.reload(null, false);
					},
				});
			}
		);
	} else {
		toastr.info("Please select checkbox first if you wanna delete item!");
	}
});


//-[ 06 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_bulkrestore ]
$(document).on("click", "#button_bulkrestore", function (e) {
	const URL = $(this).data("url");
	var checkbox = $(".checkbox:checked");
	var is_deleted = $("#trash").val();
	if (checkbox.length > 0) {
		var data_arr = [];
		$(checkbox).each(function () {
			data_arr.push($(this).val());
		});
		swal(
			{
				title: "Are you sure?",
				text: "You're going to restore these data!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-warning",
				confirmButtonText: "Yes, Restore all!",
				closeOnConfirm: true,
				animation: false,
			},
			function () {
				$.ajax({
					url: URL,
					type: "POST",
					dataType: "JSON",
					data: {
						data_arr: data_arr,
					},
					stateSave: true,
					success: function (response) {
						var socket = new WebSocket(WEBSOCKET_URL);
						socket.onopen = function (e) {
							console.log("Connection established!");
							socket.send(response.socket);
						};
						myalert(response);
						if (is_deleted == 1) {
							$(".button_create").hide();
							$(".button_refresh").hide();
							$(".button_status").hide();
							$(".button_qrcode").hide();
							$(".button_print").hide();
							$(".button_bulkdestroy").show();
							$(".button_filter").show();
							$(".button_bulkrestore").show();
						} else {
							$(".button_create").show();
							$(".button_refresh").show();
							$(".button_filter").show();
							$(".button_status").hide();
							$(".button_qrcode").hide();
							$(".button_print").hide();
							$(".button_bulkdestroy").hide();
							$(".button_bulkrestore").hide();
						}
						$("#check_all").prop("checked", false);
						$("#show_all").DataTable().ajax.reload(null, false);
					},
				});
			}
		);
	} else {
		toastr.info("Please select checkbox first if you wanna restore item!");
	}
});


//-[ 07 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_status ]
$(document).on("click", "#button_status", function () {
	const URL = $(this).data("url");
	var checkbox = $(".checkbox:checked");
	if (checkbox.length > 0) {
		var data_arr = [];
		$(checkbox).each(function () {
			data_arr.push($(this).val());
		});
		swal(
			{
				title: "Are you sure?",
				text: "You're going to changes this data!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-warning",
				confirmButtonText: "Yes, Sure!",
				closeOnConfirm: true,
				animation: false,
			},
			function () {
				$.ajax({
					url: URL,
					type: "POST",
					dataType: "JSON",
					data: {
						data_arr: data_arr,
					},
					stateSave: true,
					success: function (response) {
						var socket = new WebSocket(WEBSOCKET_URL);
						socket.onopen = function (e) {
							console.log("Connection established!");
							socket.send(response.socket);
						};
						myalert(response);
						$("#check_all").prop("checked", false);
						$(".button_create").show();
						$(".button_refresh").show();
						$(".button_import").show();
						$(".button_export").show();
						$(".button_filter").show();
						$(".button_filter2").show();
						$(".button_status").hide();
						$(".button_qrcode").hide();
						$(".button_print").hide();
						$(".button_setup").hide();
						$(".button_bulkdestroy").hide();
						$("#show_all").DataTable().ajax.reload(null, false);
					},
				});
			}
		);
	} else {
		toastr.info(
			"Please select checkbox first if you wanna change status item!"
		);
	}
});


//-[ 08 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_filter for admin ]
$(document).on("click", "#button_filter", function (e) {
	$.ajax({
		url: "dashboard/filter",
		type: "POST",
		dataType: "JSON",
		success: function (response) {
			$("#fira-show").modal({
				backdrop: "static",
				keyboard: false,
			});
			$(".modal-dialog").draggable({
				handle: ".modal-header",
			});

			$("#fira-title").text(response.title);
			$("#fira-view").html(response.html);
		},
	});
});


//-[ 09 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_filter2 for client ]
$(document).on("click", "#button_filter2", function (e) {
	let URL = $("#lombok").data("url");
	$.ajax({
		url: URL + "filter",
		type: "POST",
		dataType: "JSON",
		success: function (response) {
			$("#fira-show").modal({
				backdrop: "static",
				keyboard: false,
			});
			$(".modal-dialog").draggable({
				handle: ".modal-header",
			});
			$("#fira-title").text(response.title);
			$("#fira-view").html(response.html);
		},
	});
});


//-[ 10 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_import ]
$(document).on("click", "#button_import", function () {
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


//-[ 11 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_export ]
$(document).on("click", "#button_export", function () {
	const _export = $(this).data("export");
	const URL = $("#lombok").data("url");
	$.ajax({
		url: URL,
		type: "POST",
		dataType: "JSON",
		data: {
			export: _export,
		},
		success: function (response) {
			$("#main-view").html(response.html);
		},
	});
});


//-[ 12 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_refresh ]
$(document).on("click", "#button_refresh", function () {
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

//-[ 13 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_activitylog ]
$(document).on("click", ".button_activitylog", function () {
	const URL = $(this).data("url");
	const id = $(this).data("id");
	$.ajax({
		url: URL,
		type: "POST",
		dataType: "JSON",
		data: {
			id: id,
		},
		success: function (response) {
			$("#data_log")
				.removeClass("button_activitylog btn-danger")
				.addClass("btn-exit btn-primary");
			$("#data_log").text("Exit");
			$("#show-activitylog").html(response.html);
		},
	});
});


//-[ 14 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ btn-exit ]
$(document).on("click", ".btn-exit", function () {
	$("#data_log")
		.removeClass("btn-exit btn-primary")
		.addClass("button_activitylog btn-danger");
	$("#data_log").text("Activitylog");
	$("#show-activitylog").html("");
});


//-[ 15 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ btn_back ]
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


//-[ 16 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ post-data ]
$(document).on("submit", "#post-data", function (e) {
	if (e.isDefaultPrevented()) {
		return false;
	}
	e.preventDefault();
	const URL = $(this).data("url");
	const formElement = $(this).closest("form")[0];
	const formData = new FormData(formElement);
	$.ajax({
		url: URL,
		method: "POST",
		data: formData,
		dataType: "JSON",
		processData: false,
		contentType: false,
		success: function (response) {
			if (response.html == null) {
				var socket = new WebSocket(WEBSOCKET_URL);
				socket.onopen = function (e) {
					console.log("Connection established!");
					socket.send(response.socket);
				};
				clear_modal();
				myalert(response);
				$("#show_all").DataTable().ajax.reload(null, false);
			} else {
				var socket = new WebSocket(WEBSOCKET_URL);
				socket.onopen = function (e) {
					console.log("Connection established!");
					socket.send(response.socket);
				};
				myalert(response);
				$("#main-view").html(response.html);
			}
		},
	});
});


//-[ 17 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_access ]
$(document).on("click", "#button_access", function () {
	const URL = $(this).data("url");
	const status = $(this).data("status");
	var checkbox = $(".checkbox:checked");
	if (checkbox.length > 0) {
		var data_arr = [];
		$(checkbox).each(function () {
			data_arr.push($(this).val());
		});
		swal(
			{
				title: "Are you sure?",
				text: "you're going to switch permission to this accounts!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-warning",
				confirmButtonText: "Yes, Sure!",
				closeOnConfirm: true,
				animation: false,
			},
			function () {
				$.ajax({
					url: URL,
					type: "POST",
					dataType: "JSON",
					data: {
						status: status,
						data_arr: data_arr,
					},
					stateSave: true,
					success: function (response) {
						var socket = new WebSocket(WEBSOCKET_URL);
						socket.onopen = function (e) {
							console.log("Connection established!");
							socket.send(response.socket);
						};
						myalert(response);
						$("#check_all").prop("checked", false);
						$(".button_create").show();
						$(".button_refresh").show();
						$(".button_import").show();
						$(".button_export").show();
						$(".button_filter").show();
						$(".button_filter2").show();
						$(".button_status").hide();
						$(".button_qrcode").hide();
						$(".button_print").hide();
						$(".button_bulkdestroy").hide();
						$("#show_all").DataTable().ajax.reload(null, false);
					},
				});
			}
		);
	}
});


//-[ 18 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_setup ]
$(document).on("click", "#button_setup", function () {
	const URL = $(this).data("url");
	var checkbox = $(".checkbox:checked");
	if (checkbox.length > 0) {
		var data_arr = [];
		$(checkbox).each(function () {
			data_arr.push($(this).val());
		});
		swal(
			{
				title: "Are you sure?",
				text: "You will setup permission access!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-warning",
				confirmButtonText: "Yes, Setup!",
				closeOnConfirm: true,
				animation: false,
			},
			function () {
				$.ajax({
					url: URL,
					type: "POST",
					dataType: "JSON",
					data: {
						data_arr: data_arr,
					},
					stateSave: true,
					success: function (response) {
						var socket = new WebSocket(WEBSOCKET_URL);
						socket.onopen = function (e) {
							console.log("Connection established!");
							socket.send(response.socket);
						};
						myalert(response);
						$("#check_all").prop("checked", false);
						$(".button_create").show();
						$(".button_refresh").show();
						$(".button_import").show();
						$(".button_export").show();
						$(".button_filter").show();
						$(".button_filter2").show();
						$(".button_status").hide();
						$(".button_qrcode").hide();
						$(".button_print").hide();
						$(".button_bulkdestroy").hide();
						$("#show_all").DataTable().ajax.reload(null, false);
					},
				});
			}
		);
	}
});


//-[ 19 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ check_all checkbox ]
$(document).on("change", "#check_all", function (e) {
	var checked = $(this).is(":checked");
	var is_deleted = $("#trash").val();
	if (checked) {
		if (is_deleted == 1) {
			$(".button_setup").hide();
			$(".button_create").hide();
			$(".button_import").hide();
			$(".button_export").hide();
			$(".button_refresh").hide();
			$(".button_bulkdestroy").show();
			$(".button_bulkrestore").show();
			$(".button_filter").hide();
			$(".button_filter2").hide();
			$(".checkbox").each(function () {
				$(this).prop("checked", true);
			});
		} else if (is_deleted == 2) {
			$(".button_setup").hide();
			$(".button_create").hide();
			$(".button_import").hide();
			$(".button_export").hide();
			$(".button_refresh").hide();
			$(".button_status").show();
			$(".button_bulkdestroy").show();
			$(".button_bulkrestore").hide();
			$(".button_filter").hide();
			$(".button_filter2").hide();
			$(".checkbox").each(function () {
				$(this).prop("checked", true);
			});
		} else {
			$(".button_setup").show();
			$(".button_qrcode").show();
			$(".button_print").show();
			$(".button_create").hide();
			$(".button_import").hide();
			$(".button_export").hide();
			$(".button_filter").hide();
			$(".button_refresh").hide();
			$(".button_status").show();
			$(".button_filter").hide();
			$(".button_filter2").hide();
			$(".button_bulkdestroy").show();
			$(".checkbox").each(function () {
				$(this).prop("checked", true);
			});
		}
	} else {
		if (is_deleted == 1) {
			$(".button_create").hide();
			$(".button_import").hide();
			$(".button_export").hide();
			$(".button_bulkdetroy").hide();
			$(".button_bulkrestore").show();
			$(".button_refresh").show();
			$(".button_filter").show();
			$(".button_filter2").show();
			$(".button_setup").hide();
			$(".checkbox").each(function () {
				$(this).prop("checked", false);
			});
		} else if (is_deleted == 2) {
			$(".button_create").hide();
			$(".button_import").hide();
			$(".button_export").hide();
			$(".button_refresh").show();
			$(".button_show").hide();
			$(".button_filter2").show();
			$(".button_status").show();
			$(".button_bulkdestroy").show();
			$(".button_bulkrestore").hide();
			$(".button_filter").show();
			$(".button_filter2").show();
			$(".button_setup").hide();
			$(".checkbox").each(function () {
				$(this).prop("checked", false);
			});
		} else {
			$(".button_create").show();
			$(".button_import").show();
			$(".button_export").show();
			$(".button_filter").show();
			$(".button_refresh").show();
			$(".button_bulkdestroy").hide();
			$(".button_filter").show();
			$(".button_filter2").show();
			$(".button_status").hide();
			$(".button_qrcode").hide();
			$(".button_print").hide();
			$(".button_setup").hide();
			$(".checkbox").each(function () {
				$(this).prop("checked", false);
			});
		}
	}
});


//-[ 20 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ checkox ]
$(document).on("change", ".checkbox", function (e) {
	var checked = $(".checkbox").closest("tr").find(":checkbox").is(":checked");
	var is_deleted = $("#trash").val();
	if (checked) {
		if (is_deleted == 1) {
			$(".button_create").hide();
			$(".button_import").hide();
			$(".button_export").hide();
			$(".button_bulkdestroy").show();
			$(".button_status").hide();
			$(".button_qrcode").hide();
			$(".button_print").hide();
			$(".button_refresh").hide();
			$(".button_filter").show();
			$(".button_filter2").show();
			$(".button_setup").hide();
			$(".button_reset").hide();
			$(".button_bulkrestore").show();
		} else {
			$(".button_create").hide();
			$(".button_import").hide();
			$(".button_export").hide();
			$(".button_bulkdestroy").show();
			$(".button_status").show();
			$(".button_refresh").hide();
			$(".button_filter").hide();
			$(".button_reset").show();
			$(".button_setup").show();
			$(".button_qrcode").show();
			$(".button_print").show();
			$(".button_filter2").hide();
		}
	} else {
		if (is_deleted == 1) {
			$(".button_create").hide();
			$(".button_import").hide();
			$(".button_export").hide();
			$(".button_refresh").show();
			$(".button_bulkdestroy").show();
			$(".button_status").hide();
			$(".button_qrcode").hide();
			$(".button_print").hide();
			$(".button_filter").show();
			$(".button_filter2").show();
			$(".button_reset").hide();
			$(".button_setup").hide();
			$(".button_bulkrestore").show();
		} else {
			$(".button_create").show();
			$(".button_import").show();
			$(".button_export").show();
			$(".button_refresh").show();
			$(".button_filter").show();
			$(".button_filter2").show();
			$(".button_reset").hide();
			$(".button_setup").hide();
			$(".button_bulkdestroy").hide();
			$(".button_status").hide();
			$(".button_qrcode").hide();
			$(".button_print").hide();
		}
	}
});


//-[ 21 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ pagination datatable ]
$(document).on(".pagination draw.dt", function () {
	var is_deleted = $("#trash").val();

	if (is_deleted === "undefined" || is_deleted === "") {
		var table = $("#show_all").DataTable();
		var info = table.page.info();
		if (info.pages == 0) {
			$(".check_all").prop("disabled", true);
		} else {
			$(".check_all").prop("disabled", false);
		}
		$(".check_all").each(function () {
			$(this).prop("checked", false);
		});
		$(".button_create").show();
		$(".button_import").show();
		$(".button_export").show();
		$(".button_refresh").show();
		$(".button_filter").show();
		$(".button_filter2").show();
		$(".button_status").hide();
		$(".button_qrcode").hide();
		$(".button_print").hide();
		$(".button_bulkdestroy").hide();
		$(".button_bulkrestore").hide();
	} else {
		if (is_deleted == 1) {
			var table = $("#show_all").DataTable();
			var info = table.page.info();
			if (info.pages == 0) {
				$(".check_all").prop("disabled", true);
			} else {
				$(".check_all").prop("disabled", false);
			}
			$(".button_create").hide();
			$(".button_import").hide();
			$(".button_export").hide();
			$(".button_refresh").show();
			$(".button_filter").show();
			$(".button_filter2").hide();
			$(".button_status").hide();
			$(".button_qrcode").hide();
			$(".button_print").hide();
			$(".button_setup").hide();
			$(".button_bulkdestroy").show();
			$(".button_bulkrestore").show();
		} else {
			var table = $("#show_all").DataTable();
			var info = table.page.info();
			if (info.pages == 0) {
				$(".check_all").prop("disabled", true);
			} else {
				$(".check_all").prop("disabled", false);
			}
			$(".button_create").hide();
			$(".button_import").hide();
			$(".button_export").hide();
			$(".button_refresh").show();
			$(".button_filter").show();
			$(".button_filter2").show();
			$(".button_status").show();
			$(".button_setup").show();
			$(".button_qrcode").show();
			$(".button_print").show();
			$(".button_bulkdestroy").show();
			$(".button_bulkrestore").hide();
		}
	}
});


//-[ 22 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ getFile ]
$(document).on("click", "#getFile", function () {
	const file = $(this).data("file");
	$.ajax({
		url: APP_URL + "assets/backend/uploads/files/" + file,
		method: "GET",
		xhrFields: {
			responseType: "blob",
		},
		success: function (data) {
			var a = document.createElement("a");
			var url = window.URL.createObjectURL(data);
			a.href = url;
			a.download = file;
			document.body.append(a);
			a.click();
			a.remove();
			window.URL.revokeObjectURL(url);
		},
	});
});


//-[ 23 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ show modal ]
function modal_show(response) {
	$("#modal-show").modal({
		backdrop: "static",
		keyboard: false,
	});
	$("#title-view").text(response.title);
	$("#modal-view").html(response.html);
}


//-[ 24 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ show modal filter ]
function fira_show(response) {
	$("#fira-show").modal({
		backdrop: "static",
		keyboard: false,
	});
	$("#fira-title").text(response.title);
	$("#fira-view").html(response.html);
}


//-[ 25 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ show alert message ]
function myalert(response) {
	// 200 => success
	// toastr.options.progressBar = true
	// toastr.options.closeButton = true
	// 200 => success

	//---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ response 200 ]
	if (response.status == 200) {
		toastr["success"](response.message, response.user);
	}

	// 401 => Unauthorized
	//---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ response 401 ]
	if (response.status == 401) {
		toastr["error"](response.message, response.user);
	}

	// 403  => Forbidden
	//---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ response 403 ]
	if (response.status == 403) {
		toastr["error"](response.message, response.user);
	}

	// 404  => Not found
	//---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ response 404 ]
	if (response.status == 404) {
		toastr["warning"](response.message, response.user);
	}

	// 440  => Expired session
	//---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ response 440 ]
	if (response.status == 440) {
		toastr["error"](response.message, response.user);
		if (response.status == 440) {
			setInterval(() => {
				window.location.href = BASE_URL + "dashboard";
			}, 4000);
		}
	}
}


//-[ 26 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ clear modal ]
function clear_modal() {
	$("#modal-show").modal("hide");
}


//-[ 27 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_logout ]
$(document).on("click", "#button_logout", function (e) {
	swal(
		{
			title: "Are you sure?",
			text: "You will not be able to recover this imaginary file!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			confirmButtonText: "Yes, Logout!",
			closeOnConfirm: true,
			animation: false,
		},
		function () {
			$.ajax({
				url: APP_URL + "auth/logout",
				type: "POST",
				dataType: "JSON",
				data: {},
				stateSave: true,
				success: function (response) {
					myalert(response);
					setInterval(() => {
						window.location.href = APP_URL + "login";
					}, 1000);
				},
			});
		}
	);
});


//-[ 28 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ save_filter ]
function save_filter() {
	var data = $("#form_filter").serialize();
	var URL = $("#lombok").data("url");
	var ___recycle_bin = $("#___recycle_bin").val();
	var is_deleted = $("#trash").val(___recycle_bin);
	$.ajax({
		type: "POST",
		url: URL + "store_filter",
		data: data,
		async: true,
		success: function () {
			if (is_deleted == 1) {
				$(".button_create").hide();
				$(".button_import").hide();
				$(".button_export").hide();
				$(".button_bulkdestroy").show();
				$(".button_bulkrestore").show();
				$(".button_filter").show();
				$(".button_refresh").hide();
			} else if (is_deleted == 2) {
				$(".button_create").hide();
				$(".button_import").hide();
				$(".button_export").hide();
				$(".button_refresh").show();
				$(".button_filter").show();
				$(".button_bulkrestore").hide();
				$(".button_bulkdestroy").hide();
			} else {
				$(".button_create").show();
				$(".button_import").show();
				$(".button_export").show();
				$(".button_refresh").show();
				$(".button_filter").show();
				$(".button_bulkrestore").hide();
				$(".button_bulkdestroy").hide();
			}
			$("#check_all").prop("checked", false);
			$("#show_all").DataTable().ajax.reload();
		},
	});
}


//-[ 29 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ filter_reset ]
function filter_reset() {
	let URL = $("#lombok").data("url");
	$.ajax({
		type: "POST",
		url: URL + "index",
		async: true,
		success: function () {
			$("#form_filter").trigger("reset");
			$(".select_user").val(null).trigger("change");
			$(".select2").val(null).trigger("change");
			$(".select_data").val(null).trigger("change");
		},
	});
}


//-[ 30 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ number to rupiah format ]
function convertRupiah(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);
	let separator;
	if (ribuan) {
		separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}
	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
}


//-[ 31 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ check is number key ]
function isNumberKey(evt) {
	key = evt.which || evt.keyCode;
	if (
		key != 188 && // Comma
		key != 8 && // Backspace
		key != 17 &&
		(key != 86) & (key != 67) && // Ctrl c, ctrl v
		(key < 48 || key > 57) // Non digit
	) {
		evt.preventDefault();
		return;
	}
}


//-[ 32 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ ucword provinsi ]
function _ucwords(str) {
	return str.toLowerCase().replace(/(?<= )[^\s]|^./g, (a) => a.toUpperCase());
}


//-[ 33 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_qrcode ]
$(document).on("click", "#button_qrcode", function () {
	const URL = $(this).data("url");
	var checkbox = $(".checkbox:checked");
	if (checkbox.length > 0) {
		var data_arr = [];
		$(checkbox).each(function () {
			data_arr.push($(this).val());
		});
		swal(
			{
				title: "Are you sure?",
				text: "You will generate QRcode!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-warning",
				confirmButtonText: "Yes, Generate!",
				closeOnConfirm: true,
				animation: false,
			},
			function () {
				$.ajax({
					url: URL,
					type: "POST",
					dataType: "JSON",
					data: {
						data_arr: data_arr,
					},
					stateSave: true,
					success: function (response) {
						myalert(response);
						$("#check_all").prop("checked", false);
						$(".button_create").show();
						$(".button_refresh").show();
						$(".button_import").show();
						$(".button_export").show();
						$(".button_filter").show();
						$(".button_filter2").show();
						$(".button_status").hide();
						$(".button_qrcode").hide();
						$(".button_print").hide();
						$(".button_bulkdestroy").hide();
						$("#show_all").DataTable().ajax.reload(null, false);
					},
				});
			}
		);
	}
});


//-[ 34 ]--------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ button_qrcode ]
$(document).on("click", "#button_print", function () {
	const URL = $(this).data("url");
	var checkbox = $(".checkbox:checked");
	if (checkbox.length > 0) {
		var data_arr = [];
		$(checkbox).each(function () {
			data_arr.push($(this).val());
		});
		swal(
			{
				title: "Are you sure?",
				text: "You will print QRcode!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-warning",
				confirmButtonText: "Yes, Print!",
				closeOnConfirm: true,
				animation: false,
			},
			function () {
				$.ajax({
					url: URL,
					type: "POST",
					dataType: "JSON",
					data: {
						data_arr: data_arr,
					},
					stateSave: true,
					success: function (response) {
						var printWindow = "";
						var result = ""
						if (response.status == "success") {
							for (var i = 0; i < data_arr.length; i++) {
							  result +='<img src="./assets/backend/uploads/qrcode/'+data_arr[i] +'.png" class="img-thumbnail" alt="Haura Nichi" width="65" height="65">'
							}
							printWindow = window.open()
							printWindow.document.write(result)
							setTimeout(() => {
							  printWindow.print()
							  printWindow.close()
							}, 200)
						  }
					},
				});
			}
		);
	}
});


$(document).on("click", ".site-gridmenu .button_menu", function () {
	const URL = $(this).data("url");
	const menu = $(this).data("menu");
	swal(
		{
			title: "Are you sure?",
			text: "You're going switch menu to " + menu,
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-primary",
			confirmButtonText: "Yes, Switch now!",
			closeOnConfirm: true,
			animation: false,
		},
		function () {
			$.ajax({
				url: URL,
				type: "POST",
				dataType: "JSON",
				data: {
					menu: menu,
				},
				stateSave: true,
				success: function (response) {
					if (response.status == 200) {
						myalert(response)
						setInterval(() => {
							window.location.href = BASE_URL + "dashboard";
						}, 1000);
					}
				},
			});
		}
	);
});


var ctrlKeyDown = false;

$(document).keydown(function (e) {
	//---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ ctrl + space -> quick menu ]
	if (e.ctrlKey && e.keyCode == 32) {
		$.ajax({
			url: APP_URL + "dashboard/menu_search",
			type: "POST",
			dataType: "JSON",
			data: {},
			success: function (response) {
				$("#fira-show").modal({
					backdrop: "static",
					keyboard: false,
				});
				$("#fira-show").draggable({
					handle: ".modal-header",
				});
		
				$("#fira-title").text(response.title);
				$("#fira-view").html(response.html);
			},
		});
	}

	$("#fira-show").on("show.bs.modal", function(e) {
		$(".modal-dialog").css({
		  top: 0,
		  left: 0
		})
	});

	//---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ close quick memnu -> ` ]
	if (e.keyCode == 192) {
		// reset modal if it isn't visible
		$("#fira-show").modal("hide");
		if (!$(".modal.in").length) {
			$("#fira-show").css({
				top: 20,
				left: 100,
			});
		}
		$("#fira-show").val(1).trigger("change.select2");
	}
	

	//---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ close button_add -> escape ]
	// if (e.keyCode == 27) {
	// 	$("#btn_back").trigger("click");
	// }

	//---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ show add menu -> ctrl + shift + space ]
	// if (e.keyCode == 18 && e.keyCode == 65) {
	// 	$("#button_create").trigger("click");
	// }
});

//---------->>>>>>>>>>>>>>>>>>>>----------------------------------------------------------------------------------------------------[ list menu ]
function menu_selected() {
	let page = $("#menu_search").val();
	if (page.length > 0) {
		$.ajax({
			type: "POST",
			url: APP_URL + page,
			dataType: "JSON",
			data: {},
			success: function (response) {
				$("#main-view").html(response.html);
			},
			error: function (response) {
				myalert(response);
			},
		});
	}
}

// $(document).ready(function(){
//     $(document).on("keydown", keydown);
//     $(document).on("keyup", keyup);
// });

// function keydown(e) {
//     // Bloack refresh
//     if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
//         // Pressing F5 or Ctrl+R
//         e.preventDefault();
//     } else if ((e.which || e.keyCode) == 17) {
//         // Pressing  only Ctrl
//         ctrlKeyDown = true;
//     }
// };

// function keyup(e){
//     // Key up Ctrl
//     if ((e.which || e.keyCode) == 17)
//         ctrlKeyDown = false;
// };



//---------->>>>>>>>>>>>>>>>>>>>-------------------------------------------------------------[ End Script ] -------------------------------------------------------------<<<<<<<<<<<<<<<<<<<<----------
