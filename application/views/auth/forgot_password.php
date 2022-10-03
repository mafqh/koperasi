<?php 
if ($this->ion_auth->logged_in())
{
  redirect('dashboard', 'refresh');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Jalantah | Lupa Password</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon">
    <link href="<?php echo base_url();?>assets/css/tabler/tabler.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets/css/tabler/demo.min.css" rel="stylesheet"/>
</head>

<body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <h1>Jalantah</h1>
          <!-- <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.svg" height="36" alt=""></a> -->
          <?php $this->load->view('errors/html/alert') ?>
        </div>
        <form action="<?php echo base_url();?>forgot_password" method="post" id="form-reset" class="card card-md">
          <div class="card-body">
            <h2 class="card-title text-center mb-1">Lupa Password</h2>
            <p class="text-center text-muted mb-3">Masukan Email yang terdaftar untuk mendapatkan link reset password</p>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Kirim Link Reset Password</button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Belum mempunyai akun? <a href="<?php echo base_url('register') ?>" tabindex="-1">Register</a>
        </div>
      </div>
    </div>
</body>
<script data-main="<?php echo base_url()?>assets/js/main/main-forgot-password" src="<?php echo base_url()?>assets/js/require.js"></script>
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
</html>
