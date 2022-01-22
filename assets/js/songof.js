$(function () {
	setTimeout("displaytime()", 1000);
});
function displaytime() {
	var dt = new Date();
	$("#time").html(dt.toLocaleTimeString("en-GB"));
	setTimeout("displaytime()", 1000);
}
$(function () {
	$("#datepicker1").datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+10",
	});
});
$(function () {
	$("#datepicker2").datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+10",
	});
});
$(function () {
	$("#datepicker3").datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+10",
	});
});

// update biodata

$(function () {
	//tambah data titik koordinat patroli
	$("#formADDTikor").on("submit", function (e) {
		e.preventDefault();
		const id = $("select[name=id_plan] option:selected").val();
		const lokasi = $("#lokasi").val();
		const lat = $("#latitude").val();
		const long = $("#longitude").val();
		if (id == null || id == "") {
			Swal.fire({
				icon: "error",
				info: "Attention",
				text: "Pilih Area Kerja",
			});
		} else if (lokasi == null || lokasi == "") {
			Swal.fire({
				icon: "error",
				info: "Attention",
				text: "Lokasi harap di isi",
			});
		} else if (lat == null || lat == "") {
			Swal.fire({
				icon: "error",
				info: "Attention",
				text: "Latitude harap di isi",
			});
		} else if (long == null || long == "") {
			Swal.fire({
				icon: "error",
				info: "Attention",
				text: "Longitude harap di isi",
			});
		} else {
			//alert($("#formADDTikor").attr('data-upload'));
			$.ajax({
				url: $("#formADDTikor").attr("data-upload"),
				method: "POST",
				data: new FormData(this),
				processData: false,
				contentType: false,
				beforeSend: function () {
					document.getElementById("infoSave").style.display = "block";
				},
				complete: function (e) {
					document.getElementById("infoSave").style.display = "none";
				},
				success: function (e) {
					if (e == "sukses") {
						Swal.fire({
							icon: "success",
							info: "Attention",
							text: "Berhasil",
						}).then(function () {
							window.location.href = $("#formADDTikor").attr("data-refresh");
						});
					} else {
						Swal.fire({
							icon: "warning",
							info: "Ulang Pendaftaran",
							text: "Terjadi kesalahan",
						}).then(function () {
							window.location.href = $("#formADDTikor").attr("data-refresh");
						});
					}
				},
			});
		}
	});

	//update data titik koordinat
	$("#updateTitik").on("submit", function (e) {
		e.preventDefault();
		const id = $("select[name=id_plan2] option:selected").val();
		const lokasi = $("#lokasi2").val();
		const lat = $("#latitude2").val();
		const long = $("#longitude2").val();
		if (id == null || id == "") {
			Swal.fire({
				icon: "error",
				info: "Attention",
				text: "Pilih Area Kerja",
			});
		} else if (lokasi == null || lokasi == "") {
			Swal.fire({
				icon: "error",
				info: "Attention",
				text: "Lokasi harap di isi",
			});
		} else if (lat == null || lat == "") {
			Swal.fire({
				icon: "error",
				info: "Attention",
				text: "Latitude harap di isi",
			});
		} else if (long == null || long == "") {
			Swal.fire({
				icon: "error",
				info: "Attention",
				text: "Longitude harap di isi",
			});
		} else {
			$.ajax({
				url: $("#updateTitik").attr("data-update"),
				method: "POST",
				data: new FormData(this),
				processData: false,
				contentType: false,
				beforeSend: function () {
					document.getElementById("infoSave2").style.display = "block";
				},
				complete: function (e) {
					document.getElementById("infoSave2").style.display = "none";
				},
				success: function (e) {
					if (e == "sukses") {
						Swal.fire({
							icon: "success",
							info: "Attention",
							text: "Berhasil",
						}).then(function () {
							window.location.href = $("#formADDTikor").attr("data-refresh");
						});
					} else {
						Swal.fire({
							icon: "warning",
							info: "Ulang Pendaftaran",
							text: "Terjadi kesalahan",
						}).then(function () {
							window.location.href = $("#formADDTikor").attr("data-refresh");
						});
					}
				},
			});
		}
	});
});
//

//fungsi hapus
function hapusTikor(id) {
	Swal.fire({
		title: "Hapus Titik?",
		text: "Data tidak bisa di kembalikan !",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Ya !",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: $("#infoTitik").attr("data-delete"),
				method: "GET",
				data: "id=" + id,
				success: function (e) {
					Swal.fire("Deleted!").then(function () {
						window.location.href = $("#formADDTikor").attr("data-refresh");
					});
				},
			});
		}
	});
}

$(document).ready(function () {
	// Untuk sunting modal titik area
	$("#edit-data").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		// Isi nilai pada field
		modal.find("#id").attr("value", div.data("id"));
		modal.find("#lokasi2").attr("value", div.data("lokasi"));
		modal.find("#longitude2").attr("value", div.data("long"));
		modal.find("#latitude2").attr("value", div.data("lat"));
		modal.find("#id_plan2").attr("value", div.data("area"));
	});
});
<<<<<<< HEAD

// api wilayah sample

// end tes sample
=======
>>>>>>> f33318bbb26ed793c30aa8a174dbd481395a3426
