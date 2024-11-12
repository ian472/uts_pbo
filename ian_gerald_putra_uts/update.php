<!DOCTYPE html>
<html>
<head>
    <title>UPDATE Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Cek apakah ada nilai yang dikirim menggunakan method GET dengan nama id_barang
    if (isset($_GET['id_barang'])) {
        $id_barang = input($_GET["id_barang"]);

        $sql = "select * from tb_barang where id_barang=$id_barang";
        $hasil = mysqli_query($kon, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_barang = htmlspecialchars($_POST["id_barang"]);
        $nama_barang = input($_POST["nama_barang"]);
        $stok = input($_POST["stok"]);
        $harga_beli = input($_POST["harga_beli"]);
        $harga_jual = input($_POST["harga_jual"]);

        //Query update data pada tabel sevastok
        $sql = "update tb_barang set
            nama_barang='$nama_barang',
            stok='$stok',
            harga_beli='$harga_beli',
            harga_jual='$harga_jual'
            where id_barang=$id_barang";

        //Mengeksekusi atau menjalankan query di atas
        $hasil = mysqli_query($kon, $sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:index.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Update Data</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Nama Barang:</label>
            <input type="text" name="nama_barang" class="form-control" placeholder="Masukan Nama Barang" required value="<?php echo $data['nama_barang']; ?>" />
        </div>
        <div class="form-group">
            <label>Stok:</label>
            <input type="int" name="stok" class="form-control" placeholder="Masukan Jumlah Stok" required value="<?php echo $data['stok']; ?>" />
        </div>
        <div class="form-group">
            <label>Harga Beli:</label>
            <input type="int" name="harga_beli" class="form-control" placeholder="Masukan Harga Beli" required value="<?php echo $data['harga_beli']; ?>" />
        </div>
        <div class="form-group">
            <label>Harga Jual:</label>
            <input type="int" name="harga_jual" class="form-control" placeholder="Masukan Harga Jual" required value="<?php echo $data['harga_jual']; ?>" />
        </div>

        <input type="hidden" name="id_barang" value="<?php echo $data['id_barang']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>