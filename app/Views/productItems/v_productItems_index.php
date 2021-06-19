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
                    <!-- Alert saved -->
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card">

                        <div class="card-header">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title"><a class="btn btn-success" href="<?= base_url('items/add') ?>">Add Items Product</a></h3>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="" method="post">
                                            <div class="input-group">
                                                <input type="text" name="keyword" class="form-control" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="submit" name="submit">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-striped table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Product Code</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Qty Minimum</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Puchase Price</th>
                                        <th scope="col">Last Purchase Price</th>
                                        <th scope="col">Selling Price</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!$items) : ?>
                                        <tr>

                                            <td colspan="11">No data display</td>


                                        </tr>
                                    <?php else : ?>
                                        <?php $no = 1 + (10 * ($currentPage - 1));
                                        foreach ($items as $row) : ?>
                                            <tr>
                                                <th scope="row"><?= $no++; ?></th>
                                                <td><?= $row['product_code']; ?></td>
                                                <td><?= $row['product_name']; ?></td>
                                                <td><?= $row['quantity']; ?></td>
                                                <td><?= $row['minimum_quantity']; ?></td>
                                                <td><?= $row['unit']; ?></td>
                                                <td><?= $row['purchase_price']; ?></td>
                                                <td><?= $row['last_purchase_price']; ?></td>
                                                <td><?= $row['selling_price']; ?></td>
                                                <td><?= $row['category']; ?></td>
                                                <td><a class="btn btn-primary" href="<?= base_url('items/edit/' . $row['id']) ?>">Edit</a>
                                                    <a class="btn btn-danger" href="<?= base_url('items/delete/' . $row['id']) ?> " onclick="return confirm('Are you sure ?')">Delete</a>
                                                </td>
                                            </tr>


                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?= $pager->links('items', 'pagination') ?>
                </div>
            </div>
        </div>

    </section>
</div>


<?= $this->endSection(); ?>