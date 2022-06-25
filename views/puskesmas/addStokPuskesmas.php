<?php 
require_once 'functionsPuskesmas.php';
require_once '../partials/header.php';

if( isset($_POST['submit']) ){
    // ambil data form
    $kode_obat = $_GET["kode_obat"];
    $jumlah = $_POST["jumlah"];
    $stok = query("SELECT * FROM stok WHERE kode_obat = '$kode_obat'")[0];
    if(!$stok){
        echo "An error occurred.\n";
        exit;
    }
    $sisa = $stok['jumlah'] - $jumlah;
    echo $sisa;
     if( kirim($_POST) > 0 ){
        // echo "<script type='text/javascript'>
        // setTimeout(function () { 
        //     swal({
        //         title: 'Good job!',
        //         text: 'You clicked the button!',
        //         icon: 'success',
        //       });   
        // },100);  
        // window.setTimeout(function(){ 
        //   document.location.replace('obat.php');
        // } ,1000); 
        // </script>";
        echo "
        <script>
        alert('berhasil');

        </script>
     ";
     }else{
        echo "
            <script>
            alert('gagal');
            document.location.href = '../farmasi/stokObat.php';
            </script>
         ";
     }
    
    
}

?>
    <div class="card col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto form p-4 mt-5">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            <h2>Form tambah Obat</h2>
        </div>
        <?php if( isset($error)) : ?>
            <p style="color:red; font-style:italic;">Username / password salah</p>
          <?php endif; ?>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama_obat">Nama Obat</label>
                    <select name="nama_obat" id="nama_obat" class="form-control" required>
                        <option value="">pilih</option>
                        <?php 
                            $sql_obat = pg_query($conn, "SELECT * FROM stok INNER JOIN obat ON stok.kode_obat = obat.kode_obat") or die(pg_error($conn));
                            while($data_obat = pg_fetch_array($sql_obat)){
                                echo '<option value="'.$data_obat['id'].'">'.$data_obat['nama_obat'].'</option>';
                            }
                        ?>'</option>';
                            
                        ?>
                        <!-- <input type="text"  id="nama_obat" placeholder="Masukkan nama obat" name="nama_obat"> -->
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <select name="satuan" id="satuan" class="form-control" required>
                        <option value="">- Pilih -</option>
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
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan satuan" name="jumlah">
                </div>
            
                <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Data sudah benar</label>
                </div> -->
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <button type="button" class="btn btn-secondary"><a href="stokObat.php
                ">Kembali</a></button>
            </form>
        </div>
    </div>


 <?php require_once '../partials/footer.php' ?> 