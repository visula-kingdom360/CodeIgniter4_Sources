<?= $this->extend("layouts/coverRapper") ?>
<?= $this->section("title") ?> Brand Management <?= $this->endSection() ?>
<?= $this->section("access-privilege") ?><li><a href="">User Logged in Information</a></li><?= $this->endSection() ?>
<?= $this->section("content") ?>
<div class='brand-manager container m-5'>
    <div class='row d-flex justify-content-center'>
        <?php
            if($status != '')
            {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong class="me-auto">Error Status: </strong>
                <p><?= $status ?></p>
            </div>
        <?php
            }
        ?>
        <h1>Adding My Brands</h1>
        <form action="<?= base_url($url) ?>" method="post">
            <?php if($brandid != ''){ ?>
            <div class="mb-3 mt-3">
                <label for="brand" class="form-label">Brand ID:</label>
                <input type="text" class="form-control" id="brandid" name="brandid" value='<?= $brandid ?>' placeholder="Enter Brand Name" readonly>
            </div>
            <?php }?>
            
            <div class="mb-3 mt-3">
                <label for="brand" class="form-label">Brand Name:</label>
                <input type="text" class="form-control" id="brand" name="brand" value='<?= $brand ?>' placeholder="Enter Brand Name" required>
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Summary:</label>
                <textarea class="form-control" id="summary" name="summary" rows="5" placeholder="Enter Brand Summary here" required><?= $summary ?></textarea>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" rows="10" name="description" placeholder="Enter Brand Description here"><?= $description ?></textarea>
            </div>
            <div class="form-check mb-3">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="sellertoo" <?= $sellertoo ?>> Also a Seller
                </label>
            </div>
            <button type="submit" class="btn btn-primary"><?= $button ?></button>
            <button type="Reset" class="btn btn-danger">Reset</button>
            <a href="<?= base_url('company-brands') ?>" class="btn btn-dark">Return Back to the Previous Screen</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>