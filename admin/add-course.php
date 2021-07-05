<?php include("../global.php"); ?>

<?php include("$root/admin/inc/header.php"); ?>


<?php 

$sql = "SELECT id , name FROM cats";
$result = mysqli_query($conn , $sql);

if(mysqli_num_rows($result) > 0)
{
    $cats = mysqli_fetch_all($result , MYSQLI_ASSOC);
}
else 
{
    $cats = [];
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Course</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="all-courses.php">Courses</a></li>
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

                <?php  include("$root/admin/inc/errors.php"); ?>

                <!-- Form Start -->
                <form role="form" method="POST" action="handlers/handle-add-course.php" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputName">Name</label>
                            <input type="text" name="name" class=" form-control" id="exampleInputEmail1"
                                placeholder="Enter Course Name">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="desc" rows="3"></textarea>
                        </div>


                        <div class="form-group">
                            <label for="spec">Category</label>
                            <select class="form-control valid" name="cat_id" id="cat_id">
                                <?php foreach($cats as $cat) { ?>
                                <option value="<?= $cat['id']; ?>"><?= $cat['name']; ?></option>
                                <?php } ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="exampleInputImage">Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="img" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
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