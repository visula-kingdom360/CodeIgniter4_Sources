<?= $this->extend("layouts/coverRapper") ?>
<?= $this->section("title") ?> User Screen <?= $this->endSection() ?>
<?= $this->section("access-privilege") ?><li><a href="">User Logged in Information</a></li><?= $this->endSection() ?>
<?= $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/supplier-menu.css') ?>">
<div class='user-access container m-5'>
    <div class='row d-flex justify-content-center'>
        <div class='brand-segment card-section col-sm-12 col-md-3'>
            <a href="<?= base_url('brand-manager') ?>">
                <img src="<?= base_url('assets/images/icons-used/Brand-Manager.jpg') ?>" alt="Brand Manager">
            </a>
        </div>
        <div class='equipment-segment card-section col-sm-12 col-md-3'>
            <a href="<?= base_url('product-store') ?>">
                <img src="<?= base_url('assets/images/icons-used/product-store.jpg') ?>" alt="Products Store">                
            </a>
        </div>
        <div class='/r-segment card-section col-sm-12 col-md-3'>
            <a href="<?= base_url('offer-manager') ?>">            
                <img src="<?= base_url('assets/images/icons-used/Speical-Offers.jpg') ?>" alt="Offer Manager">
            </a>
        </div>
        <div class='service-segment card-section col-sm-12 col-md-3'>
            <a href="<?= base_url('service-plateform') ?>">
                <img src="<?= base_url('assets/images/icons-used/Service_Plateform.png') ?>" alt="Service Plateform">
            </a>
        </div>
        <div class='job-segment card-section col-sm-12 col-md-3'>
            <a href="<?= base_url('job-hub') ?>">
                <img src="<?= base_url('assets/images/icons-used/Job_Hubpng.png') ?>" alt="Job Hub">
            </a>
        </div>
        <div class='approval-segment card-section col-sm-12 col-md-3'>
            <a href="<?= base_url('approval-hub') ?>">
                <img src="<?= base_url('assets/images/icons-used/Approval_Hub.jpg') ?>" alt="Approval Hub">
            </a>
        </div>
        <div class='report-segment card-section col-sm-12 col-md-3'>
            <a href="<?= base_url('reports-center') ?>">
                <img src="<?= base_url('assets/images/icons-used/Reports.jpg') ?>" alt="Reports Center">
            </a>
        </div>
        
    </div>
</div>
<?= $this->endSection() ?>
