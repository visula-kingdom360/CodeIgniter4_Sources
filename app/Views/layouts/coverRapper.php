<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection("title") ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/header.css') ?>">
</head>
<body>
    <div class='header-layer .container-fluid'>
        <div class='title-bar row'>
            <div class='logo-section col-md-2'>
                <a href="<?= base_url('login') ?>">
                    <img class='logo-image' src="<?= base_url('assets/images/ooms-logo.jpg') ?>" class="center" alt="">
                </a>
            </div>
            <div class='title-section col-md-10'>
                <div class='corparate-name pt-4'>
                    <h1>Online Order Mart Wide World</h1>
                    <p class='px-4'>Go shopping from home, with freedom to check and buy anything with all offers and discounts right to your phone.</p>
                </div>
                <div class='developers-info p-2 mt-3'>
                    <marquee behavior="" direction="">The Development was done by Visula Rajakaruna for Kingdom 360</marquee>
                </div>
            </div>
        </div>
        <div class='menu-bar row'>
            <div class='col-md-7 p-3'></div>
            <div class='col-md-5 p-3'>
                <ul>
                    <li><a href="">Home Page</a></li>
                    <li><a href="">About Kingdom360</a></li>
                    <?= $this->renderSection("access-privilege") ?>
                </ul>
            </div>
        </div>
    </div>
    <div class='main-layer container-fluid'>
        <?= $this->renderSection("content") ?>
    </div>
    <div class='footer-layer .container-fluid'>
    </div>
</body>
</html>