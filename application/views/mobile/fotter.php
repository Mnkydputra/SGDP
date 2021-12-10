



<!-- FOTTER -->
<div  class="container-md">
            <nav style="background-color:#F5F2EB;
                border-radius: 8%;
                box-sizing: border-box;
                box-shadow: -7px -7px 10px #cbced1, -7px -7px 10px #F5F2EB;
                height:60px;
                padding-top:10px;
                padding-right:20px; padding-left:20px;" id="navbot1" class="navbar text-dark fixed-bottom roundedmurry navbar-light">
                <div class="container-fluid">
                    <a class="navbar-expand-md nostyle text-center" href="<?= base_url('Anggota/')?>Dashboard"><i class='bx bxs-home-heart bx-sm'></i><br><p id="navbot" class="text-center">Home</p></a>
                    <a class="navbar-expand-md nostyle text-center" href="<?= base_url('Anggota/')?>Inbox"><i class='bx bxs-inbox bx-sm'></i><br><p id="navbot" class="text-center">Inbox</p></a>
                    <a class="navbar-expand-md nostyle text-center" href="<?= base_url('Anggota/')?>Course"><i class='bx bxs-food-menu bx-sm'></i><br><p id="navbot" class="text-center">Course</p> </a>
                    <a class="navbar-expand-md nostyle text-center" href="<?= base_url('Anggota/')?>Profile"><i class='bx bxs-user bx-sm'></i><br><p id="navbot" class="text-center">Profile</p></a>
                </div>
            </nav>
         </div>
<!-- END FOTTER -->
</body>

<script type="text/javascript">
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
           mask : '0000-0000-0000'
        }
        var maskEmer = {
           mask : '0000-0000-0000'
        }
        var maskKK = {
          mask : '0000-0000-0000-0000'
        }
        var rtKtp = {
            mask : '+{0}00'
        }
        var rwKtp = {
            mask : '{0}00'
        }
        var rtDom = {
            mask : '+{0}00'
        }
        var rwDom = {
            mask : '+{0}00'
        }
        var maskKTA = {
          mask : '00.00.000000'
        } 
        var ktp = IMask(no_ktp, maskOptions);
        var telp = IMask(no_telp,maskTel);
        var emer = IMask(no_emerr,maskEmer);
        var kk = IMask(no_kk,maskKK);
        var kta = IMask(no_kta,maskKTA);
        var rtktp = IMask(rt_ktp,rtKtp);
        var rwktp = IMask(rw_ktp,rwKtp);
        var rtdom = IMask(rt_dom,rtDom);
        var rwdom = IMask(rw_dom,rwDom);
    </script>

    <script type="text/javascript">
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

    </script>
   
  
</html>