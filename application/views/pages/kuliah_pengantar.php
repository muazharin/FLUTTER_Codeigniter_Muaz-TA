<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Mata Kuliah Pengantar
                <!-- <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small> -->
            </h2>
        </div>
        <?php if($this->session->flashdata('mk_pengantar')):?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Data mata kuliah <strong>berhasil</strong> <?= $this->session->flashdata('mk_pengantar');?>
            </div>
        <?php endif;?>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Tabel Mata Kuliah Pengantar
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
                                        <th>Kode</th>
                                        <th>Nama Mata Kuliah</th>
                                        <th>Dosen1</th>
                                        <th>Dosen2</th>
                                        <th>Kelas</th>
                                        <th>Semester</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Mata Kuliah</th>
                                        <th>Dosen1</th>
                                        <th>Dosen2</th>
                                        <th>Kelas</th>
                                        <th>Semester</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 0;?>
                                    <?php foreach($pengantar as $pen): $i++?>
                                    <tr>
                                        <td><?= $i;?></td>
                                        <td><?= $pen['kode_mata_kuliah'];?></td>
                                        <td><?= $pen['nama_mata_kuliah'];?></td>
                                        <td><?= $pen['dosen_satu'];?></td>
                                        <td><?= $pen['dosen_dua'];?></td>
                                        <td><?= $pen['kelas'];?></td>
                                        <td><?= $pen['semester'];?></td>
                                        <td>
                                            <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#myForm<?= $pen['id_mata_kuliah_pengantar'];?>"><i class="material-icons">mode_edit</i></button>
                                            <a href="<?= base_url();?>mahasiswa/hapus/<?= $pen['id_mata_kuliah_pengantar'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" type="submit" class="btn btn-danger waves-effect"><i class="material-icons">delete</i></a>
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
                            Tambah Mata Kuliah
                        </h2>
                    </div>
                    <div class="body">
                        <!-- Advanced Validation -->
                        <form id="form_advanced_validation" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <label class="form-label">Kode Mata Kuliah</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="kode_mk" placeholder="Masukkan Kode Mata Kuliah" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Nama Mata Kuliah</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nama_mk" placeholder="Masukkan Nama Mata Kuliah" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Dosen 1</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="dosen_satu" placeholder="Masukkan Dosen 1" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Dosen 2</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="dosen_dua" placeholder="Masukkan Dosen 2" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <p>Kelas</p>
                                    <select class="form-control show-tick" name="kelas">
                                        <option></option>
                                        <?php foreach($kelas as $kel):?>
                                            <option value="<?= $kel;?>"><?= $kel;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <p>Semester</p>
                                    <select class="form-control show-tick" name="semester">
                                        <option></option>
                                        <?php foreach($semester as $sem):?>
                                            <option value="<?= $sem;?>"><?= $sem;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
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

<?php foreach($pengantar as $pen): ?>
<!-- Modal -->
<div id="myForm<?= $pen['id_mhs'];?>" class="modal fade" role="dialog">
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
                        <form id="form_advanced_validation" method="post" action="mahasiswa/edit" enctype="multipart/form-data">
                        <div class="form-group form-float">
                                <label class="form-label">Kode Mata Kuliah</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="kode_mk1" placeholder="Masukkan NIM Mahasiswa" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Nama Mata Kuliah</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nama_mk1" placeholder="Masukkan NIM Mahasiswa" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Dosen 1</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="dosen_satu1" placeholder="Masukkan NIM Mahasiswa" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Dosen 2</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="dosen_dua1" placeholder="Masukkan NIM Mahasiswa" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <p>Kelas</p>
                                    <select class="form-control show-tick" name="kelas1">
                                        <option></option>
                                        <?php foreach($kelas as $kel):?>
                                            <?php if($kel == $pen['kelas']){?>
                                                <option value="<?= $kel;?>"><?= $kel;?></option>
                                            <?php }else{?>
                                                <option value="<?= $kel;?>"><?= $kel;?></option>
                                            <?php }?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <p>Semester</p>
                                    <select class="form-control show-tick" name="semester1">
                                        <option></option>
                                        <?php foreach($semester as $sem):?>
                                            <?php if($sem == $pen['semester']){?>
                                                <option value="<?= $sem;?>"><?= $sem;?></option>
                                            <?php }else{?>
                                                <option value="<?= $sem;?>"><?= $sem;?></option>
                                            <?php }?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="id_mata_kuliah_pengantar1" value="<?= $pen['id_mata_kuliah_pengantar'];?>" required>
                            <button class="btn btn-primary waves-effect" type="submit">Perbarui</button>
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
<?php endforeach;?>