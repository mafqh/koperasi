<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view("backend/layouts/header");?>

<body id="page-top">
	<div id="wrapper">
		<?php $this->load->view("backend/layouts/sidemenu");?>

		<div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

				<?php $this->load->view("backend/layouts/topbar");?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
					<?php $this->load->view($content);?>
					
                </div>
                <!-- /.container-fluid -->
				
            </div>
            <!-- End of Main Content -->
			
            <!-- Footer -->
			<?php $this->load->view("backend/layouts/footer");?>
            <!-- End of Footer -->

        </div>
	</div>

	<a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Ingin Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik Logout untuk mengakhiri sesi.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?php echo base_url('auth/logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>
	<?php $this->load->view('errors/html/alert_error')?>

	<div id="alert_modal" class="modal fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">	
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center py-4">
					<i class="fa fa-exclamation-triangle text-danger" style="font-size: 48px"></i>
					<h3 class="modal-title alert-title"></h3>
					<div class="text-muted alert-msg"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary alert-cancel" data-bs-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-danger ms-auto alert-ok">OK</button>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
</body>

</html>