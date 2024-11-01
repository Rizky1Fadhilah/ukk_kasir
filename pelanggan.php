<div class="container-fluid px-4 ">
    <h1 class="mt-4">Pelanggan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pelanggan</li>
    </ol>
    <a href="?page=pelanggan_tambah" class="btn btn-primary">+ Tambah data</a>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="bg-dark text-light">Nama Pelanggan</th>
                <th class="bg-dark text-light">Alamat</th>
                <th class="bg-dark text-light">No Telepon</th>
                <th class="bg-dark text-light">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                while ($data = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($data['nama_pelanggan']); ?></td>
                    <td><?php echo htmlspecialchars($data['alamat']); ?></td>
                    <td><?php echo htmlspecialchars($data['no_telepon']); ?></td>
                    <td>
                        <a href="?page=pelanggan_ubah&id=<?php echo $data['id_pelanggan'];  ?>" class="btn btn-success">Edit</a>
                        <a href="?page=pelanggan_hapus&id=<?php echo $data['id_pelanggan']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>
