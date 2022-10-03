<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $page_description; ?></h1>
	<?php if ($this->data['is_can_create']) {?>
	<a href="<?php echo base_url('role/create') ?>" class="d-none d-sm-inline-block btn btn-primary shadow-sm">
		<i class="fas fa-plus fa-sm text-white-50"></i> Jabatan
	</a>
	<?php } ?>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Datalist Jabatan</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Jabatan</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>
<script data-main="<?php echo base_url() ?>assets/js/main/main-role" src="<?php echo base_url() ?>assets/js/require.js"></script>