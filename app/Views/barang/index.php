<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-boxes me-2"></i>Daftar Barang</h2>
        <div>
            <a href="<?= base_url('barang/create') ?>" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Barang
            </a>
            <a href="<?= base_url('barang/exportCsv') ?>" class="btn btn-success ms-2">
                <i class="fas fa-file-export me-2"></i>Export CSV
            </a>
        </div>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?= session()->getFlashdata('message') ?>',
        showConfirmButton: false,
        timer: 3000
    });
</script>
<?php endif; ?>



    <div class="card mb-4">
        <div class="card-body">
            <form action="<?= base_url('barang/search') ?>" method="get">
                <div class="row g-3">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tags"></i></span>
                            <input type="text" name="kategori" class="form-control" placeholder="Cari berdasarkan kategori">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" name="lokasi" class="form-control" placeholder="Cari berdasarkan lokasi">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i>Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($barang as $item): ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td>
                                <i class="fas fa-box me-2 text-primary"></i>
                                <?= $item['nama'] ?>
                            </td>
                            <td>
                                <span class="badge bg-info"><?= $item['jumlah'] ?></span>
                            </td>
                            <td>
                                <i class="fas fa-tag me-2 text-success"></i>
                                <?= $item['kategori'] ?>
                            </td>
                            <td>
                                <i class="fas fa-map-marker-alt me-2 text-danger"></i>
                                <?= $item['lokasi'] ?>
                            </td>
                            <td>
                                <a href="<?= base_url('barang/edit/'.$item['id']) ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('barang/delete/'.$item['id']) ?>" class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>