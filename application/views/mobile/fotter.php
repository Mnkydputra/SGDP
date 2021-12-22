



<!-- FOTTER -->
<?php if($this->session->userdata('role_id') == 1) { ?>
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
        <?php }else if($this->session->userdata('role_id') == 2){ ?> 
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
                <a class="navbar-expand-md nostyle text-center" href="#"><i class='bx bxs-inbox bx-sm'></i><br><p id="navbot" class="text-center">Anggota</p></a>
                <a class="navbar-expand-md nostyle text-center" href="<?= base_url('Anggota/')?>Course"><i class='bx bxs-food-menu bx-sm'></i><br><p id="navbot" class="text-center">Course</p> </a>
                <a class="navbar-expand-md nostyle text-center" href="<?= base_url('Anggota/')?>Profile"><i class='bx bxs-user bx-sm'></i><br><p id="navbot" class="text-center">Profile</p></a>
            </div>
            </nav>
          </div>
    
        <?php }else if($this->session->usedata('role_id') == 3) {?>
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
                        <a class="navbar-expand-md nostyle text-center" href="#"><i class='bx bxs-inbox bx-sm'></i><br><p id="navbot" class="text-center">Anggota</p></a>
                        <a class="navbar-expand-md nostyle text-center" href="<?= base_url('Anggota/')?>Course"><i class='bx bxs-food-menu bx-sm'></i><br><p id="navbot" class="text-center">Course</p> </a>
                        <a class="navbar-expand-md nostyle text-center" href="<?= base_url('Anggota/')?>Profile"><i class='bx bxs-user bx-sm'></i><br><p id="navbot" class="text-center">Profile</p></a>
                    </div>
                    </nav>
                </div>
        <?php } ?>

<!-- END FOTTER -->
</body>

<script type="text/javascript">
        
    </script>

    <script type="text/javascript">
      
    </script>
   
  
</html>