<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-header flex-nowrap d-print-none">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="page-pretitle text-white">
                        Ubah Profil
                    </div>
                    <h2 class="page-title text-white d-block text-capitalize">
                        <?php echo $users->first_name?>
                    </h2>
                </div>
                <div class="col d-print-none text-end">
                    <div class="float-end">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-fluid pb-5">
        <div class="row row-deck row-cards">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-status-top bg-primary"></div>
                    <div class="card-body">
                        <form class="form-horizontal" id="form-create" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
	                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $users->id; ?>">
	                        <input type="hidden" id="kecamatan_id_selected" value="<?php echo $users->kecamatan_id; ?>">
	                        <input type="hidden" id="kelurahan_id_selected" value="<?php echo $users->kelurahan_id; ?>">
							<div class="card-body">
								<div class="row">
									<div class="col-6">
				                        <div class="mb-3">
				                            <label class="form-label">Nama Pengguna</label>
				                            <input type="text" class="form-control text-only" id="first_name" placeholder="Nama Pengguna" name="first_name" value="<?php echo $users->first_name; ?>">
				                        </div>

				                        <div class="mb-3">
				                            <label class="form-label">NIK</label>
				                            <input type="text" class="form-control number-nospace" id="nik" placeholder="NIK" name="nik" value="<?php echo $users->nik; ?>">
				                        </div>

				                        <div class="mb-3">
				                            <label class="form-label">Email</label>
				                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $users->email; ?>">
				                        </div>

				                        <div class="mb-3">
				                            <label class="form-label">Nomor Telepon</label>
				                            <input type="text" class="form-control number-nospace" id="phone" placeholder="Nomor Telepon" name="phone" value="<?php echo $users->phone; ?>">
				                        </div>

				                        <div class="mb-3">
				                            <label class="form-label">Foto</label> 
				                            <input type="file" class="form-control" id="photo" placeholder="Foto Pengguna" name="photo" accept="image/*">
				                            <br>
				                            <div id="imagePreview">
				                                <img src="<?php echo base_url('uploaded/profile/').$users->kode.'/'.$users->photo; ?>" id="img_preview" class="bg-light border rounded-1">
				                            </div>
				                        </div>
				                    </div>

				                    <div class="col-6">
				                        <div class="mb-3">
				                            <label class="form-label">Provinsi</label>
				                            <select class="form-control provinsi-id" id="provinsi_id" name="provinsi_id" placeholder="Provinsi" data-selectjs="true">
				                                <?php if(!empty($provinsi)){ 
				                                    foreach ($provinsi as $key => $value) {
				                                ?>  
				                                    <option selected value="<?php echo $value->id ?>" ><?php echo $value->name; ?></option>
				                                <?php } } ?>
				                            </select>
				                        </div>

				                        <div class="mb-3">
				                            <label class="form-label">Kota / Kabupaten</label>
				                            <select class="form-control kabupaten-id" id="kabupaten_id" name="kabupaten_id" placeholder="Kota / Kabupaten" data-selectjs="true">
				                                <option value="">Pilih Kota / Kabupaten</option>
				                                <?php if(!empty($kabupaten)){ 
				                                    foreach ($kabupaten as $key => $value) {
				                                ?>  
				                                    <option <?php if($users->kabupaten_id == $value->id){ echo "selected"; } ?> value="<?php echo $value->id ?>" ><?php echo $value->name; ?></option>
				                                <?php } } ?>
				                            </select>
				                        </div>

				                        <div class="mb-3">
				                            <label class="form-label">Kecamatan</label>
				                            <select class="form-control kecamatan-id" id="kecamatan_id" name="kecamatan_id" placeholder="Kecamatan" data-selectjs="true">
				                                <option value="">Pilih Kecamatan</option>
				                            </select>
				                        </div>

				                        <div class="mb-3">
				                            <label class="form-label">Kelurahan</label>
				                            <select class="form-control kelurahan-id" id="kelurahan_id" name="kelurahan_id" placeholder="Kelurahan" data-selectjs="true">
				                                <option value="">Pilih Kelurahan</option>
				                            </select>
				                        </div>

				                        <div class="mb-3">
				                            <label class="form-label">Alamat</label>
				                            <textarea class="form-control text-only" id="address" placeholder="Alamat" name="address" rows="9"><?php echo $users->address; ?></textarea>
				                        </div>
				                    </div>
									
								</div>

							</div>
							<div class="card-footer text-end">
								<div class="d-flex">
									<a href="<?php echo base_url()?>dashboard" class="btn btn-default"><i class='fa fa-close me-2'></i> Batal</a>
									<button type="submit" class="btn btn-yellow ms-auto" id="save-btn"><i class="fa fa-save me-2"></i> Simpan</button>
								</div>
								</div>
							</div>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
							
<script data-main="<?php echo base_url()?>assets/js/main/main-profile" src="<?php echo base_url()?>assets/js/require.js"></script>
