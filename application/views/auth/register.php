<?php 
if ($this->ion_auth->logged_in())
{
  redirect('dashboard', 'refresh');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Jalantah | Register</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon">
    <link href="<?php echo base_url();?>assets/css/tabler/tabler.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets/css/tabler/demo.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2.min.css">
</head>

<body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
        <div class="container-md py-4">
            <div class="text-center mb-4">
            <h1>Jalantah</h1>
            <!-- <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.svg" height="36" alt=""></a> -->
            <?php $this->load->view('errors/html/alert') ?>
            </div>
            <div class="row row-cards">
                <div class="col-lg-1">
                </div>
                <div class="col-lg-10">
                    <form class="card" id="form" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
                        <div class="card-body">
                            <h2 class="card-title text-center mb-3">Register</h2>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Pengguna</label>
                                        <input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="Nama Pengguna">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" autocomplete="off" placeholder="Email">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nomor Telepon</label>
                                        <input type="text" class="form-control number" name="phone" id="phone" autocomplete="off" placeholder="Nomor Telepon">
                                    </div>
                                </div>

                                <div class="col-6">	
                                    <div class="mb-3">
                                        <label class="form-label">Jabatan</label>
                                        <select class="form-select" name="role_id" id="role_id">
                                            <option value="">Pilih Jabatan</option>
                                            <?php if(!empty($roles)){
                                                foreach ($roles as $role) {
                                            ?>
                                                <option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
                                            <?php } }  ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" autocomplete="off" placeholder="Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" autocomplete="off" placeholder="Konfirmasi Password">
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea class="form-control" name="address" id="address" rows="6" autocomplete="off" placeholder="Alamat"></textarea>
                                    </div>
                                            </div>

                                        </div>
                            <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100" id="save-btn">Buat Akun Baru</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center text-muted mt-3">
            Sudah mempunyai akun? <a href="<?php echo base_url('login'); ?>" tabindex="-1">Login</a>
            </div>
        </div>
    </div>
</body>
<script data-main="<?php echo base_url()?>assets/js/main/main-register" src="<?php echo base_url()?>assets/js/require.js"></script>
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
</html>
