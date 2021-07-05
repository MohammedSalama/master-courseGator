<?php include("../global.php"); ?>

<?php include("$root/admin/inc/header.php"); ?>


<?php
    $cats = select($conn , "*" , "cats");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">All Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <?php include("$root/admin/inc/success.php"); ?>

                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($cats as $key => $cat) { ?>
                                    <tr>
                                        <td><?= $key + 1; ?></td>
                                        <td><?= $cat['name']; ?></td>
                                        <td><?= $cat['created_at']; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-info"
                                                href="edit-category.php?id=<?= $cat['id']; ?>">Edit</a>
                                            <a class="btn btn-sm btn-danger"
                                                href="delete-category.php?id=<?= $cat['id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include("$root/admin/inc/footer.php"); ?>