<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Koperasi Bogor Gading Residence</title>

	<link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/nunito/nunito.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/font-awesome/css/all.min.css">
	<style>
		.error {
			color: #e74a3b !important;
			font-size: 0.8rem !important;
			width: 100%;
		}
	</style>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6 mt-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
						<div class="p-5">
							<div class="text-center">
								<img src="<?php echo base_url("assets/images/logo.png") ?>" class="mb-3" width="100px" alt="">
								<h1 class="h5 text-gray-900 mb-4">SISTEM INFORMASI <br><b>KOPERASI BOGOR GADING RESIDENCE</b></h1>
							</div>
							<form action="<?php echo base_url(); ?>auth/login" class="user" method="post" id="form-login" autocomplete="off">
								<div class="form-group">
									<input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Masukan Username...">
								</div>
								<div class="form-group">
									<input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Masukan Password">
								</div>
								<hr>
								<button type="submit" class="btn btn-primary btn-user btn-block">
									Login
								</button>
							</form>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
</body>

<script data-main="<?php echo base_url() ?>assets/js/main/main-login" src="<?php echo base_url() ?>assets/js/require.js"></script>

</html>