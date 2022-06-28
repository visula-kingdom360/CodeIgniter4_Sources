<?= $this->extend("layouts/coverRapper") ?>
<?= $this->section("title") ?> Brand Management <?= $this->endSection() ?>
<?= $this->section("access-privilege") ?><li><a href="">User Logged in Information</a></li><?= $this->endSection() ?>
<?= $this->section("content") ?>
<div class='supplier-plateform/brands/access/brand-details container m-5'>
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
                        <h1>Current Access Brand Details</h1>
                    </th>
                    <th colspan="3">
                        
                        <a href="<?= base_url('supplier-plateform/brands/owned/brand-details') ?>" class="btn btn-primary w-100 my-1">Owned Brands</a>
                        <a href="<?= base_url('supplier-plateform/brands/access/map-brand') ?>" class="btn btn-secondary w-100 my-1">Map New Brand</a>
                    </th>
                </tr>
                <tr>
                    <th>Brand ID</th>
                    <th>Brand</th>
                    <th>Summary</th>
                    <th>Relationship</th>
                    <th>Active Equipments</th>
                    <th>Expire</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($company_brands as $key => $value){ ?>
                <tr class='table-bordered'>
                    <td><?= str_pad($value['BrandID'],11,'0',STR_PAD_LEFT) ?></td>
                    <td><?= $value['Brand'] ?></td>
                    <td><?= $value['Summary'] ?></td>
                    <td><?= $value['Relationship'] ?></td>                    
                    <td style='text-align: right'><?= $value['EquipmentCount'] ?></td>
                    <td>
                        <?php if(($value['Brand_AccessID'] != '') && ($value['EquipmentCount']  == 0)){ ?>
                        <a href="<?= base_url('supplier-plateform/brands/access/expire-brand/'.$value['Brand_AccessID']) ?>" class="btn btn-danger w-100 m-1">Expire Brand</a>
                        <?php }elseif($value['Brand_AccessID'] != ''){?>
                            <p class='text-secondary'><?= $active_equipment_true ?> </p>
                        <?php }else{?>
                            <p>Issue with the Brand Access ID</p>
                        <?php }?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>        
    </div>
</div>
<?= $this->endSection() ?>