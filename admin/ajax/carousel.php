<?php
# connecting files
require("../includes/db.php");
require("../includes/functions.php");
adminLogin();

if(isset($_POST['addcarousel'])) {

    // Check if a carousel record already exists
    $check = selectAll('carousel');
    if(mysqli_num_rows($check) > 0){
        echo 'max_reached';
        exit;
    }
    
    $video_r = uploadVideo($_FILES['carousel_video'],CAROUSEL_FOLDER);

    if($video_r == 'inv_vid'){
        echo $video_r;
    } else if($video_r == 'inv_size') {
        echo $video_r;
    } else if($video_r == 'Upload Failed') {
        echo $video_r;
    } else {
        $insert = "INSERT INTO `carousel`(`carousel_video`) VALUES (?)";
        $values = [$video_r];
        $res = insert($insert, $values, 's');
        echo $res;
    }
}

if(isset($_POST['get_carousel'])) {
    $res = selectAll('carousel');
    while($row = mysqli_fetch_assoc($res)) {
        $path = CAROUSEL_PATH;
        echo <<<data
            <tr>
                <td>
                    <video width="300" controls>
                        <source src="$path{$row['carousel_video']}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </td>
                <td>
                    <a href="#" onclick="openEditModal({$row['id']}); return false;" class="status completed">Edit</a>
                    <a href="#" onclick="remove_carousel({$row['id']}); return false;" class="status pending">Delete</a>
                </td>
            </tr>
        data;
    }
}

if(isset($_POST['remove_member'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['remove_member']];

    $pre_query = "SELECT * FROM `team_details` WHERE id = ?";
    $res = select($pre_query, $values, 'i');
    $img = mysqli_fetch_assoc($res);

    if(deleteImage($img['picture'], TEAM_FOLDER)) {
        $query = "DELETE FROM `team_details` WHERE id = ?";
        $res = delete($query, $values, 'i');
        echo $res;
    } else {
        echo 0;
    }
}

if(isset($_POST['remove_carousel'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['remove_carousel']];

    #fetch the video record first
    $pre_query = "SELECT * FROM `carousel` WHERE id = ?";
    $res = select($pre_query, $values, 'i');
    $video = mysqli_fetch_assoc($res);

    if($video && deleteVideo($video['carousel_video'], CAROUSEL_FOLDER)) {
        $query = "DELETE FROM `carousel` WHERE id = ?";
        $res = delete($query, $values, 'i');
        echo $res;
    } else {
        echo 0;
    }
}

if(isset($_POST['edit_carousel'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['edit_carousel']];

    #check if file is uploaded
    if(!isset($_FILES['carousel_video'])) {
        echo 'no file';
        exit;
    }

    #upload new video
    $video_r = uploadVideo($_FILES['carousel_video'], CAROUSEL_FOLDER);

    if($video_r == 'inv_vid') {
        echo 'inv_vid';
    } else if ($video_r == 'inv_size') {
        echo 'inv_size';
    } else if ($video_r == 'Upload Failed') {
        echo '  Upload Failed!';
    } else {
        #fetch old video
        $pre_query = "SELECT * FROM carousel WHERE id = ?";
        $res = select($pre_query, $values, 'i');
        $video = mysqli_fetch_assoc($res);

        if($video && deleteVideo($video['carousel_video'], CAROUSEL_FOLDER)) {
            #update with new name
            $query = "UPDATE carousel SET carousel_video = ? WHERE id = ?";
            $res = update($query, [$video_r, $frm_data['edit_carousel']], 'si');
            echo $res;
        } else {
            echo 0;
        }
    }
}
?>