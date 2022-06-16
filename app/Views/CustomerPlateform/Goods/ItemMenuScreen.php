<?= $this->extend("layouts/coverRapper") ?>
<?= $this->section("title") ?> Items Menu <?= $this->endSection() ?>
<?= $this->section("content") ?>
<link rel="stylesheet" href="<?= base_url('assets/css/goods-style.css') ?>">
<script src="<?= base_url('assets/js/good-script.js') ?>"></script>
<?php foreach ($corparation as $corpKey => $corpValue) { ?>
    <div class='company-details m-5 px-5'>
        <div class='company-logo col-sm-12 col-md-4'>
            <a href="<?= base_url('company/'.$corpValue['PK']['CorparationID']) ?>">
                <img src="<?= base_url('assets/images/corp_logo_storage/'.$corpValue['SK']['Logo']) ?>" alt="">
            </a>
        </div>
        <div class='company-title col-sm-12 col-md-8 p-5'>
            <h1><?= $corpValue['SK']['Name']; ?></h1>
            <p><?= $corpValue['SK']['Summary']; ?></p>
        </div>
        <?php foreach ($corpValue['SK']['Brands'] as $brandKey => $brandValue) {  ?>
            <div class='brand-details row my-3 p-3'>
                <div class='brand-info col-sm-12 col-md-4'>
                    <h2><?= $brandValue['SK']['Name']; ?><span>- <?= $brandValue['SK']['Relationship']; ?></span></h2>
                    <p><?= $brandValue['SK']['Description']; ?></p>
                </div>
                <div class='equipment-list col-sm-12 col-md-8 sliding-flex-box-slider'>
                    <?php foreach ($brandValue['SK']['Equipments'] as $equipKey => $equipValue) {  ?>
                        <a href="<?= base_url('equipment/'.$equipValue['PK']['EquipmentID']) ?>">
                            <div class='equipment-info card carousel slide' data-bs-ride='carousel'>
                                <div class='carousel-inner'>
                                    <?php foreach ($equipValue['SK']['Items'] as $itemKey => $itemValue) {  ?>
                                        <div class="carousel-item <?php if($itemKey == 0){ echo 'active';} ?>">
                                            <?php if (!isset($itemValue['SK']['Images'][0])) { ?>
                                                <img class="card-img-top" src="<?= base_url('assets/images/item_image_storage/default.jpg') ?>" alt="Card image">
                                            <?php }else{ ?>
                                                <img class="card-img-top d-block" src="<?= base_url('assets/images/item_image_storage/'.$itemValue['SK']['Images'][0]['SK']['ImagePath']) ?>" alt="Card image">
                                            <?php } ?>
                                            <div class="card-info card-img-overlay carousel-caption">
                                                <h4 class="card-title"><?= $itemValue['SK']['Name']; ?></h4>
                                                <?php if(isset($itemValue['SK']['Sale'][0])){ ?>
                                                    <p class="card-text">Buying Cost: <?= number_format($itemValue['SK']['Sale'][0]['SK']['SalesPrice'],2,'.',',').'/Piece'; ?></p>
                                                <?php } ?>
                                                <?php if(isset($itemValue['SK']['Rental'][0])){ ?>
                                                <p class="card-text">Rental Cost: <?= number_format($itemValue['SK']['Rental'][0]['SK']['Amount'],2,'.',',').'/'.$itemValue['SK']['Rental'][0]['SK']['Preiod']; ?></p>
                                                <?php } ?>
                                                <p class="card-text">Rating: <?= $equipValue['SK']['Rate']; ?></p>            
                                                <?php if(isset($equipValue['SK']['Offer'][0])){ ?>
                                                    <span class='offer-banner'>Offers Available</span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>
<?= $this->endSection() ?>
