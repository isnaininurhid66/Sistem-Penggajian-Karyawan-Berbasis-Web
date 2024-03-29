<?php
error_reporting(0); 
include 'system/proses.php';
$connect = mysqli_connect("localhost", "root", "", "penggajian");
$query = "SELECT max(nip) as maxKode FROM pegawai";
$hasil = mysqli_query($connect, $query);
$data = mysqli_fetch_array($hasil);
$kodebarang = $data['maxKode'];
$nourut = (int) substr($kodebarang, 5, 5);
$nourut++;
$char = "186";
$nomot = $char . sprintf("%05s", $nourut);
?>








<div class="container-fluid"><!-- Page-Title -->
	<div class="row">
		<div class="col-sm-12">
			<div class="page-title-box">
				<div class="btn-group float-right">
					<ol class="breadcrumb hide-phone p-0 m-0">
						<li class="breadcrumb-item">
							<a href="#">Drixo</a>
						</li>
						<li class="breadcrumb-item">
							<a href="#">Master</a>
						</li>
						<li class="breadcrumb-item active">
							<a href="#">Karyawan</a>
						</li>

					</ol>
				</div>
				<h4 class="page-title">Karyawan</h4>
			</div>
		</div>
	</div><!-- end page title end breadcrumb -->
	<div class="row">
		<div class="col-12">
			<div class="card m-b-30">
				<div class="card-body">
					<h4 class="mt-0 header-title">Data Karyawan</h4>
					<div class="col-sm-5">

					</div>
					<br>
					<a href="index.php?p=f_pegawai" class="btn btn-primary">Tambah Data</a>
					<br>
					<div class="form-inline">
						<form action="" method="POST">
							<input type="text" name="nama" placeholder="Masukkan Keyword Pencarian..." class="form-control" value="<?php echo $_POST['nama'] ?>" autocomplete="off"id="keyword">



							&nbsp;
							<button type="submit" name="cari" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;Cari</button>
							
						</form>

						
						<br><br><br><br>
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama Depan</th>
									<th>Nama Belakang</th>
									<th>Tempat Lahir</th>
									<th>Tanggal Lahir</th>
									<th>Cabang</th>
									<th>Kode Jabatan</th>
									<th>Status</th>
									<th>Alamat</th>
									<th>Kelurahan</th>
									<th>Kecamatan</th>
									<th>Kota</th>
									<th>Kode Pos</th>
									


								
									<th>Absen</th>

									<th>Aksi</th>
								</tr>
							</thead>
							<?php 
							if(isset($_POST['cari'])){
								$nama = $_POST['nama'];
								$qr = $db->get("pegawai.nip,pegawai.absen,pegawai.alamat,pegawai.cabang,pegawai.nama,pegawai.tempat_lahir,pegawai.tanggal_lahir,jabatan.nama_jabatan,golongan.golongan,pegawai.status,pegawai.jumlah_anak","pegawai","INNER JOIN jabatan on pegawai.kode_jabatan=jabatan.kode_jabatan INNER JOIN golongan on golongan.kode_golongan=pegawai.kode_golongan WHERE pegawai.nama LIKE '%$nama%' OR
									pegawai.nip LIKE '%$nama%' OR
									pegawai.tempat_lahir LIKE '%$nama%' OR
									pegawai.cabang LIKE '%$nama%' OR
									pegawai.tanggal_lahir LIKE '%$nama%' OR
									jabatan.nama_jabatan LIKE '%$nama%' OR
									pegawai.kode_golongan LIKE '%$nama%' OR
									pegawai.status LIKE '%$nama%' ORDER BY pegawai.nip ASC");

							}else{
								$qr = $db->get("pegawai.kelurahan,pegawai.kecamatan,pegawai.kota,pegawai.kode_pos,pegawai.nip,pegawai.absen,pegawai.alamat,pegawai.cabang,pegawai.nama,pegawai.nama2,pegawai.tempat_lahir,pegawai.tanggal_lahir,jabatan.nama_jabatan,golongan.golongan,pegawai.status,pegawai.jumlah_anak","pegawai","INNER JOIN jabatan on pegawai.kode_jabatan=jabatan.kode_jabatan INNER JOIN golongan on golongan.kode_golongan=pegawai.kode_golongan ORDER BY pegawai.nip ASC");
							}
							?>
							
							
							<?php 
							
							foreach($qr as $tampil):

								?>
								<tr>
									<td><?php echo $tampil['nip'] ?></td>
									<td><?php echo $tampil['nama'] ?></td>
									<td><?php echo $tampil['nama2'] ?></td>
									<td><?php echo $tampil['tempat_lahir'] ?></td>
									<td><?php echo $tampil['cabang'] ?></td>
									<td><?php echo $tampil['tanggal_lahir'] ?></td>
									<td><?php echo $tampil['nama_jabatan'] ?></td>
									<td><?php echo $tampil['status'] ?></td>
									<td><?php echo $tampil['alamat'] ?></td>
									<td><?php echo $tampil['kelurahan'] ?></td>
									<td><?php echo $tampil['kecamatan'] ?></td>
									<td><?php echo $tampil['kota'] ?></td>
									<td><?php echo $tampil['kode_pos'] ?></td>
									

								
									<td><?php echo $tampil['absen'] ?></td>

									<td>
										<a href="crud/hapus_pegawai.php?id=<?php echo $tampil['nip'] ?>" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>


										<a href="#myModal" class="btn btn-warning" id="custId" data-toggle="modal" title="Edit Pegawai" data-id="<?= $tampil['nip']; ?>" style="color: #fff;"><i class="fa fa-pencil-alt"></i></a>

										<a href="#myModal4" class="btn btn-warning" id="custId" data-toggle="modal" title="Edit Absen Masuk" data-id="<?= $tampil['nip']; ?>" style="color: #000;"><i class="fa fa-pencil-alt"></i></a>

									</td>
								</tr>
							<?php endforeach; ?>
							
							
						</table>
						
					</div>
				</div>
			</div><!-- end col -->
		</div><!-- end row -->
		
	</div><!-- end container -->



	<!-- Modal Edit -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">

					<h4 class="modal-tittle">
						Edit Pegawai
					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="fatched-data">

					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- Modal Edit absen -->
	<div class="modal fade" id="myModal4" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">

					<h4 class="modal-tittle">
						Edit Pegawai Absen
					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="fatched-data4">

					</div>
				</div>

			</div>
		</div>
	</div>

<script type="text/javascript">
	function cetak_pegawai(){
		var data = $('#keyword').val();
		if (data=="") {
			window.open("content/print_pegawai.php");
		}else{
			window.open("content/print_pegawai.php?key="+data);
		}
		
	}
</script>