<?php include("../global.php"); ?>

<?php include("$root/admin/inc/header.php"); ?>


<?php 

if($request->getHas('id'))
{
    $id = $request ->get('id');
    $sql = "SELECT reservations.* , courses.name AS courseName 
    FROM reservations JOIN courses
    ON reservations.course_id = courses.id
    WHERE reservations.id = $id";
    $result = mysqli_query($conn , $sql);

    if(mysqli_num_rows($result) > 0)
    {
        $reserve = mysqli_fetch_assoc($result);
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
                    <!-- <h1 class="m-0 text-dark">Add Course</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="all-courses.php">Courses</a></li>
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
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-body">
                            <p>
                                <strong>Name : </strong><?= $reserve['name']; ?>
                            </p>
                            <p>
                                <strong>Email : </strong><?= $reserve['email']; ?>
                            </p>
                            <p>
                                <strong>Phone : </strong><?= $reserve['phone']; ?>
                            </p>
                            <p>
                                <strong>Speciality : </strong><?= $reserve['spec']; ?>
                            </p>
                            <p>
                                <strong>Course Name : </strong><?= $reserve['courseName']; ?>
                            </p>
                            <p>
                                <strong>Created At : </strong><?= $reserve['created_at']; ?>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include("$root/admin/inc/footer.php"); ?>