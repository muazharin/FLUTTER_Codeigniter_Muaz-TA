<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                MAHASISWA
                <!-- <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small> -->
            </h2>
        </div>
        <?php if($this->session->flashdata('mahasiswa')):?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Data mahasiswa <strong>berhasil</strong> <?= $this->session->flashdata('mahasiswa');?>
            </div>
        <?php endif;?>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Tabel Mahasiswa
                        </h2>
                    </div>
                    <?php if(validation_errors()):?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors();?>
                        </div>
                    <?php endif;?>
                    <div class="body">
                        <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#myForm"><i class="material-icons">add</i></button>
                        <button type="button" class="btn btn-primary waves-effect"><i class="material-icons">picture_as_pdf</i></button>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Foto</th>
                                        <th>QR Code</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Foto</th>
                                        <th>QR Code</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 0;?>
                                    <?php foreach($mahasiswa as $mhs): $i++?>
                                    <tr>
                                        <td><?= $i;?></td>
                                        <td><?= $mhs['nim'];?></td>
                                        <td><?= $mhs['nama'];?></td>
                                        <td><img src="<?= base_url();?>assets/images/mahasiswa/<?= $mhs['foto']; ?>" width="100px"></td>
                                        <td><img src="<?= base_url();?>assets/images/qr_mhs/<?= $mhs['qr_code']; ?>" width="100px"></td>
                                        <td>
                                            <button type="button" class="btn btn-success waves-effect"><i class="material-icons">mode_edit</i></button>
                                            <a href="<?= base_url();?>mahasiswa/hapus/<?= $mhs['id_mhs'];?>/<?= $mhs['foto']?>/<?= $mhs['qr_code']?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" type="submit" class="btn btn-danger waves-effect"><i class="material-icons">delete</i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
    </div>
</section>

<!-- Modal -->
<div id="myForm" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!-- <h4 class="modal-title">Modal Header</h4> -->
      </div>
      <div class="modal-body">
        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Tambah Data Mahasiswa
                        </h2>
                    </div>
                    <div class="body">
                        <!-- Advanced Validation -->
                        <form id="form_advanced_validation" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <label class="form-label">NIM</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nim" placeholder="Masukkan NIM Mahasiswa" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Nama</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Mahasiswa" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Tempat Lahir</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Tanggal Lahir</label>
                                <div class="form-line">
                                    <input type="date" class="form-control" name="tanggal_lahir" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Foto</label>
                                <div class="form-line">
                                    <input type="file" class="form-control" name="foto" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Horizontal Layout -->
      </div>
    </div>

  </div>
</div>