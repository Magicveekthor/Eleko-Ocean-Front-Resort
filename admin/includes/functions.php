<?php
    // frontend purpose data
    define('SITE_URL','http://127.0.0.1/Eleko_v2/');
    define('ABOUT_IMG_PATH', SITE_URL.'admin/assets/team/');
    define('CAROUSEL_PATH', SITE_URL.'admin/assets/carousel/');
    define('ROOMS_IMG_PATH', SITE_URL.'img/rooms/');


    // backend upload process needs this data
    define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'].'/Eleko_v2/');
    define('TEAM_FOLDER','admin/assets/team/');
    define('CAROUSEL_FOLDER','admin/assets/carousel/');
    define('ROOMS_FOLDER','img/rooms/');

    function adminLogin(){
        session_start();
        if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
            echo "
                <script>
                    window.location.href='index.php'
                </script>";
        }
        
        //exit;
        #delete old session/id
        #session_regenerate_id(true);
    }
    
    # Redirect success login
    function redirect($url) {
        echo "
            <script>
                window.location.href='$url'
            </script>";
        exit;
    }

    # Alert login and frontend
    function alert($type, $msg,) {
        $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
        echo <<<alert
            <div class="alert $bs_class alert-dismissible fade show alert-container" role="alert" id="autoDismissAlert">
                <strong class="me-3">$msg</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <script>
                setTimeout(function() {
                    let alertEl = document.getElementById('autoDismissAlert');
                    if(alertEl){
                        let bsAlert = bootstrap.Alert.getOrCreateInstance(alertEl);
                        bsAlert.close();
                    }
                }, 2000);
            </script>
        alert;
    }

    #upload Image
    function uploadImage($image, $folder) {
        $valid_mine = ['image/jpeg','image/png','image/webp'];
        $img_mine = $image['type'];

        if(!in_array($img_mine, $valid_mine)) {
            return 'inv_img';  // invalid image name or format
        } else if($image['size'] > (2 * 1024 * 1024)) {
            return 'inv_size'; // invalid size greater tham 2mb
        } else {
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".$ext"; //rename the image file
            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname; // prepared the file path.

            // move the file into final folder
            if(move_uploaded_file($image['tmp_name'],$img_path)) {
                return $rname;
            } else {
                return "Upload Failed";
            }
        }
    }

    #delete image
    function deleteImage($image, $folder) {
       $file_path = UPLOAD_IMAGE_PATH . $folder .$image;

       if(file_exists($file_path)) {
            return unlink($file_path);
        } else {
            return true;
        }
    }


    #upload video
    function uploadVideo ($video, $folder) {
        $valid_video = ['video/mp4','video/webm', 'video/ogv', 'video/avi', 'video/mov'];
        $video_option = $video['type'];

        // check video format
        if(!in_array($video_option, $valid_video)) {
            return 'inv_vid'; // invalid video format
        } else if($video['size'] > (20 * 1024 * 1024)) {
            return 'inv_size'; // invalid size
        } else {
            $ext = pathinfo($video['name'], PATHINFO_EXTENSION);
            $rname = 'VID_'.random_int(11111,99999).".$ext";
            $video_path = UPLOAD_IMAGE_PATH.$folder.$rname;

            if(move_uploaded_file($video['tmp_name'], $video_path)) {
                return $rname;
            } else {
                return "Upload Failed";
            }
        }
    }


    #delete video
    function deleteVideo($video, $folder) {
       $file_path = UPLOAD_IMAGE_PATH . $folder .$video;

       if(file_exists($file_path)) {
            return unlink($file_path);
        } else {
            return true;
        }
    }

?>