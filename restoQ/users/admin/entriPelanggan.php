<?php 
if (!defined('ACCESS')) { die('System Cannot Running'); } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.css">
    <link href="assets/datepicker/css/datepicker.css" rel="stylesheet">
    <link type="text/css" href="css/bootstrap-timepicker.min.css" />
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <style>
            html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }
    </style>
    <title>Document</title>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-md navbar-light bg-white text-darksticky-top">
        <div class="container">
            <a class="navbar-brand" href="http://localhost:8080/restoQ/?page=Home">RestoQ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="?page=EntriPelanggan" class="dropdown-item active">Entri Pelanggan</a>
                            <a href="?page=EntriMeja" class="dropdown-item">Entri Meja</a>
                            <a href="?page=EntriBarang" class="dropdown-item">Entri Barang</a>
                            
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">Somethin else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link" tabindex="-1" aria-disabled="true">Logout</a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <section id="min" class="mt-3">
        <div class="container">
            <div class="row">
            <div class="col">
            <?php 
            if(isset($_SESSION['msg'])){?>
                <div class="alert alert-success" role="alert">
                    <?=$_SESSION['msg']?>
                </div>
                <?php
                unset($_SESSION['msg']);
            }?>
            </div>
            </div>
        </div>
    </section>
    <section id="nol" class="mt-3">
    <div class="container">
        <div class="row">
            
            <div class="col">
                <div class="card">
                    <div class="card-header bg-primary text-white">Tambah Pelanggan</div>
                    <div class="card-body">
                        <form method="POST" action="action.php">
                             <div class="form-group ">
                                <label for="inputPassword4">ID Pelanggan</label>
                                <?php 
                                    require "users/fungsi/generateKodePelanggan.php";
                                ?>
                                <input type="text" readonly required name="idpel" value="<?=$kode?>" class="form-control" id="inputPassword4"
                                    placeholder="Kode">
                            </div>
                            <div class="form-group ">
                                <label for="inputPassword4">Nama</label>
                                <input type="text" required name="nama" value="" class="form-control" id="inputPassword4"
                                    placeholder="Nama">
                            </div>
                            <div class="form-group">
                                                
                                                <label for="inputState">Jenis Kelamin</label>
                                                <select id="inputState" required name="jk" class="form-control">
                                                    <option></option>
                                                    <option value="0">Laki-Laki</option>
                                                    <option value="1">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group ">
                                <label for="inputPassword4">No HP</label>
                                <input type="text" required name="nohp" value="" class="form-control" id="inputPassword4"
                                    placeholder="Rp. ">
                            </div> 
                            <div class="form-group ">
                                <label for="inputPassword4">Alamat</label>
                                <textarea name="alamat" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <button type="submit" name="tambah_pelanggan" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="dua" class="mt-3">
<div class="container">
        <div class="row">
            <div class="col">

                <table class="display" id="table_id">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>J Kelamin</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php 
                    $crud = new crud();
                    $resultSet = new resultSet($crud->read("pelanggan"));
        
                    foreach ($resultSet->toArray() as $key => $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['idpelanggan']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td>
                                <?php  
                                    if($row['jeniskelamin'] == "0"){
                                        echo "Laki-Laki";
                                    }else{
                                        echo "Perempuan";
                                    }
                                
                                ?>
                            
                            </td>
                            <td><?php echo $row['nohp']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td>
                                <a class="btn btn-primary1"
                                    href="action.php?delete_pelanggan=<?=$row['idpelanggan']?>">Hapus</a>
                                <button type="button" class="btn btn-primary2" data-toggle="modal"
                                    data-target="#editModal<?php echo $row['idpelanggan'];?>">Edit</button>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="editModal<?php echo $row['idpelanggan'];?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pelanggan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="action.php">
                                        <div class="form-group">
                                            <label for="nomor">ID</label>
                                            <input readonly type="text" id="idpel" class="form-control" name="idpel"
                                                    value="<?php echo $row['idpelanggan'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nomor">Nama</label>
                                            <input type="text" id="nomor" class="form-control" name="nama"
                                                    value="<?php echo $row['nama'];?>">
                                        </div>
                                        <div class="form-group">
                                                
                                                <label for="inputState">Jenis Kelamin</label>
                                                <select id="inputState" required name="jk" class="form-control">
                                                    <option>Status</option>
                                                    <?php 
                                                    if($row['jeniskelamin'] == '0' ){
                                                        echo '<option selected="selected" value="0">Laki-Laki</option>';
                                                        echo '<option value="1">Perempuan</option>';
                                                    }else if($row['jeniskelamin'] == '1'){
                                                        echo '<option value="0">Laki-Laki</option>';
                                                        echo '<option selected="selected" value="1">Perempuan</option>';
                                                    }
                                                                                               
                                                    ?>
                                                
                                                </select>
                                            </div> 
                                        <div class="form-group">
                                            <label for="nomor">No HP</label>
                                            <input type="text" id="nomor" class="form-control" name="nohp"
                                                    value="<?php echo $row['nohp'];?>">
                                        </div>
                                        <div class="form-group ">
                                <label for="inputPassword4">Alamat</label>
                                <textarea name="alamat" id="" class="form-control"><?php echo $row['alamat'];?></textarea>
                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="updatePelanggan" class="btn btn-primary">Ubah</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<section>



<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="assets/DataTables/datatables.js"></script>
<script>
    $(document).ready(function () {
        $('#table_id').DataTable();
    });
</script>
</body>
</html>