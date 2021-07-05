<?php include("global.php"); ?>

<?php include("inc/header.php"); ?>

<?php 

if($request->getHas('id'))
{
    $id = $request ->get('id');

} 
else 
{
    $id = 1;
}


$cat = selectOne($conn, "name" , "cats" , "WHERE id = $id");
$catName = $cat['name'];

?>

<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg overlay2">
    <h3><?= $catName; ?></h3>
</div>
<!-- bradcam_area_end -->

<!-- popular_courses_start -->
<div class="popular_courses">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center mb-100">
                    <h3><?= $catName; ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="all_courses">
        <div class="container">
            <?php 
                $sql = "SELECT courses.id AS courseId, courses.name AS courseName,
                img, cats.name AS catName FROM courses JOIN cats 
                ON courses.cat_id = cats.id
                WHERE cats.id = $id
                ORDER BY courses.id DESC";

                $result = mysqli_query($conn, $sql);


                if (mysqli_num_rows($result) > 0) {
                // output data of each row
                    $catCourses = mysqli_fetch_all($result , MYSQLI_ASSOC);
                } else {
                    $catCourses = [];
                }
            ?>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">

                        <?php foreach ($catCourses as $course) {?>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single_courses">
                                <div class="thumb">
                                    <a href="#">
                                        <img src="uploads/courses/<?= $course['img']; ?>" alt="">
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- popular_courses_end-->


<?php include("$root/inc/footer.php"); ?>/