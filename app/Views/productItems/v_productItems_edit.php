<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $h1; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            <?= $breadcrumb; ?>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Customers</h3>
                        </div>
                        <div class="col-sm-8 mt-3">
                            <form action="<?= base_url('items/edit/' . $edit['id']) ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username');
                                                                                    ?>" readonly>
                                <input type="hidden" name="id" value="<?php echo
                                                                        $edit['id'];
                                                                        ?>" readonly>


                                <div class="form-group row">
                                    <label for="product_code" class="col-sm-3 col-form-label">Product Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="product_code" class="form-control <?= ($validation->hasError('product_code')) ? 'is-invalid' : ''; ?>" id="product_code" placeholder="Product code" value="<?= ($validation->hasError('product_code')) ? old('product_code') : $edit['product_code']; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('product_code'); ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-3 col-form-label">Product Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="product_name" class="form-control <?= ($validation->hasError('product_name')) ? 'is-invalid' : ''; ?>" id="product_name" placeholder="Product name" value="<?= ($validation->hasError('product_name')) ? old('product_name') : $edit['product_name']; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('product_name'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="quantity" class="col-sm-3 col-form-label">Quantity</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="quantity" class="form-control <?= ($validation->hasError('quantity')) ? 'is-invalid' : ''; ?>" id="quantity" placeholder="Quantity" value="<?= ($validation->hasError('quantity')) ? old('quantity') : $edit['quantity']; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('quantity'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="minimum_quantity" class="col-sm-3 col-form-label">Minimum Quantity</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="minimum_quantity" class="form-control <?= ($validation->hasError('minimum_quantity')) ? 'is-invalid' : ''; ?>" id="minimum_quantity" placeholder="Minimum Quantity" value="<?= ($validation->hasError('minimum_quantity')) ? old('minimum_quantity') : $edit['minimum_quantity']; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('minimum_quantity'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="unit_id" class="col-sm-3 col-form-label">Unit</label>
                                    <div class="col-sm-9">
                                        <select name="unit_id" class="form-control <?= ($validation->hasError('unit_id')) ? 'is-invalid' : ''; ?>" id="unit_id" placeholder="Unit Product">
                                            <option value="">--Chose Unit Product--</option>
                                            <?php foreach ($units as $row) : ?>
                                                <option value="<?= $row['id']; ?>" <?= ($row['id'] == old('unit_id') || $row['id'] == $edit['unit_id']) ? 'selected' : ''; ?>><?= $row['unit']; ?></option>
                                            <?php endforeach; ?>
                                            <select>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('unit_id'); ?>
                                                </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="purchase_price" class="col-sm-3 col-form-label">Purchase Price</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="purchase_price" class="form-control <?= ($validation->hasError('purchase_price')) ? 'is-invalid' : ''; ?>" id="purchase_price" placeholder="Purchase Price" value="<?= ($validation->hasError('purchase_price')) ? old('purchase_price') : $edit['purchase_price']; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('purchase_price'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="last_purchase_price" class="col-sm-3 col-form-label">Last Purchase Price</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="last_purchase_price" class="form-control <?= ($validation->hasError('last_purchase_price')) ? 'is-invalid' : ''; ?>" id="last_purchase_price" placeholder="Last Purchase Price" value="<?= ($validation->hasError('last_purchase_price')) ? old('last_purchase_price') : $edit['last_purchase_price']; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('last_purchase_price'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="selling_price" class="col-sm-3 col-form-label">Selling Price</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="selling_price" class="form-control <?= ($validation->hasError('selling_price')) ? 'is-invalid' : ''; ?>" id="selling_price" placeholder="Selling Price" value="<?= ($validation->hasError('selling_price')) ? old('selling_price') : $edit['selling_price']; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('selling_price'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-3 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select name="category_id" class="form-control <?= ($validation->hasError('category_id')) ? 'is-invalid' : ''; ?>" id="category_id" placeholder="Category Product">
                                            <option value="">--Chose category--</option>
                                            <?php foreach ($category as $row) : ?>
                                                <option value="<?= $row['id']; ?>" <?= ($row['id'] == old('category_id') || $row['id'] == $edit['category_id']) ? 'selected' : ''; ?>><?= $row['category']; ?></option>
                                            <?php endforeach; ?>
                                            <select>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('category_id'); ?>
                                                </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">update</button>
                                        <a href="<?= base_url('/units'); ?>" class="btn btn-primary">Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>


<?= $this->endSection(); ?>