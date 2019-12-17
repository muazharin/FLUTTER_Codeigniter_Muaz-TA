<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                ABSEN
                <!-- <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small> -->
            </h2><br>
            <?php if($this->session->flashdata('absen')):?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Data absen <strong>berhasil</strong> <?= $this->session->flashdata('absen');?>
            </div>
            <?php endif;?>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            TABEL ABSEN 
                        </h2>
                    </div>
                    <?php if(validation_errors()):?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors();?>
                        </div>
                    <?php endif;?>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-md-10">
                                <form id="form_advanced_validation" method="post" action="" enctype="multipart/form-data">
                                    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                                      <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="matkul">
                                                    <option>Mata Kuliah</option>
                                                    <?php foreach($matkul as $mat):?>
                                                        <option value="<?= $mat['nama_mata_kuliah'];?>"><?= $mat['nama_mata_kuliah'];?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                                      <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="kelas">
                                                    <option>Kelas</option>
                                                    <?php foreach($kelas as $kel):?>
                                                        <option value="<?= $kel;?>"><?= $kel;?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                                        <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">SUBMIT</button>
                                    </div>
                                </form>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <a href="<?= base_url();?>absen/export/<?= $judul_matkul;?>/<?= $judul_kelas;?>" type="submit" class="btn btn-success btn-lg m-l-15 waves-effect">CETAK</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <center><h5><?= $judul_matkul;?> &nbsp; &nbsp;||&nbsp; &nbsp;<?= $judul_kelas;?></h5> </center> 
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" style="overflow: auto;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                        <th>6</th>
                                        <th>7</th>
                                        <th>8</th>
                                        <th>9</th>
                                        <th>10</th>
                                        <th>11</th>
                                        <th>12</th>
                                        <th>13</th>
                                        <th>14</th>
                                        <th>15</th>
                                        <th>16</th>
                                        <th>%</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                        <th>6</th>
                                        <th>7</th>
                                        <th>8</th>
                                        <th>9</th>
                                        <th>10</th>
                                        <th>11</th>
                                        <th>12</th>
                                        <th>13</th>
                                        <th>14</th>
                                        <th>15</th>
                                        <th>16</th>
                                        <th>%</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 0;?>
                                    <?php foreach($absen as $ab): $i++?>
                                    <?php 
                                        $bc = '';
                                        $cr = '';
                                        if($ab['persentase'] < 13){
                                            $bc = '#fcba03';
                                            $cr = 'white';
                                        }
                                    ?>
                                    <tr style="background-color: <?= $bc; ?>; color: <?= $cr;?>;">
                                        <td><?= $i;?></td>
                                        <td> <a target="_blank" href="<?= base_url();?>mahasiswa/cariMahasiswa/<?= $ab['nim'];?>"><?= $ab['nim'];?></a> </td>
                                        <td><?= $ab['nama_mhs'];?></td>
                                        <td <?php if($ab['per_satu'] == 'a'){?> style="color: red;"<?php }else if($ab['per_satu']=='i'){?>style="color: green;"<?php }else if($ab['per_satu']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_satu'];?></b></td>
                                        <td <?php if($ab['per_dua'] == 'a'){?> style="color: red;"<?php }else if($ab['per_dua']=='i'){?>style="color: green;"<?php }else if($ab['per_dua']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_dua'];?></b></td>
                                        <td <?php if($ab['per_tiga'] == 'a'){?> style="color: red;"<?php }else if($ab['per_tiga']=='i'){?>style="color: green;"<?php }else if($ab['per_tiga']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_tiga'];?></b></td>
                                        <td <?php if($ab['per_empat'] == 'a'){?> style="color: red;"<?php }else if($ab['per_empat']=='i'){?>style="color: green;"<?php }else if($ab['per_empat']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_empat'];?></b></td>
                                        <td <?php if($ab['per_lima'] == 'a'){?> style="color: red;"<?php }else if($ab['per_lima']=='i'){?>style="color: green;"<?php }else if($ab['per_lima']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_lima'];?></b></td>
                                        <td <?php if($ab['per_enam'] == 'a'){?> style="color: red;"<?php }else if($ab['per_enam']=='i'){?>style="color: green;"<?php }else if($ab['per_enam']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_enam'];?></b></td>
                                        <td <?php if($ab['per_tujuh'] == 'a'){?> style="color: red;"<?php }else if($ab['per_tujuh']=='i'){?>style="color: green;"<?php }else if($ab['per_tujuh']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_tujuh'];?></b></td>
                                        <td <?php if($ab['per_delapan'] == 'a'){?> style="color: red;"<?php }else if($ab['per_delapan']=='i'){?>style="color: green;"<?php }else if($ab['per_delapan']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_delapan'];?></b></td>
                                        <td <?php if($ab['per_sembilan'] == 'a'){?> style="color: red;"<?php }else if($ab['per_sembilan']=='i'){?>style="color: green;"<?php }else if($ab['per_sembilan']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_sembilan'];?></b></td>
                                        <td <?php if($ab['per_sepuluh'] == 'a'){?> style="color: red;"<?php }else if($ab['per_sepuluh']=='i'){?>style="color: green;"<?php }else if($ab['per_sepuluh']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_sepuluh'];?></b></td>
                                        <td <?php if($ab['per_sebelas'] == 'a'){?> style="color: red;"<?php }else if($ab['per_sebelas']=='i'){?>style="color: green;"<?php }else if($ab['per_sebelas']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_sebelas'];?></b></td>
                                        <td <?php if($ab['per_dua_belas'] == 'a'){?> style="color: red;"<?php }else if($ab['per_dua_belas']=='i'){?>style="color: green;"<?php }else if($ab['per_dua_belas']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_dua_belas'];?></b></td>
                                        <td <?php if($ab['per_tiga_belas'] == 'a'){?> style="color: red;"<?php }else if($ab['per_tiga_belas']=='i'){?>style="color: green;"<?php }else if($ab['per_tiga_belas']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_tiga_belas'];?></b></td>
                                        <td <?php if($ab['per_empat_belas'] == 'a'){?> style="color: red;"<?php }else if($ab['per_empat_belas']=='i'){?>style="color: green;"<?php }else if($ab['per_empat_belas']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_empat_belas'];?></b></td>
                                        <td <?php if($ab['per_lima_belas'] == 'a'){?> style="color: red;"<?php }else if($ab['per_lima_belas']=='i'){?>style="color: green;"<?php }else if($ab['per_lima_belas']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_lima_belas'];?></b></td>
                                        <td <?php if($ab['per_enam_belas'] == 'a'){?> style="color: red;"<?php }else if($ab['per_enam_belas']=='i'){?>style="color: green;"<?php }else if($ab['per_enam_belas']=='s'){?>style="color: blue;"<?php }?> > <b><?= $ab['per_enam_belas'];?></b></td>
                                        <td><?= ($ab['persentase']/16)*100;?></td>
                                        <td>
                                            <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#myForm<?= $ab['id_absen'];?>"><i class="material-icons">mode_edit</i></button>
                                            <a href="<?= base_url();?>absen/hapus_absen/<?= $ab['id_absen'];?>/<?= $ab['nim'];?>/<?= $ab['nama_mata_kuliah'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" type="submit" class="btn btn-danger waves-effect"><i class="material-icons">delete</i></a>
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
<?php foreach($absen as $ab): ?>
<!-- Modal -->
<div id="myForm<?= $ab['id_absen'];?>" class="modal fade" role="dialog">
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
                            Edit Data Absen
                        </h2>
                    </div>
                    <div class="body">
                        <!-- Advanced Validation -->
                        <form id="form_advanced_validation" method="post" action="absen/edit_absen">
                            <div class="form-group form-float">
                                <label class="form-label">Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<?= $ab['nama_mhs'];?></label><br>
                                <label class="form-label">Mata Kuliah :&nbsp;<?= $ab['nama_mata_kuliah'];?></label>
                            </div>
                            <div class="form-group form-float">
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <p>Kelas</p>
                                    <select class="form-control show-tick" name="kel">
                                        <option></option>
                                        <?php foreach($kelas as $k):?>
                                            <?php if($k == $ab['kelas']){?>
                                                <option value="<?= $k;?>" selected><?= $k;?></option>
                                            <?php }else{?>
                                                <option value="<?= $k;?>"><?= $k;?></option>
                                            <?php }?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 1</p>
                                        <select class="form-control show-tick" name="per_satu">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_satu']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 2</p>
                                        <select class="form-control show-tick" name="per_dua">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_dua']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 3</p>
                                        <select class="form-control show-tick" name="per_tiga">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_tiga']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 4</p>
                                        <select class="form-control show-tick" name="per_empat">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_empat']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 5</p>
                                        <select class="form-control show-tick" name="per_lima">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_lima']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 6</p>
                                        <select class="form-control show-tick" name="per_enam">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_enam']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 7</p>
                                        <select class="form-control show-tick" name="per_tujuh">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_tujuh']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 8</p>
                                        <select class="form-control show-tick" name="per_delapan">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_delapan']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 9</p>
                                        <select class="form-control show-tick" name="per_sembilan">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_sembilan']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 10</p>
                                        <select class="form-control show-tick" name="per_sepuluh">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_sepuluh']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 11</p>
                                        <select class="form-control show-tick" name="per_sebelas">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_sebelas']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 12</p>
                                        <select class="form-control show-tick" name="per_dua_belas">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_dua_belas']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 13</p>
                                        <select class="form-control show-tick" name="per_tiga_belas">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_tiga_belas']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 14</p>
                                        <select class="form-control show-tick" name="per_empat_belas">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_empat_belas']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 15</p>
                                        <select class="form-control show-tick" name="per_lima_belas">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_lima_belas']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <p>Pertemuan 16</p>
                                        <select class="form-control show-tick" name="per_enam_belas">
                                            <option></option>
                                            <?php foreach($pilih as $pil):?>
                                                <?php if($pil == $ab['per_enam_belas']){?>
                                                    <option value="<?= $pil;?>" selected><?= $pil;?></option>
                                                <?php }else{?>
                                                    <option value="<?= $pil;?>"><?= $pil;?></option>
                                                <?php }?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br> -->
                            <input type="hidden" class="form-control" name="id_absen" value="<?= $ab['id_absen'];?>" required>
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