<!DOCTYPE html>
<html lang="en">
    <head>
		<title>Koperasi Gading - Anggota</title>
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
        <h4 class="title text-center">Anggota</h4>
        <p class="paragraph text-right" style="margin-bottom: 10px;"><?php echo date("d/m/Y") ?></p>

        <table class="bordered" style="margin-bottom:30px">
            <thead>
                <tr>
                    <th style="width:20px;">No</th>
                    <th>No.Anggota</th>
                    <th>Nama Anggota</th>
                    <th width="25%">Alamat Anggota</th>
                    <th>No.Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Masuk</th>
                    <th>Username</th>
                    <th>Hak Akses</th>
                </tr>
            </thead>
            <?php if(!empty($listData)){ ?>
            <tbody>
                <?php
                    $no = 1;
                    foreach ($listData as $key => $value) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $value->nik; ?></td>
                    <td><?php echo $value->nama_anggota; ?></td>
                    <td><?php echo $value->alamat_anggota; ?></td>
                    <td><?php echo $value->no_telp; ?></td>
                    <td><?php echo $value->jenis_kelamin; ?></td>
                    <td><?php echo date('d-M-Y', strtotime($value->tanggal_masuk)); ?></td>
                    <td><?php echo $value->username; ?></td>
                    <td><?php echo $value->hak_akses; ?> </td>
                </tr>
                <?php     
                    } } 
                ?>
            </tbody>
        </table>
	</body>
</html>