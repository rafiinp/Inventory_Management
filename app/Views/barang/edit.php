<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Edit Barang</h2>
    
    <form action="<?= base_url('barang/edit/'.$barang['id']) ?>" method="post">
        <div class="form-group">
            <label for="nama">Nama Barang</label>
            <input type="text" name="nama" class="form-control" value="<?= $barang['nama'] ?>" required>
        </div>
        
        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="<?= $barang['jumlah'] ?>" required>
        </div>
        
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" class="form-control" value="<?= $barang['kategori'] ?>" required>
        </div>
        
        <div class="form-group">
            <label for="lokasi">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="<?= $barang['lokasi'] ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="<?= base_url('barang') ?>" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
<?= $this->endSection() ?>