<?php 
if ($this->ion_auth->logged_in())
{
  redirect('dashboard', 'refresh');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Jalantah | Reset Password</title>
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
        <form action="<?php echo base_url('forgot_password/reset/').$code;?>" method="post" id="form-reset" class="card card-md">
			<input type="hidden" nmae="user_id" value="<?php echo $user_id; ?>">
			<div class="card-body">
				<h2 class="card-title text-center mb-1">Reset Password</h2>
				<div class="mb-3">
					<label class="form-label">Password Baru</label>
					<input type="password" class="form-control" name="new" id="new" placeholder="Password"  autocomplete="off">
				</div>
				<div class="mb-2">
					<label class="form-label">Konfirmasi Password Baru</label>
					<input type="password" class="form-control" name="new_confirm" id="new_confirm" placeholder="Password"  autocomplete="off">
				</div>
				<div class="form-footer">
				<button type="submit" class="btn btn-primary w-100">Reset Password</button>
				</div>
			</div>
        </form>
      </div>
    </div>
</body>
<script data-main="<?php echo base_url()?>assets/js/main/main-forgot-password" src="<?php echo base_url()?>assets/js/require.js"></script>
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
</html>