<?= $this->extend("layouts/coverRapper") ?>
<?= $this->section("title") ?> Equipment Management <?= $this->endSection() ?>
<?= $this->section("access-privilege") ?><li><a href="">User Logged in Information</a></li><?= $this->endSection() ?>
<?= $this->section("content") ?>
<script src="<?= base_url('assets/js/equipment-details.js') ?>"></script>
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
                    <th colspan="7">
                        <h1>Current Equipment Details</h1>                        
                    </th>
                    <th colspan="2">
                        <a href="<?= base_url('') ?>" class="btn btn-primary w-100 my-1">Add New Equipments</a>
                    </th>
                </tr>
                <tr>
                    <th colspan="100">
                        <div class="input-group">
                            <input type="text" id="equip-search" name="search" class="w-75 form-control" placeholder="Search Equipment">
                            <button class="equip-search-button btn btn-success w-25">Search</button>
                        </div>
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
                    <th></th>
                    <th></th>
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
                    <td class="btn-group">
                        <a href="<?= base_url('') ?>" class="btn btn-primary w-25 my-1">View Items</a>
                        <a href="<?= base_url('') ?>" class="btn btn-success w-25 my-1">Modify Equipment</a>                        
                    </td>
                    <td>
                        <?php if ($value['Count'] == 0) { ?>
                            <a href="<?= base_url('') ?>" class="btn btn-danger my-1">Expire Equipment</a>
                        <?php }elseif($value['EquipmentID'] != ''){ ?>
                            <p class='text-secondary'>
                                <?= $active_item_true ?>
                            </p>
                        <?php }else{?>
                            <p>Issue with the Equipment ID</p>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>        
    </div>
</div>
<?= $this->endSection() ?>