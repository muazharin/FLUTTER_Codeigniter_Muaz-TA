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
                        <hr>
                        <div class="row">
                                        
                        <?php foreach($dosen as $d):?>
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="<?= base_url();?>assets/images/dosen/<?= $d['foto'];?>" style="width: 200px; height: 250px;">
                                    <div class="caption">
                                        <h5><?= character_limiter($d['nama'], 30);?></h5>
                                        <p>- <?= $d['nip'];?></p>
                                        <p>- <?= character_limiter($d['email'], 10);?></p>
                                        <p>- <?= $d['minat_ajar'];?></p>
                                        <p>- <?= character_limiter($d['keterangan'], 10);?> </p>
                                        <p>
                                            <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#myFormD<?= $d['id_dosen'];?>"><i class="material-icons">mode_edit</i></button>
                                            <a href="<?= base_url();?>dosen/hapus/<?= $d['id_dosen'];?>/<?= $d['foto']?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" type="submit" class="btn btn-danger waves-effect"><i class="material-icons">delete</i></a>
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
<?php foreach($dosen as $d):?>
<!-- Modal -->
<div id="myFormD<?= $d['id_dosen'];?>" class="modal fade" role="dialog">
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
                        <form id="form_advanced_validation" method="post" action="dosen/edit" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <label class="form-label">NIP</label>
                                <div class="form-line">
                                    <input type="number" class="form-control" name="nip1" value="<?= $d['nip'];?>">
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Nama</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nama1" value="<?= $d['nama'];?>" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Email</label>
                                <div class="form-line">
                                    <input type="email" class="form-control" name="email1" value="<?= $d['email'];?>" required>
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <p>Minat Ajar</p>
                                    <select class="form-control show-tick" name="minat_ajar1">
                                        <option></option>
                                        <?php foreach($minat as $p):?>
                                            <?php if($p == $d['minat_ajar']){?>
                                                <option value="<?= $p;?>" selected><?= $p;?></option>
                                            <?php }else{?>
                                                <option value="<?= $p;?>"><?= $p;?></option>
                                            <?php }?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Foto</label>
                                <div class="form-line">
                                    <input type="file" class="form-control" name="foto1">
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Keterangan</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="keterangan1" value="<?= $d['keterangan'];?>">
                                </div>
                                <div class="help-info"></div>
                            </div>
                            <input type="hidden" class="form-control" name="id_dosen1" value="<?= $d['id_dosen'];?>" required>
                            <input type="hidden" class="form-control" name="foto2" value="<?= $d['foto'];?>" required>
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