    $(function()
    {
        setTimeout("displaytime()",1000);
    })
    function displaytime()
    {
        var dt = new Date();
        $('#time').html(dt.toLocaleTimeString('en-GB'));
        setTimeout("displaytime()",1000);       
    }
    $(function(){
        $( "#datepicker1" ).datepicker({
            dateFormat: 'yy-mm-dd',
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
    

        // ajax lokasi KTP
//    var return_first = function() {
//           var tmp = null;
//           $.ajax({
//               'async': false,
//               'type': "get",
//               'global': false,
//               'dataType': 'json',
//               'url': 'https://x.rajaapi.com/poe',
//               'success': function(data) {
//                   tmp = data.token;
//               }
//           });
//           return tmp;
//       }();
//   $(document).ready(function() {
//       $.ajax({
//           url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/provinsi',
//           type: 'GET',
//           dataType: 'json',
//           success: function(json) {
//               if (json.code == 200) {
//                   for (i = 0; i < Object.keys(json.data).length; i++) {
//                       $('#propinsi').append(
//                           $('<option>')
//                           .text(json.data[i].name)
//                           .attr('data-id', json.data[i].id)
//                           .attr('value',json.data[i].name)
//                           );
//                   }
//               } else {
//                   $('#kabupaten').append(
//                       $('<option>')
//                       .text('Data tidak di temukan')
//                       .attr('value', 'Data tidak di temukan'));
//               }
//           }
//       });
//       $("#propinsi").change(function() {
//           var propinsi = $("#propinsi").find(':selected').data('id');
//           $.ajax({
//               url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kabupaten',
//               data: "idpropinsi=" + propinsi,
//               type: 'GET',
//               cache: false,
//               dataType: 'json',
//               success: function(json) {
//                   $("#kabupaten").html('');
//                   if (json.code == 200) {
//                       for (i = 0; i < Object.keys(json.data).length; i++) {
//                           $('#kabupaten')
//                           .append($('<option>')
//                           .text(json.data[i].name)
//                           .attr('data-id', json.data[i].id)
//                           .attr('value',json.data[i].name)
//                           );
//                       }
//                       $('#kecamatan').html($('<option>').text('-- Pilih Kecamatan --').attr('value', '-- Pilih Kecamatan --'));
//                       $('#kelurahan').html($('<option>').text('-- Pilih Kelurahan --').attr('value', '-- Pilih Kelurahan --'));

//                   } else {
//                       $('#kabupaten').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
//                   }
//               }
//           });
//       });
//       $("#kabupaten").change(function() {
//           var kabupaten = $("#kabupaten").find(":selected").data("id");
//           $.ajax({
//               url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kecamatan',
//               data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi,
//               type: 'GET',
//               cache: false,
//               dataType: 'json',
//               success: function(json) {
//                   $("#kecamatan").html('');
//                   if (json.code == 200) {
//                       for (i = 0; i < Object.keys(json.data).length; i++) {
//                           $('#kecamatan')
//                           .append($('<option>')
//                           .text(json.data[i].name)
//                           .attr('data-id', json.data[i].id)
//                           .attr('value',json.data[i].name)
//                           );
//                       }
//                       $('#kelurahan').html($('<option>').text('-- Pilih Kelurahan --').attr('value', '-- Pilih Kelurahan --'));
                      
//                   } else {
//                       $('#kecamatan').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
//                   }
//               }
//           });
//       });
//       $("#kecamatan").change(function() {
//           var kecamatan = $("#kecamatan").find(":selected").data("id");
//           $.ajax({
//               url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kelurahan',
//               data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi + "&idkecamatan=" + kecamatan,
//               type: 'GET',
//               dataType: 'json',
//               cache: false,
//               success: function(json) {
//                   $("#kelurahan").html('');
//                   if (json.code == 200) {
//                       for (i = 0; i < Object.keys(json.data).length; i++) {
//                           $('#kelurahan')
//                           .append($('<option>')
//                           .text(json.data[i].name)
//                           .attr('data-id', json.data[i].id)
//                           .attr('value', json.data[i].name));
//                       }
//                   } else {
//                       $('#kelurahan').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
//                   }
//               }
//           });
//       });
//   });

//     // ajax lokasi dom
//       var return_first = function() {
//           var tmp = null;
//           $.ajax({
//               'async': false,
//               'type': "get",
//               'global': false,
//               'dataType': 'json',
//               'url': 'https://x.rajaapi.com/poe',
//               'success': function(data) {
//                   tmp = data.token;
//               }
//           });
//           return tmp;
//       }();
//   $(document).ready(function() {
//       $.ajax({
//           url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/provinsi',
//           type: 'GET',
//           dataType: 'json',
//           success: function(json) {
//               if (json.code == 200) {
//                   for (i = 0; i < Object.keys(json.data).length; i++) {
//                       $('#propinsi_dom').append(
//                           $('<option>')
//                           .text(json.data[i].name)
//                           .attr('data-id', json.data[i].id)
//                           .attr('value',json.data[i].name)
//                           );
//                   }
//               } else {
//                   $('#kabupaten_dom').append(
//                       $('<option>')
//                       .text('Data tidak di temukan')
//                       .attr('value', 'Data tidak di temukan'));
//               }
//           }
//       });
//       $("#propinsi_dom").change(function() {
//           var propinsi = $("#propinsi_dom").find(':selected').data('id');
//           $.ajax({
//               url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kabupaten',
//               data: "idpropinsi=" + propinsi,
//               type: 'GET',
//               cache: false,
//               dataType: 'json',
//               success: function(json) {
//                   $("#kabupaten_dom").html('');
//                   if (json.code == 200) {
//                       for (i = 0; i < Object.keys(json.data).length; i++) {
//                           $('#kabupaten_dom')
//                           .append($('<option>')
//                           .text(json.data[i].name)
//                           .attr('data-id', json.data[i].id)
//                           .attr('value',json.data[i].name)
//                           );
//                       }
//                       $('#kecamatan_dom').html($('<option>').text('-- Pilih Kecamatan --').attr('value', '-- Pilih Kecamatan --'));
//                       $('#kelurahan_dom').html($('<option>').text('-- Pilih Kelurahan --').attr('value', '-- Pilih Kelurahan --'));

//                   } else {
//                       $('#kabupaten_dom').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
//                   }
//               }
//           });
//       });
//       $("#kabupaten_dom").change(function() {
//           var kabupaten = $("#kabupaten_dom").find(":selected").data("id");
//           $.ajax({
//               url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kecamatan',
//               data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi,
//               type: 'GET',
//               cache: false,
//               dataType: 'json',
//               success: function(json) {
//                   $("#kecamatan_dom").html('');
//                   if (json.code == 200) {
//                       for (i = 0; i < Object.keys(json.data).length; i++) {
//                           $('#kecamatan_dom')
//                           .append($('<option>')
//                           .text(json.data[i].name)
//                           .attr('data-id', json.data[i].id)
//                           .attr('value',json.data[i].name)
//                           );
//                       }
//                       $('#kelurahan_dom').html($('<option>').text('-- Pilih Kelurahan --').attr('value', '-- Pilih Kelurahan --'));
                      
//                   } else {
//                       $('#kecamatan_dom').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
//                   }
//               }
//           });
//       });
//       $("#kecamatan_dom").change(function() {
//           var kecamatan = $("#kecamatan_dom").find(":selected").data("id");
//           $.ajax({
//               url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kelurahan',
//               data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi + "&idkecamatan=" + kecamatan,
//               type: 'GET',
//               dataType: 'json',
//               cache: false,
//               success: function(json) {
//                   $("#kelurahan_dom").html('');
//                   if (json.code == 200) {
//                       for (i = 0; i < Object.keys(json.data).length; i++) {
//                           $('#kelurahan_dom')
//                           .append($('<option>')
//                           .text(json.data[i].name)
//                           .attr('data-id', json.data[i].id)
//                           .attr('value', json.data[i].name));
//                       }
//                   } else {
//                       $('#kelurahan_dom').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
//                   }
//               }
//           });
//       });
//   });

    // update biodata
    
 
$(function(){
    //tambah data titik koordinat patroli 
    $("#formADDTikor").on('submit',function(e){
        e.preventDefault();
            const id = $("select[name=id_plan] option:selected").val();
            const lokasi = $("#lokasi").val();
            const lat = $("#latitude").val();
            const long = $("#longitude").val();
            if(id == null || id == ""){
                Swal.fire({
                    icon : 'error' ,
                    info : 'Attention' ,
                    text : 'Pilih Plan ID'
                });
            }else if(lokasi == null || lokasi == ""){
                Swal.fire({
                    icon : 'error' ,
                    info : 'Attention' ,
                    text : 'Lokasi harap di isi'
                });
            }else if(lat == null || lat == ""){
                Swal.fire({
                    icon : 'error' ,
                    info : 'Attention' ,
                    text : 'Latitude harap di isi'
                });
            }else if(long == null || long == ""){
                Swal.fire({
                    icon : 'error' ,
                    info : 'Attention' ,
                    text : 'Longitude harap di isi'
                });
            }else {
                //alert($("#formADDTikor").attr('data-upload'));
                $.ajax({
                    url : $("#formADDTikor").attr('data-upload') ,
                    method : "POST" ,
                    data : new FormData(this),
                    processData : false  ,
                    contentType : false ,
                    success : function(e){
                        if(e == "sukses"){
                            Swal.fire({
                                icon : 'success' ,
                                info : 'Attention' ,
                                text : 'Berhasil'
                            }).then(function(){
                                window.location.href= $("#formADDTikor").attr('data-refresh') ;
                            })
                        }else{
                            Swal.fire({
                                icon : 'warning' ,
                                info : 'Ulang Pendaftaran' ,
                                text : 'Terjadi kesalahan'
                            }).then(function(){
                                window.location.href= $("#formADDTikor").attr('data-refresh') ;
                            })
                        }                        
                    }
                })
            }
        })
        
        // // Untuk sunting
        // $('#edit-data').on('show.bs.modal', function (event) {
        //     var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
        //     var modal          = $(this)
        //     // Isi nilai pada field
        //     modal.find('#id').attr("value",div.data('id'));
        //     modal.find('#nama').attr("value",div.data('nama'));
        //     modal.find('#alamat').html(div.data('alamat'));
        //     modal.find('#pekerjaan').attr("value",div.data('pekerjaan'));
        // });
    })
    // 
    
    //fungsi hapus 
    function hapusTikor(id){
        Swal.fire({
            title: 'Hapus Titik?',
            text: "Data tidak bisa di kembalikan !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya !'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : $("#infoTitik").attr('data-delete') ,
                    method : "GET" ,
                    data : 'id='+ id ,
                    success : function(e){
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.' + e,
                            'success'
                        ).then(function(){
                            window.location.href = $("#formADDTikor").attr('data-refresh');
                        })
                    }
                })
            }
          })
    }