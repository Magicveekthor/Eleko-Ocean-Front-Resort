<?php
# connecting files
require("../includes/db.php");
require("../includes/functions.php");
adminLogin();


if(isset($_POST['add_room'])) {
    $frm_data = filteration($_POST);
    $flag = 0;

    $query = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `adult`, `children`, `desc_title`, `descrip`) VALUES (?,?,?,?,?,?,?,?)";
    $values  = [$frm_data['name'], $frm_data['area'], $frm_data['price'], $frm_data['quantity'], $frm_data['adult'], $frm_data['children'], $frm_data['desc_title'], $frm_data['descrip']];

    if(insert($query, $values, 'siiiiiss')) {
        $flag = 1;
    }
    
    if($flag) {
        echo 1;
    } else {
        echo 0;
    }
}

if(isset($_POST['get_all_rooms'])) {
    #original function to call all the rooms
    $res = selectAll('rooms');

    #secondary function to call only the removed column
    $res = select("SELECT * FROM `rooms` WHERE `removed` = ?", [0], 'i');
    $i = 1;

    $data = "";

    while($row = mysqli_fetch_assoc($res)) {
        $price = number_format($row['price']); 
        $roomNameSafe = addslashes($row['name']);

        if($row['status'] == 1) {
            $status = "<a href='#' onclick='toggle_status({$row['id']}, 0)' class='status completed'>Active</a>";
        } else {
            $status = "<a href='#' onclick='toggle_status({$row['id']}, 1)' class='status pending'>Inactive</a>";
        }

        $data.="
            <tr>
                <td>{$row['name']}</td>
                <td>{$row['area']}</td>
                <td>
                    <span class='badge rounded-pill bg-primary text-light'>
                        Adult: {$row['adult']}
                    </span><br>
                    <span class='badge rounded-pill bg-primary text-light'>
                        Children: {$row['children']}
                    </span>
                </td>
                <td>&#8358;{$price}</td>
                <td>{$row['quantity']}</td>
                <td>$status</td>
                <td>
                    <button href='#' onclick='edit_details({$row['id']})' class='btn-view-more edit' data-bs-toggle='modal' data-bs-target='#edit-room'>
                        <i class='bx bxs-edit'></i>
                    </button>

                    <button href='#' onclick=\"room_images({$row['id']}, '{$roomNameSafe}')\" class='btn-view-more images' data-bs-toggle='modal' data-bs-target='#room-images'>
                        <i class='bx bx-images'></i>
                    </button>

                    <button onclick='remove_room({$row['id']})' class='btn-view-more delete'>
                        <i class='bx bx-trash'></i>
                    </button>
                </td>
            </tr>
        ";
        $i++;
    }

    echo $data;
}

if(isset($_POST['get_room'])){
    $frm_data = filteration($_POST);

    $res = select("SELECT * FROM `rooms` WHERE id = ?", [$frm_data['get_room']], 'i');
    $roomdata = mysqli_fetch_assoc($res);

    $data = ["roomdata" => $roomdata];
    $data = json_encode($data);
    echo $data;
}

if(isset($_POST['edit_room'])){
    $frm_data = filteration($_POST);
    $flag = 0;

    #Decode HTML entities & clean up textarea content before saving
    $frm_data['descrip'] = htmlspecialchars_decode($frm_data['descrip'], ENT_QUOTES);

    $query = "UPDATE `rooms` SET `name`= ?,`area`= ?,`price`= ?,`quantity`= ?,`adult`= ?,`children`= ?,`desc_title`= ?,`descrip`= ? WHERE `id` = ?";
    $values  = [$frm_data['name'], $frm_data['area'], $frm_data['price'], $frm_data['quantity'], $frm_data['adult'], $frm_data['children'], $frm_data['desc_title'], $frm_data['descrip'], $frm_data['room_id']];

    if(update($query, $values, 'siiiiissi')) {
        $flag = 1;
    }

    if($flag) {
        echo 1;
    } else {
        echo 0;
    }
}


if(isset($_POST['toggle_status'])) {
    $frm_data = filteration($_POST);

    $query = "UPDATE `rooms` SET `status` = ? WHERE id = ?";
    $verify = [$frm_data['value'], $frm_data['toggle_status']];

    if(update($query, $verify, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }
}


if(isset($_POST['add_image'])) {
    $frm_data = filteration($_POST);

    $img_r = uploadImage($_FILES['image'],ROOMS_FOLDER);

    if($img_r == 'inv_img'){
        echo $img_r;
    } else if($img_r == 'inv_size') {
        echo $img_r;
    } else if($img_r == 'Upload Failed') {
        echo $img_r;
    } else {
        $insert = "INSERT INTO `room_images`(`room_id`, `image`) VALUES (?,?)";
        $values = [$frm_data['room_id'], $img_r];
        $res = insert($insert, $values, 'is');
        echo $res;
    }
}


if(isset($_POST['get_room_images'])) {
    $frm_data = filteration($_POST);
    $res = select("SELECT * FROM `room_images` WHERE `room_id` = ? ORDER BY `id` DESC", [$frm_data['get_room_images']], 'i');

    $path = ROOMS_IMG_PATH;

    while($row = mysqli_fetch_assoc($res)) {
        #thumbnail - you might remove later
        if($row['thumbnail'] == 1) {
            $thumb_btn = "<button class='btn-view-more check'><i class='bx bx-check'></i></button>";
        } else {
            $thumb_btn = "<button onclick='thumb_image({$row['id']}, {$row['room_id']})' class='btn-view-more invalid'>
                            <i class='bx bx-x'></i>
                        </button>";
        }
        #thumbnail - you might remove later

        echo <<<data
            <tr>
                <td><img src='$path{$row['image']}' class='room-image'></td>
                <td>$thumb_btn</td>
                <td>
                    <button onclick='remove_image({$row['id']}, {$row['room_id']})' class='btn-view-more delete'>
                        <i class='bx bx-trash'></i>
                    </button>
                </td>
            </tr>
        data;
    }
}


if(isset($_POST['remove_image'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['image_id'], $frm_data['room_id']];

    #fetch the room image record first
    $pre_query = "SELECT * FROM `room_images` WHERE id = ? AND room_id = ?";
    $res = select($pre_query, $values, 'ii');
    $image = mysqli_fetch_assoc($res);

    if($image && deleteImage($image['image'], ROOMS_FOLDER)) {
        $query = "DELETE FROM `room_images` WHERE id = ? AND room_id = ?";
        $res = delete($query, $values, 'ii');
        echo $res;
    } else {
        echo 0;
    }
}



#thumbnail - you might remove later
if(isset($_POST['thumb_image'])) {
    $frm_data = filteration($_POST);

    $pre_query = "UPDATE `room_images` SET `thumbnail` = ? WHERE `room_id` = ?";
    $pre_values = [0, $frm_data['room_id']];
    $pre_result = update($pre_query, $pre_values, 'ii');

    $query = "UPDATE `room_images` SET `thumbnail` = ? WHERE `id` = ? AND `room_id` = ?";
    $values = [1, $frm_data['image_id'], $frm_data['room_id']];
    $result = update($query, $values, 'iii');

    echo $result;
}
#thumbnail - you might remove later



if(isset($_POST['remove_room'])) {
    $frm_data = filteration($_POST);
    $res_images  = select("SELECT * FROM `room_images` WHERE `room_id` = ?", [$frm_data['room_id']], 'i');

    while($row = mysqli_fetch_assoc($res_images)) {
        deleteImage($row['image'], ROOMS_FOLDER);
    }

    $res2 = delete("DELETE FROM `room_images` WHERE room_id = ?", [$frm_data['room_id']], 'i');
    $res3  = update("UPDATE `rooms` SET `removed` = ? WHERE `id` = ?", [1, $frm_data['room_id']], 'ii');

    if ($res2 || $res3){
        echo 1;
    } else {
        echo 0;
    }
}
?>