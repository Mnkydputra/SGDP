
<div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
    <p>Welcome <br> <b> <?= $biodata->nama ?> </b></p>   
    <div class="container-md-3">
        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <label style="font-weight:bold;" class="d-flex align-items-center justify-content-center" >DAFTAR HADIR</label>
        </div>
        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
        <i class='d-flex align-items-center justify-content-center bx bx-time'> <label style="font-weight:bold;" id="time"></label> </i>
        </div> 
    </div>
</div>

<div style="margin-top:100px; padding-top:60mm; background-color:#F9FAFA;"class="container-md mt-5">
                <div class="row">
                    <div class="container-md-3">
                       <div id="myQRCode" class="d-flex align-items-center justify-content-center">
                         <img style="display: none;" src="<?= base_url('assets/img/')?>anton.png" id="img-buffer">
                       </div>
                    </div>
                </div>
</div>
<script type="text/javascript">
       $('#myQRCode').qrcode({
            render: 'canvas',    //Set the rendering mode, there are table and canvas, the rendering performance using canvas is relatively better
            minVersion: 1,       // version range somewhere in 1 .. 40
            maxVersion: 40,
            ecLevel: 'L',        //Recognition degree'L','M','Q' or'H'
            left: 0,
            top: 0,
            size: 200,           //Size
            fill: '#000',        //QR code color
            background: null,    //Background color
            text: 'https://sgdp.rf.gd',     //QR code content
            radius: 0.1,         // 0.0 .. 0.5
            quiet: 2,            //Margin

            // modes
            // 0: normal
            // 1: label strip
            // 2: label box
            // 3: image strip
            // 4: image box
            mode: 4,
            mSize: 0.1,          //size of picture
            mPosX: 0.5,
            mPosY: 0.5,

            label: 'jQuery.qrcode',
            fontname: 'sans',
            fontcolor: '#000',
            image: $("#img-buffer")[0]
        });
</script>
