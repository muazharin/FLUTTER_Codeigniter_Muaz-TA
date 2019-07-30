<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DOSEN</h2>
            </div>
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

                    <div class="body">
                        <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#myFormD"><i class="material-icons">add</i></button>
                        <button type="button" class="btn btn-primary waves-effect"><i class="material-icons">picture_as_pdf</i></button>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6 col-md-2">
                                <div class="thumbnail">
                                    <img src="http://placehold.it/300x350">
                                    <div class="caption">
                                        <h3>Thumbnail label</h3>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                            text ever since the 1500s
                                        </p>
                                        <p>
                                            <a href="javascript:void(0);" class="btn btn-primary waves-effect" role="button">BUTTON</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
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
                                    <input type="text" class="form-control" name="nip" placeholder="Masukkan NIP">
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