<?php 
include "koneksi.php"; // Pastikan koneksi sudah terhubung

$id = intval($_GET['id']); // Sanitasi input untuk ID

$query = mysqli_query($koneksi, "SELECT penjualan.*, pelanggan.nama_pelanggan FROM penjualan LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan WHERE id_penjualan = $id");
$data = mysqli_fetch_array($query);
?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Detail Penjualan</li>
</ol>
<a href="?page=pembelian" class="btn btn-danger">+ Kembali</a>
<hr>
<form method="post">
    <table class="table table-bordered bg-success">
        <tr>
            <td width="200px">Nama Pelanggan</td>
            <td width="1">:</td>
            <td>
                <select class="form-control form-select" name="id_pelanggan" required>
                    <option value="">Pilih Pelanggan</option>
                    <option value="<?php echo($data['id_pelanggan']); ?>"><?php echo htmlspecialchars($data['nama_pelanggan']); ?></option>
                </select>
            </td>
        </tr>
        <?php 
        $pro = mysqli_query($koneksi, "SELECT * FROM detail_penjualan LEFT JOIN produk ON produk.id_produk = detail_penjualan.id_produk WHERE id_penjualan = $id");
        $total_harga = 0; // Inisialisasi total harga
        while ($produk = mysqli_fetch_array($pro)) {
            $total_harga += $produk['sub_total']; // Menghitung total harga
        ?>
        <tr>
            <td><?php echo ($produk['nama_produk']); ?></td>
            <td>:</td>
            <td>
                Harga : <?php echo($produk['harga']); ?><br>
                Jumlah : <?php echo ($produk['jumlah_produk']); ?><br>
                Sub Total : <?php echo ($produk['sub_total']); ?><br>
            </td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td>Total Harga</td>
            <td>:</td>
            <td id="total-harga"><?php echo number_format($total_harga, 2); ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </td>
        </tr>
    </table>
</form>

<script>
function hitungTotal() {
    const totalElement = document.getElementById('total-harga');
    let total = 0;
    const inputs = document.querySelectorAll('input[type="number"]');

    inputs.forEach(input => {
        const jumlah = parseInt(input.value) || 0;
        const harga = parseFloat(input.dataset.harga) || 0;
        total += jumlah * harga;
    });

    totalElement.innerText = total.toFixed(2);
}
</script>

<?php
// Membersihkan sesi untuk total harga
if (isset($_SESSION['total_harga'])) {
    unset($_SESSION['total_harga']);
}
?>
.