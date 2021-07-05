<?php 

include("../../global.php");
include("$root/admin/inc/db-connect.php");

if($request->postHas('submit'))
{
    $id = $request->get('id');
    $imgOldName = $request->get('imgOldName');;
    $name = mysqli_real_escape_string($conn , $request->postClean('name'));
    $desc = mysqli_real_escape_string($conn , $request->postClean('desc'));
    $cat_id = mysqli_real_escape_string($conn , $request->postClean('cat_id'));
    $img = $_FILES['img'];
   
    if(! empty($img['name']))
    {
        $imgName = $img ['name'];
        $imgTmpName = $img ['tmp_name'];
        $imgError = $img ['error'];
        $imgSize = $img ['size'];
        $imgType = $img ['type'];
    }
    
    //validation
    $errors = [];

    //name:required | string | max:255
    $errors[] = validateName($name);


    //desc:required | string 
    if(empty($desc))
    {
        $errors[] = "desc is required";
    }
    elseif (! is_string($desc) )
    {
        $errors[] = "desc must be string";
    }

     
    //cat_id:required
    if(empty($cat_id))
    {
        $errors[] = "category is required";
    }

    //img: NoError , available extentions , max:2MB
    if(! empty($img['name'])){
        $allowedExtensions = ['jpg' , 'jpeg' , 'png' , 'gif'];
        $imgExtension = pathinfo($imgName , PATHINFO_EXTENSION);

        //img: upload successfully , Extentions , size 
        $imgSizeMb = $imgSize / (1024 ** 2);

        if($imgErrors != 0)
        {
            $errors[] = "error while uploading image";
        }
        elseif (in_array($imgExtension , $allowedExtensions) == false)
        {
            $errors[] = "Extention is not valid, allowed is jpg , jpeg , png and gif";
        }
        elseif ($imgSizeMb > 2)
        {
            $errors[] = "Maximum allowed size = 2Mb in file";
        }
}

    $errors = cleanErrors($errors);
    
    if(empty($errors))
    {
        //insert data in reservation system
        if(! empty($img['name']))
        {
            unlink("../../uploads/courses/$imgOldName");
            
            $randomStr = uniqid();
            $imgNewName = "$randomStr.$imgExtension";
            move_uploaded_file( $imgTmpName , "../../uploads/courses/$imgNewName");

                
            $isUpdated = update(
                $conn , 
                "courses" , 
                "name =  '$name' ,`desc` = '$desc' , cat_id = $cat_id , img = '$imgNewName'" , 
                "id = $id"
            );
        }
        else
        {
            $isUpdated = update(
                $conn , 
                "courses" , 
                "name = '$name' ,`desc` = '$desc' , cat_id = $cat_id", 
                "id = $id"
            );
        }
        
        if ($isUpdated)
        {
            //redirect back with success message 
            $session->set('success' , "You Edit Course Successfully");

            header("location:../all-courses.php");

        }
        
        mysqli_close($conn);
        
    } else 
    {
        //store errors in sessions 
        $session->set('errors' , $errors);
        
        header("location: ../edit-course.php?id=$id");

    }

}

?>