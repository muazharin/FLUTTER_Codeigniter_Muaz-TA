<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                ABSEN
                <!-- <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small> -->
            </h2>
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
                                    <!-- <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">CETAK</button> -->
                                    <a href="<?= base_url();?>absen/export/<?= $judul_matkul;?>/<?= $judul_kelas;?>" type="submit" class="btn btn-success btn-lg m-l-15 waves-effect">CETAK</a>
                                </div>
                            </div>
                            <!-- <div class="col-md-4 ">
                                <form id="form_advanced_validation" method="post" action="" enctype="multipart/form-data">
                                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="keyword" placeholder="Cari Mahasiswa" required>
                                            </div>
                                            <div class="help-info"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect">CARI</button>
                                    </div>
                                </form>
                            </div> -->
                        </div>
                        <!-- <button type="button" class="btn btn-primary waves-effect"><i class="material-icons">picture_as_pdf</i></button> -->
                        <hr>
                        <center><h5>MATA KULIAH <?= $judul_matkul;?> &nbsp; &nbsp;||&nbsp; &nbsp;KELAS <?= $judul_kelas;?></h5> </center> 
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
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 0;?>
                                    <?php foreach($absen as $ab): $i++?>
                                    <tr>
                                        <td><?= $i;?></td>
                                        <td> <a target="_blank" href="<?= base_url();?>mahasiswa/cariMahasiswa/<?= $ab['nim'];?>"><?= $ab['nim'];?></a> </td>
                                        <td><?= $ab['nama_mhs'];?></td>
                                        <td><?= $ab['per_satu'];?></td>
                                        <td><?= $ab['per_dua'];?></td>
                                        <td><?= $ab['per_tiga'];?></td>
                                        <td><?= $ab['per_empat'];?></td>
                                        <td><?= $ab['per_lima'];?></td>
                                        <td><?= $ab['per_enam'];?></td>
                                        <td><?= $ab['per_tujuh'];?></td>
                                        <td><?= $ab['per_delapan'];?></td>
                                        <td><?= $ab['per_sembilan'];?></td>
                                        <td><?= $ab['per_sepuluh'];?></td>
                                        <td><?= $ab['per_sebelas'];?></td>
                                        <td><?= $ab['per_dua_belas'];?></td>
                                        <td><?= $ab['per_tiga_belas'];?></td>
                                        <td><?= $ab['per_empat_belas'];?></td>
                                        <td><?= $ab['per_lima_belas'];?></td>
                                        <td><?= $ab['per_enam_belas'];?></td>
                                        <td><?= ($ab['persentase']/16)*100;?></td>
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