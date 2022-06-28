<?= $this->extend("layouts/coverRapper") ?>
<?= $this->section("title") ?> User Screen <?= $this->endSection() ?>
<?= $this->section("access-privilege") ?><li><a href="">User Logged in Information</a></li><?= $this->endSection() ?>
<?= $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/supplier-menu.css') ?>">
<div class='user-access container m-5'>
    <div class='row d-flex justify-content-center'>
        <div class='brand-segment card-section col-sm-12 col-md-3'>
            <a href="<?= base_url('supplier-plateform/brands/access/brand-details') ?>">
                <img src="<?= base_url('assets/images/icons-used/brand-manager.jpg') ?>" alt="Brand Manager">
            </a>
        </div>
        <div class='equipment-segment card-section col-sm-12 col-md-3'>
            <a href="<?= base_url('supplier-plateform/product-store') ?>">
                <img src="<?= base_url('assets/images/icons-used/product-store.jpg') ?>" alt="Products Store">                
            </a>
        </div>
        <div class='/r-segment card-section col-sm-12 col-md-3'>
            <a href="<?= base_url('supplier-plateform/offer-manager') ?>">            
                <img src="<?= base_url('assets/images/icons-used/Speical-Offers.jpg') ?>" alt="Offer Manager">
            </a>
        </div>
        <div class='service-segment card-section col-sm-12 col-md-3'>
            <a href="<?= base_url('supplier-plateform/service-plateform') ?>">
                <img src="<?= base_url('assets/images/icons-used/Service_Plateform.png') ?>" alt="Service Plateform">
            </a>
        </div>
        <div class='job-segment card-section col-sm-12 col-md-3'>
            <a href="<?= base_url('supplier-plateform/job-hub') ?>">
                <img src="<?= base_url('assets/images/icons-used/Job_Hubpng.png') ?>" alt="Job Hub">
            </a>
        </div>
        <div class='approval-segment card-section col-sm-12 col-md-3'>
            <a href="<?= base_url('supplier-plateform/approval-hub') ?>">
                <img src="<?= base_url('assets/images/icons-used/Approval_Hub.jpg') ?>" alt="Approval Hub">
            </a>
        </div>
        <div class='report-segment card-section col-sm-12 col-md-3'>
            <a href="<?= base_url('supplier-plateform/reports-center') ?>">
                <img src="<?= base_url('assets/images/icons-used/Reports.jpg') ?>" alt="Reports Center">
            </a>
        </div>
        
    </div>
</div>
<?= $this->endSection() ?>
