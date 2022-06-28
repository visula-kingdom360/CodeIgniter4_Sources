<?= $this->extend("layouts/coverRapper") ?>
<?= $this->section("title") ?> Brand Detail <?= $this->endSection() ?>
<?= $this->section("access-privilege") ?><li><a href="">User Logged in Information</a></li><?= $this->endSection() ?>
<?= $this->section("content") ?>
<script src="<?= base_url('assets/js/brand-map.js') ?>"></script>
<div class='supplier-plateform/brands/access/brand-details container m-5'>
    <div class='row d-flex justify-content-center'>
        <h1>Brands wise Information</h1>
        <form action="<?= base_url('supplier-plateform/brands/access/add-mapped-brand') ?>" method="post">
            <div class="mb-3 mt-3">
                <label for="brand" class="form-label">Brand Selection:</label>
                <select class="form-select" aria-label="Default select example" name="brandid" id="brandid">
                    <?php foreach ($brand_list as $row => $feild) { ?>
                        <option value="<?= $feild['BrandID'] ?>"><?= $feild['Name'] ?></option>
                    <?php } ?>
                </select>                
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Summary:</label>
                <textarea class="form-control" id="summary" rows="5" name="summary" readonly></textarea>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" rows="10" name="description" readonly></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Map selected Brand</button>
            <a href="<?= base_url('supplier-plateform/brands/access/brand-details') ?>" class="btn btn-dark">Return Back to the Previous Screen</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>