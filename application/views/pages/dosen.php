<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DOSEN</h2>
            </div>
            <?php if($this->session->flashdata('dosen')):?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Data dosen <strong>berhasil</strong> <?= $this->session->flashdata('dosen');?>
                </div>
            <?php endif;?>
        <!-- Custom Content -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Data Dosen
                            <!-- <small>With a bit of extra markup, it's possible to add any kind of HTML content like headings, paragraphs, or buttons into thumbnails.</small> -->
                        </h2>
                    </div>
                    <?php if(validation_errors()):?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors();?>
                        </div>
                    <?php endif;?>
                    
                    <div class="body">
                        <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#myFormD"><i class="material-icons">add</i></button>
                        <button type="button" class="btn btn-primary waves-effect"><i class="material-icons">picture_as_pdf</i></button>
                        <hr>
                        <div class="row">
                        <?php foreach($dosen as $d):?>
                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img src="<?= base_url();?>assets/images/dosen/<?= $d['foto'];?>" width="300" height="350">
                                    <div class="caption">
                                        <h3><?= $d['nama'];?></h3>
                                        <p>- <?= $d['email'];?></p>
                                        <p>- <?= $d['minat_ajar'];?></p>
                                        <p>- <?= $d['keterangan'];?></p>
                                        <p>
                                        <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#myForm<?= $d['id_dosen'];?>"><i class="material-icons">mode_edit</i></button>
                                            <a href="" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" type="submit" class="btn btn-danger waves-effect"><i class="material-icons">delete</i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Custom Content -->
    </div>
</section>
<!-- Modal -->
<div id="myFormD" class="modal fade" role="dialog">
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
                            Tambah Data Dosen
                        </h2>
                    </div>
                    
                    <div class="body">
                        <!-- Advanced Validation -->
                        <form id="form_advanced_validation" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <label class="form-label">NIP</label>
                                <div class="form-line">
                                    <input type="number" class="form-control" name="nip" placeholder="Masukkan NIP">
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Nama</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Email</label>
                                <div class="form-line">
                                    <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <p>Minat Ajar</p>
                                    <select class="form-control show-tick" name="minat_ajar">
                                        <option></option>
                                        <?php foreach($minat as $p):?>
                                            <option value="<?= $p;?>"><?= $p;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Foto</label>
                                <div class="form-line">
                                    <input type="file" class="form-control" name="foto" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Keterangan</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="keterangan" placeholder="Keterangan">
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