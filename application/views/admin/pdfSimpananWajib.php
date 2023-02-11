<!DOCTYPE html>
<html lang="en">
    <head>
		<title>Koperasi Gading - Simpanan Wajib</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
		<style type="text/css">
			body {
				font-size: 15px;
			}
		    * {
		        box-sizing: border-box;
		        -moz-box-sizing: border-box;
		    }
            .page_break { page-break-before: always; }
		    .title{
		    	font-weight: bold;
		    	margin: 0 0 20px;
		    	display: block;
		    }
		    .paragraph{
		    	font-size: 14px;
		    	display: block;
		    	margin: 0;
		    	line-height: 1.2;
		    }
		    .text-center{
		    	text-align: center;
		    }
		    .text-right{
		    	text-align: right;
		    }
		    .map-container{
		    	display: block;
		    	width: 100%;
		    	height: 400px;
		    	border: 2px solid #000;
		    	margin: 0 auto 30px;
		    }
		    table{
		    	width: 100%;
		    	border-collapse: collapse;
		    }
		    table th, table td{
		    	padding: 3px;
		    	border-collapse: collapse;
		    	font-size: 14px;
		    }
		    table th{
		    	font-weight: bold;
		    }
		    .bordered th, .bordered td{
		    	border: 1px solid #000;
		    }
		</style>

	</head>

	<body>
        <h2 class="title text-center">KOPERASI BOGOR GADING RESIDENCE</h2>
        <h4 class="title text-center">SIMPANAN WAJIB</h4>
        <p class="paragraph text-right" style="margin-bottom: 10px;"><?php echo date("d/m/Y") ?></p>
        <table style="margin-bottom:20px">
            <tr>
                <td style="width:180px">No Anggota</td>
                <td style="width:10px">:</td>
                <td colspan="4"><?php echo $anggota->nik; ?></td>
            </tr>
            <tr>
                <td style="width:180px">Nama Anggota</td>
                <td style="width:10px">:</td>
                <td colspan="4"><?php echo $anggota->nama_anggota; ?></td>
            </tr>
            <tr>
                <td style="width:180px">Tanggal Masuk</td>
                <td style="width:10px">:</td>
                <td colspan="4"><?php echo date("d-m-Y", strtotime($anggota->tanggal_masuk)); ?></td>
            </tr>
            <tr>
                <td style="width:180px">No.Telepon</td>
                <td style="width:10px">:</td>
                <td colspan="4"><?php echo $anggota->no_telp; ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td colspan="4"><?php echo $anggota->jenis_kelamin; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td colspan="4"><?php echo $anggota->alamat_anggota; ?></td>
            </tr>
        </table>

        <table class="bordered" style="margin-bottom:30px">
            <thead>
                <tr>
                    <th style="width:20px;">No</th>
                    <th>Tanggal Bayar</th>
                    <th>Jumlah Bayar</th>
                </tr>
            </thead>
            <?php if(!empty($listData)){ ?>
            <tbody>
                <?php
                    $nominal = 240000;
                    $no = 1;
                    $total = 0;
                    $sisa = 0;
                    foreach ($listData as $key => $value) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo date('d - M - Y', strtotime($value->tanggal)); ?></td>
                    <td><?php echo "Rp " . number_format($value->jumlah,0,',','.'); ?> </td>
                </tr>
                <?php     
                        $total = $total+$value->jumlah; 
                        $sisa = $nominal-$total;
                        if($sisa < 0){
                            $sisa = 0;
                        }
                    } 
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><b>Total</b></td>
                    <td><b><?= "Rp " . number_format($total,0,',','.'); ?></b></td>
                </tr>
                <tr>
                    <td colspan="2"><b>Harus Dibayar</b></td>
                    <td><b><?= "Rp " . number_format($nominal,0,',','.'); ?></b></td>
                </tr>
                <tr>
                    <td colspan="2"><b>Sisa Bayar</b></td>
                    <td><b><?= "Rp " . number_format($sisa,0,',','.'); ?></b></td>
                </tr>
            </tfoot>
            <?php } ?>
        </table>
	</body>
</html>