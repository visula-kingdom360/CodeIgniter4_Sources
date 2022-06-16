<?= $this->extend("layouts/coverRapper") ?>
<?= $this->section("title") ?> Brand Detail <?= $this->endSection() ?>
<?= $this->section("access-privilege") ?><li><a href="">User Logged in Information</a></li><?= $this->endSection() ?>
<?= $this->section("content") ?>
<div class='brand-manager container m-5'>
    <div class='row d-flex justify-content-center'>
        <h1>Brands wise Information</h1>
        <form action="<?= base_url('') ?>" method="post">
            <div class="mb-3 mt-3">
                <label for="brand" class="form-label">Brand Name:</label>
                <input type="text" class="form-control" id="brand" name="brand" value='<?= $brand_details['Brand'] ?>' placeholder="Enter Brand Name" required disabled>
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Summary:</label>
                <textarea class="form-control" id="summary" name="summary" rows="5" placeholder="Enter Brand Summary here" required disabled><?= $brand_details['Summary'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" rows="10" name="description" placeholder="Enter Brand Description here" disabled><?= $brand_details['Description'] ?></textarea>
            </div>            
            <div class="container">
                <div class=" d-flex">
                    <div class="col-sm-12 col-md-4">
                        <table class='table table-bordered table-hover'>
                            <thead class='table-dark'>
                                <tr>
                                    <th style='text-align: center' colspan='3'>Request Detail's</th>
                                </tr>
                                <tr>
                                    <th>Brand ID</th>
                                    <th>Company Name</th>
                                    <th>Equipment Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($brand_details['Request-Details'] as $key => $value){ ?>
                                    <tr>
                                        <td><?= str_pad($value['Brand_AccessID'],11,'0',STR_PAD_LEFT) ?></td>
                                        <td><?= $value['CompanyName'] ?></td>
                                        <td style='text-align: right'><?= $value['EquipmentCount'] ?></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <table class='table table-bordered table-hover'>
                            <thead class='table-dark'>
                                <tr>
                                    <th style='text-align: center' colspan='3'>Rejected Detail's</th>
                                </tr>
                                <tr>
                                    <th>Brand ID</th>
                                    <th>Company Name</th>
                                    <th>Equipment Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($brand_details['Rejected-Details'] as $key => $value){ ?>
                                    <tr>
                                        <td><?= str_pad($value['Brand_AccessID'],11,'0',STR_PAD_LEFT) ?></td>
                                        <td><?= $value['CompanyName'] ?></td>
                                        <td style='text-align: right'><?= $value['EquipmentCount'] ?></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <table class='table table-bordered table-hover'>
                            <thead class='table-dark'>
                                <tr>
                                    <th style='text-align: center' colspan='3'>Validate Detail's</th>
                                </tr>
                                <tr>
                                    <th>Brand ID</th>
                                    <th>Company Name</th>
                                    <th>Equipment Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($brand_details['Accepted-Details'] as $key => $value){ ?>
                                    <tr class='table-bordered'>
                                        <td><?= str_pad($value['Brand_AccessID'],11,'0',STR_PAD_LEFT) ?></td>
                                        <td><?= $value['CompanyName'] ?></td>
                                        <td style='text-align: right'><?= $value['EquipmentCount'] ?></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <!-- <button type="submit" class="btn btn-primary">Modify</button>
            <button type="Reset" class="btn btn-danger">Reset</button> -->
            <a href="<?= base_url('modify-brand/'.$brand_details['BrandID']) ?>" class="btn btn-success">Modify Brand</a>
            <a href="<?= base_url('company-brands') ?>" class="btn btn-dark">Return Back to the Previous Screen</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>