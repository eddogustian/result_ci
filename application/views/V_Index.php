<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD AJAX</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>

</head>
<body style="margin: 20px;">
    <div class="panel panel-primary">
        <div class="panel-heading"> 
            <b class="col-md-10">CRUD Ajax Codeigniter</b>
            <center><button data-toggle="modal" data-target="#addModal" class="btn btn-success">Tambah Data</button></center>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Induk</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Hobi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbl_data"> </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

    <!-- Modal Tambah-->
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Tambah Data</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="noinduk">No.Induk</label>
                            <input type="text" name="noinduk" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label for="hobi">Hobi</label>
                            <input type="text" name="hobi" class="form-control"></input>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn_add_data">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah END-->

     <!-- Modal Edit-->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Edit Data</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="noinduk">No.Induk</label>
                            <input type="text" name="noinduk_edit" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama_edit" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat_edit" class="form-control"></input>
                        </div>
                        <div class="form-group">
                            <label for="hobi">Hobi</label>
                            <input type="text" name="hobi_edit" class="form-control"></input>
                        </div>
        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn_update_data">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal Edit end-->
</html>
<script type="text/javascript">
    $(document).ready(function(){
        getData();
        //menampilkan data di tabel
        function getData(){
            $.ajax({
                url: '<?php echo base_url(); ?>C_Index/getData',
                type: 'POST',
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    var i;
                    var no = 0;
                    var html = "";
                    for(i=0; i < response.length; i++) {
                        no++;
                        html = html + '<tr>'
                                        + '<td>' + no + '</td>'
                                        + '<td>' + response[i].noinduk + '</td>'
                                        + '<td>' + response[i].nama + '</td>'
                                        + '<td>' + response[i].alamat + '</td>'
                                        + '<td>' + response[i].hobi + '</td>'
                                        + '<td style="width: 16.66%">' + '<span><button data-id="'+response[i].noinduk+'" class="btn btn-primary btn_edit">Edit</button><button style="margin-left: 5px;" data-id="'+response[i].noinduk+'" class="btn btn-danger btn_hapus">hapus</button></span>' + '</td>'
                                    + '</tr>';
                    }
                    $("#tbl_data").html(html);
                }
            });
        } //tutup getData

        //hapus data dengan konfirmasi
        $("#tbl_data").on('click','.btn_hapus', function() {
            // alert('masuk hapus');
            var noinduk = $(this).attr('data-id');
            var status = confirm('yakin ingin mengahapus?');
            if(status){
                $.ajax({
                    url: '<?php echo base_url(); ?>C_Index/deleteData',
                    type: 'POST',
                    data: {noinduk:noinduk},
                    success: function(response){
                        getData();
                    }
                })
            }
        }) //tutup delete data
        //menambahkan data ke database
        $("#btn_add_data").on('click', function() {
            var noinduk = $('input[name="noinduk"]').val();
            var nama = $('input[name="nama"]').val();
            var alamat = $('input[name="alamat"]').val();
            var hobi = $('input[name="hobi"]').val();
            $.ajax({
                url: '<?php echo base_url(); ?>C_Index/addData',
                type: 'POST',
                data: {noinduk:noinduk, nama:nama, alamat:alamat, hobi:hobi},
                success: function(response) {
                    $('input[name="noinduk"]').val("");
                    $('input[name="nama"]').val("");
                    $('input[name="alamat"]').val("");
                    $('input[name="hobi"]').val("");
                    $("addModal").modal('hide');
                    getData();
                }
            })

        }); //tutup tambah data

        // Memunculkan modal edit
        $("#tbl_data").on('click','.btn_edit', function(){
            // alert('masuk edit');
            var noinduk = $(this).attr('data-id');
            $.ajax({
                url: '<?php echo base_url(); ?>C_Index/getDataByNoinduk',
                type: 'POST',
                data: {noinduk:noinduk},
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    $("editModal").modal('show');
                    $('input[name="noinduk_edit"]').val(response[0].noinduk);
                    $('input[name="nama_edit"]').val(response[0].nama);
                    $('input[name="alamat_edit"]').val(response[0].alamat);
                    $('input[name="hobi_edit"]').val(response[0].hobi);
                }
            })
        }); //tutup muncul modal edit

        
    }); //tutup doc ready
</script>