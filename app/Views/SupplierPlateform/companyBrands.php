<?= $this->extend("layouts/coverRapper") ?>
<?= $this->section("title") ?> Company Brands <?= $this->endSection() ?>
<?= $this->section("access-privilege") ?><li><a href="">User Logged in Information</a></li><?= $this->endSection() ?>
<?= $this->section("content") ?>
<div class='brand-manager container m-5'>
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
                    <th colspan="3">
                        <h1>Current Access Brand Details</h1>
                    </th>
                    <th colspan="4">
                        <a href="<?= base_url('brand-manager') ?>" class="btn btn-secondary w-100 my-1">Back to Brand Access</a>
                        <a href="<?= base_url('add-new-brand') ?>" class="btn btn-primary w-100 my-1">Add My Brands</a>
                    </th>
                </tr>
                <tr>
                    <th>Brand ID</th>
                    <th>Brand</th>
                    <th>Summary</th>
                    <th colspan="3">Brand Access</th>
                    <th></th>
                </tr>
                <tr>
                    <th colspan="3"></th>
                    <th data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= $tool_tips['Request_Tooltip'] ?>">Req</th>
                    <th data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= $tool_tips['Rejected_Tooltip'] ?>">Rej</th>
                    <th data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= $tool_tips['Accepted_Tooltip'] ?>">Apt</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($owned_brands as $key => $value){ ?>
                <tr class='table-bordered'>
                    <td><?= str_pad($value['BrandID'],11,'0',STR_PAD_LEFT) ?></td>
                    <td><?= $value['Brand'] ?></td>
                    <td><?= $value['Summary'] ?></td>
                    <td data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= $tool_tips['Request_Tooltip'] ?>"><?= $value['Request_Count'] ?></td>
                    <td data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= $tool_tips['Rejected_Tooltip'] ?>"><?= $value['Rejected_Count'] ?></td>
                    <td data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= $tool_tips['Accepted_Tooltip'] ?>"><?= $value['Accepted_Count'] ?></td>
                    <td>
                        <a href="<?= base_url('more-abt-brand/'.$value['BrandID']) ?>" class="btn btn-success w-100 m-1">More Details</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>        
    </div>
</div>
<?= $this->endSection() ?>