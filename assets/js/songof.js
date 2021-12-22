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
    $(document).ready(function() {
        $("#tinggi_badan, #berat_badan").keyup(function() {
            var height  = $("#tinggi_badan").val();
            var weight = $("#berat_badan").val();
            var bagi  = 100;
            var floatTinggi = parseFloat(height);
            var floatBerat  = parseFloat(weight);
            var imt = (floatBerat / (floatTinggi * floatTinggi)*10000);
            if (imt > 27) {
                keterangan = "Gemuk, Kelebihan berat badan tingkat berat";
            }else if ((imt >= 25.1) & (imt <= 27)){
                keterangan = "Gemuk, Kelebihan berat badan tingkat ringan";
            }else if ((imt >= 18.5) & (imt <= 25)){
                keterangan = "Normal";
            } else if ((imt >= 17) & (imt <= 18.4)){
                keterangan = "Kurus, Kekurangan berat badan tingkat ringan";
            }else {
                keterangan = "Kurus, Kekurangan berat badan tingkat berat";
            }
            $("#imt").val(imt);
            $("#keterangan").val(keterangan);    
            });
        });
        $(function(){
        var no_ktp = document.getElementById('no_ktp');
        var no_telp = document.getElementById('no_hp');
        var no_emerr = document.getElementById('no_emergency');
        var no_kk = document.getElementById('no_kk');
        var no_kta = document.getElementById('no_kta');
        var rt_ktp = document.getElementById('rt_ktp');
        var rw_ktp = document.getElementById('rw_ktp');
        var rt_dom = document.getElementById('rt_dom');
        var rw_dom = document.getElementById('rw_dom');
        var maskOptions = {
          mask: '0000-0000-0000-0000'
        };
        var maskNpwp = {
           mask  :'00.000.000.0-000.000'
        }
        var maskTel = {
           mask : '+{62}000-0000-0000'
        }
        var maskEmer = {
           mask : '+{62}000-0000-0000'
        }
        var maskKK = {
          mask : '0000-0000-0000-0000'
        }
        var maskKTA = {
          mask : '00.00.000000'
        } 
        var ktp = IMask(no_ktp, maskOptions);
        var telp = IMask(no_telp,maskTel);
        var emer = IMask(no_emerr,maskEmer);
        var kk = IMask(no_kk,maskKK);
        var kta = IMask(no_kta,maskKTA);
        })
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
    
       

  