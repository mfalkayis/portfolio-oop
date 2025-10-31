<?php
// ... (PHP di atas sudah benar)
include_once 'config/Database.php';
include_once 'core/Experience.php'; 
// ... (Inisialisasi $experience sudah benar)
$database = new Database();
$db = $database->connect();
$experience = new Experience($db); 
$result_experiences = $experience->read(); 
$num_experiences = $result_experiences->rowCount();
?>
<!DOCTYPE html>
<body>
    <div class="manage-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Kegiatan/Posisi</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($num_experiences > 0): ?>
                    <?php while($row = $result_experiences->fetch(PDO::FETCH_ASSOC)): ?>
                    <?php extract($row); // REVISI: Ini membuat $judul, $deskripsi, $gambar, dll. ?>
                    <tr>
                        <td>
                            <img src="public/images/<?php echo $gambar; ?>" alt="<?php echo $judul; ?>" width="100">
                        </td>
                        <td><?php echo $judul; ?></td>
                        <td><?php echo $deskripsi; ?></td>
                        <td><?php echo $tanggal; ?></td>
                        <td class="cell-actions">
                            <a href="exp_edit_form.php?id=<?php echo $id; ?>" class="btn-action btn-edit">Edit</a>
                            <a href="exp_delete.php?id=<?php echo $id; ?>" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">Belum ada pengalaman.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>