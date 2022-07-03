<?= $this->extend("layouts/coverRapper") ?>
<?= $this->section("title") ?> Equipment Management <?= $this->endSection() ?>
<?= $this->section("access-privilege") ?><li><a href="">User Logged in Information</a></li><?= $this->endSection() ?>
<?= $this->section("content") ?>
<div class='container m-5'>
    <div class='row d-flex justify-content-center'>
        <?php
            if(session()->getFlashdata('status'))
            {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong class="me-auto">Error Status: </strong>
                <p><?= session()->getFlashdata('status') ?></p>
            </div>
        <?php
            }
        ?>
        
        <?php
            if(session()->getFlashdata('success'))
            {
        ?>
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong class="me-auto">Successful Status: </strong>
                <p><?= session()->getFlashdata('success') ?></p>
            </div>
        <?php
            }
        ?>
        
        <table class='table table-responsive'>
            <thead class='table-dark'>
                <tr>
                    <th colspan="4">
                        <h1>Current Equipment Details</h1>
                    </th>
                    <th colspan="3">
                        
                        <a href="<?= base_url('supplier-plateform/brands/owned/brand-details') ?>" class="btn btn-primary w-100 my-1">Owned Brands</a>
                        <a href="<?= base_url('supplier-plateform/brands/access/map-brand') ?>" class="btn btn-secondary w-100 my-1">Map New Brand</a>
                    </th>
                </tr>
                <tr>
                    <th>Name</th>
                    <th>Highlight</th>
                    <th>Brand</th>
                    <th>Rental/Sales</th>
                    <th>Rate</th>
                    <th>Genre</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($Equipment as $key => $value){ ?>
                <tr class='table-bordered'>
                    <td><?= $value['Name'] ?></td>
                    <td><?= $value['Highlight'] ?></td>
                    <td><?= $value['Brand'] ?></td>                    
                    <td><?= $value['Rental_Sales'] ?></td>                    
                    <td><?= $value['Rate'] ?></td>
                    <td><?= $value['Genre'] ?></td>
                    <td style='text-align: right'><?= $value['Count'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>        
    </div>
</div>
<?= $this->endSection() ?>