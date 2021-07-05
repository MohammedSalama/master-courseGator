<?php include("global.php"); ?>

<?php include("$root/inc/header.php"); ?>

<?php 

// $page = isset($_GET['page']) ? $_GET['page'] : 1;

if($request->getHas('page'))
{
    $page = $request->get('page');
}
else
{
    $page = 1;
}

$num = 3;
$offset = $num * ($page - 1);

$row = selectOne($conn , "COUNT(id) AS coursesCount" , "courses");
$coursesCount = $row['coursesCount'];

$result = $coursesCount / $num;
$lastPage = ceil($result);


?>

<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg overlay2">
    <h3>Our Courses</h3>
</div>
<!-- bradcam_area_end -->

<!-- popular_courses_start -->
<div class="popular_courses">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-100">
                    <h3>All Courses</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="all_courses">
        <div class="container">
            <?php 

        $courses = selectJoin($conn,
            "courses.id AS courseId, courses.name AS courseName, img, cats.name AS catName" , 
            "courses JOIN cats" ,
            "courses.cat_id = cats.id" ,
            "ORDER BY courses.id DESC LIMIT $num OFFSET $offset"
        );

    ?>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">

                        <?php foreach ($courses as $course) {?>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single_courses">
                                <div class="thumb">
                                    <a href="#">
                                        <img src="<?= $url; ?>uploads/courses/<?= $course['img']; ?>" alt="">
                                    </a>
                                </div>
                                <div class="courses_info">
                                    <span><?= $course ['catName']; ?></span>
                                    <h3><a href="#"><?= $course ['courseName']; ?></a></h3>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="text-center">
                        <a <?php if($page ==1) { echo "style= 'pointer-events:none' "; } ?>class="btn btn-info"
                            href="<?= $url; ?>all-courses.php?page=<?= $page - 1; ?>">prev</a>
                        <a <?php if($page == $lastPage) { echo "style= 'pointer-events:none' "; } ?>class="btn btn-info"
                            href="<?= $url; ?>all-courses.php?page=<?= $page + 1; ?>">next</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- popular_courses_end-->


<?php include("$root/inc/footer.php"); ?>