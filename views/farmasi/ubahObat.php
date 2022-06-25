<?php 
require_once '../partials/header.php';
require_once 'functions.php';
if(isset($_SESSION["level"]) == "user" && $_SESSION["level"] != "admin"){
    echo "anda tidak berhak akses halaman ini";
    exit;
  }

$id = $_GET['id'];

$stok = query("SELECT * FROM stok INNER JOIN obat ON stok.kode_obat = obat.kode_obat WHERE id= '$id' ORDER BY updated_at DESC")[0];

    if( isset($_POST['submit']) ){
        // ambil data form

        if( ubah($_POST) > 0 ){
            $_SESSION['eksekusi'] = "ubah";
            echo '
            <script>
            document.location.href = "stokObat.php";
            </script>
            ';
        
        }else{
        echo '
            <script type="text/javascript">
            swal("Gagal", "Data gagal diubah!", "failed");
            document.location.href = "obat.php";
            </script>
            ';
        } 
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <title>Ubah Obat</title>
</head>
<body>
    <div class="card col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto form p-4 mt-5">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            <h2>Form ubah Obat</h2>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan kode obat" name="id" value="<?= $stok['id'] ?>">
                </div>
                <div class="form-group">
                    <label for="nama_obat">Nama Obat</label>
                    <select name="nama_obat" id="nama_obat" class="form-control" disabled>
                        <option value="<?= $stok['kode_obat'] ?>"><?= $stok['nama_obat'] ?></option>
                        <?php 
                            $sql_obat = pg_query($conn, "SELECT * FROM obat ORDER BY nama_obat ASC") or die(pg_error($conn));
                            while($data_obat = pg_fetch_array($sql_obat)){
                                echo '<option value="'.$data_obat['kode_obat'].'">'.$data_obat['nama_obat'].'</option>';
                            }
                        ?>;
                        <!-- <input type="text"  id="nama_obat" placeholder="Masukkan nama obat" name="nama_obat"> -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="satuan">Satuan : </label>
                    <select name="satuan" id="satuan" class="form-control" >
                        <option value="<?= $stok['satuan'] ?>"><?= $stok['satuan'] ?></option>
                        <option value="ampul">ampul</option>
                        <option value="botol">botol</option>
                        <option value="kotak">kotak</option>
                        <option value="pcs">pcs</option>
                        <option value="pot">pot</option>
                        <option value="roll">roll</option>                
                        <option value="vial">vial</option>
                        <!-- <input type="text"  id="satuan" placeholder="Masukkan nama obat" name="satuan"> -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">jumlah : </label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan satuan" name="jumlah" value="<?= $stok['jumlah'] ?>">
                </div>
                <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Data sudah benar</label>
                </div> -->
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <button type="button" class="btn btn-secondary"><a href="stokObat.php">Kembali</a></button>
            </form>
        </div>
    </div>
    
</body>
</html>