<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <!-- <i class="material-icons">playlist_add_check</i> -->
                        <i class="material-icons">layers</i>
                    </div>
                    <div class="content">
                        <div class="text">DOSEN</div>
                        <div class="number count-to" data-from="0" data-to="<?= $jml_dosen;?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <!-- <i class="material-icons">help</i> -->
                        <i class="material-icons">people</i>
                    </div>
                    <div class="content">
                        <div class="text">MAHASISWA</div>
                        <div class="number count-to" data-from="0" data-to="<?= $jml_mhs;?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-teal hover-expand-effect">
                    <div class="icon">
                        <!-- <i class="material-icons">forum</i> -->
                        <i class="material-icons">view_list</i>
                    </div>
                    <div class="content">
                        <div class="text">MATA KULIAH</div>
                        <div class="number count-to" data-from="0" data-to="<?= $jml_list;?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">ADMIN</div>
                        <div class="number count-to" data-from="0" data-to="<?= $jml_admin;?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
    
        <?php if($this->session->flashdata('user')):?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Data admin <strong>berhasil</strong> <?= $this->session->flashdata('user');?>
            </div>
        <?php endif;?>
        <?php if(validation_errors()):?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors();?>
            </div>
        <?php endif;?>
        <!-- Custom Content -->
        <div class="card">
            <div class="header">
                <h2>
                    Data Administrator
                    <!-- <small>With a bit of extra markup, it's possible to add any kind of HTML content like headings, paragraphs, or buttons into thumbnails.</small> -->
                </h2>
            </div>
                
            <div class="body">
                <div class="row">                
                    <div class="col-sm-12 col-md-4">
                        <div class="thumbnail">
                            <img src="<?= base_url();?>assets/images/<?= $this->session->userdata('foto');?>" style="width: 200px; height: 200px;">
                            <div class="caption">
                                <p>
                                    <center>
                                        <b>Administrator</b>
                                        <!-- <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#myFormD"><i class="material-icons">mode_edit</i></button> -->
                                        <!-- <a href="<?= base_url();?>dosen/hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" type="submit" class="btn btn-danger waves-effect"><i class="material-icons">delete</i></a> -->
                                    </center>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">DATA</a></li>
                            <li role="presentation"><a href="#profile_animation_2" data-toggle="tab">UBAH PASSWORD</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane animated fadeInRight active" id="home_animation_2">
                                    <div class="body table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th colspan="2">USERDATA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Username</td>
                                                    <td> : <?= $this->session->userdata('username');?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Password</td>
                                                    <td> : <?= $this->session->userdata('password');?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane animated fadeInRight" id="profile_animation_2">
                                <div class="body">
                                    <form id="form_advanced_validation" method="post" action="" enctype="multipart/form-data">
                                        <div class="form-group form-float">
                                            <div class="help-info"></div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="password" class="form-control" name="pass" placeholder="Masukkan Password Baru" required>
                                            </div>
                                            <div class="help-info"></div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="password" class="form-control" name="pass1" placeholder="Konfirmasi Password" required>
                                            </div>
                                            <div class="help-info">Pastikan value kedua form password sama!</div>
                                        </div>
                                        <button class="btn btn-primary waves-effect" type="submit">Ubah</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- #END# Custom Content -->
</section>
