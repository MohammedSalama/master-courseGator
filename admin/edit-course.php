<?php include("../global.php"); ?>

<?php include("$root/admin/inc/header.php"); ?>


<?php

if ($request->getHas('id'))
{
    $id = $request ->get('id');
    $sql = "SELECT * FROM courses WHERE id = $id";
    $result = mysqli_query($conn , $sql);

    if(mysqli_num_rows($result) > 0)
    {
        $course= mysqli_fetch_assoc($result);
    }
    
    

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

}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit course</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Courses</a></li>
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

                <!-- Form Start -->
                <form role="form" method="POST"
                    action="handlers/handle-edit-course.php?id=<?= $course['id']; ?>&imgOldName=<?= $course['img']; ?>"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputName">Name</label>
                            <input type="text" name="name" value="<?= $course['name']; ?>" class=" form-control"
                                id="exampleInputEmail1">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="desc" rows="3"><?= $course['desc']; ?></textarea>
                        </div>


                        <div class="form-group">
                            <label for="spec">Category</label>
                            <select class="form-control valid" name="cat_id" id="cat_id">
                                <?php foreach($cats as $cat) { ?>
                                <option <?php if($cat['id'] == $course['cat_id']) { echo "selected"; } ?>
                                    value="<?= $cat['id']; ?>">
                                    <?= $cat['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <img src="../uploads/courses/<?= $course['img']; ?>" height="50px">
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