<?php include("../global.php"); ?>

<?php include("$root/admin/inc/header.php"); ?>


<?php
    $sql = "SELECT courses.*, cats.id AS catId , cats.name AS catName FROM courses JOIN cats
    ON courses.cat_id = cats.id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $courses = mysqli_fetch_all($result , MYSQLI_ASSOC);
    } else {
        $courses = [];
    }
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">All Courses</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="all-categories.php">Categories</a></li>
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
                                        <th>Img</th>
                                        <th>category</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($courses as $key => $course) { ?>
                                    <tr>
                                        <td><?= $key + 1; ?></td>
                                        <td><?= $course['name']; ?></td>
                                        <td>
                                            <img src="../uploads/courses/<?= $course['img']; ?>" height="50px">
                                        </td>
                                        <td><?= $course['catName']; ?></td>
                                        <td><?= $course['created_at']; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-info"
                                                href="edit-course.php?id=<?= $course['id']; ?>">Edit</a>
                                            <a class="btn btn-sm btn-danger"
                                                href="delete-course.php?id=<?= $course['id']; ?>&imgOldName=<?= $course['img']; ?>  ">Delete</a>
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