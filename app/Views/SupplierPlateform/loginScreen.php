<?= $this->extend("layouts/coverRapper") ?>
<?= $this->section("title") ?> Login Screen <?= $this->endSection() ?>
<?= $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
<div class='user-access container m-5'>
    <div class='row'>
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
        <div class='about-us col-md-6 px-5'>
            <h1>Kingdom 360</h1>
            <h5>
            <span>
                <span>NOT JUST ANOTHER</span>
                </span><br>
                <span>
                <span>DIGITAL AGENCY</span>
            </span>
        </h5>
            <p>
                We are a team of friends who worked in the corporate sector and we thought of making an impact in the corporate world. "How can we do this?" was the first question we had. And as the answers came out one by one there were many more questions that popped up in our heads. Finally all of us agreed that we will go for Marketing. Every individual, every business, every community and every family wants to look good, feel good, be good and do good, and that is exactly what we are here to do.
            </p>
        </div>
        <div class='login-segment col-md-6 px-5'>
            <form action="<?= base_url('login-request') ?>" method='POST'>
                <h1>User Login</h1>
                <div class="mb-3 mt-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter username or email" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                </div>
                <div class="form-check mb-3">
                    <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
