<?php include("../global.php"); ?>
<?php include("$root/admin/inc/header.php"); ?>

<?php

$id = $session->get('adminId');
$sql = "SELECT `name`, email FROM admins WHERE id = $id";

$result = mysqli_query($conn , $sql);

if(mysqli_num_rows($result) > 0)
{
    $admin = mysqli_fetch_assoc($result);
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Categories</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <?php  include("$root/admin/inc/errors.php"); ?>
                <?php  include("$root/admin/inc/success.php"); ?>


                <!-- Form Start -->
                <form role="form" method="POST" action="handlers/handle-edit-profile.php">
                    <div class="form-group">
                        <label for="exampleInputName">Name</label>
                        <input type="text" class=" form-control" id="exampleInputEmail1" name="name"
                            value="<?= $admin['name']; ?>">

                        <div class="form-group">
                            <label for="exampleInputName">Email</label>
                            <input type="email" class=" form-control" id="exampleInputEmail1" name="email"
                                value="<?= $admin['email']; ?>">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Password</label>
                        <input type="password" class=" form-control" id="exampleInputEmail1" name="password">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputName">Confirm Password</label>
                        <input type="password" class=" form-control" id="exampleInputEmail1" name="confirm_password">
                    </div>

                    <!-- /.card-body -->

                    <div class=" card-footer">
                        <button type="submit" name="submit" class=" btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include("$root/admin/inc/footer.php"); ?>