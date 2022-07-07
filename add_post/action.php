<?php
    if (!array_key_exists('username', $_SESSION) || !isset($_SESSION['username'])) {
        echo "
        <div style='width:100%;height:50vh;text-align:center;color:red'>Access Denied</div>
        ";
        exit();
    }

    include '../common/db.php';
    
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST['add_post'])) {
        $username = $_SESSION['username'];
        $user_image = $_SESSION['img'];
        $img = '';
        $error = false;
        if(isset($_FILES["img_file"])& $_FILES["img_file"]['name'] != '') { 
            $img_info = pathinfo($_FILES["img_file"]["name"])['extension'];
            if(!is_dir("../images/$username/")) {
                $img = "1.".$img_info;
            } else {
                $files = scandir("../images/$username/");
                if($files) {
                    $img = count($files) + 1 . ".$img_info";
                } else {
                    $img = "1.".$img_info;
                }
            }
        }
        $country = $_POST['country'];
        $city1 = ucfirst(validate($_POST['city1']));
        $city2 = ucfirst(validate($_POST['city2']));
        $city3 = ucfirst(validate($_POST['city3']));
        $start = $_POST['start_date'];
        $end = $_POST['end_date'];
        $cost = $_POST['cost'];
        $transport = '';
        $residence = '';
        $experience = $_POST['experience'];
        $highlight1 = ucfirst(validate($_POST['highlight1']));
        $highlight2 = ucfirst(validate($_POST['highlight2']));
        $highlight3 = ucfirst(validate($_POST['highlight3']));
        if(empty($country) || empty($city1) || empty($start) || 
            empty($end) || empty($cost) || empty($highlight1) ||
            !isset($_POST['transport']) || !isset($_POST['residence'])) {
            echo "
                <div class='form-item'>
                    <div class='error'>Required fields must be filled</div>
                    <label class='label'></label>
                </div> 
                ";
        } else {
            $transport = implode(", ", $_POST['transport']);
            $residence = implode(", ", $_POST['residence']);
            if(!empty($highlight2)) {
                $highlight1 = $highlight1 . ", " . $highlight2;
            }
            if(!empty($highlight3)) {
                $highlight1 = $highlight1 . ", " . $highlight3;
            } 
            if(!empty($city2)) {
                $city1 = $city1 . ", " . $city2;
            } 
            if(!empty($city2)) {
                $city1 = $city1 . ", " . $city3;
            }
            $query= "INSERT INTO $posts_table VALUES ('','$username','$user_image','$img','$city1','$country','$start','$end','$cost','$transport','$residence','$highlight1','$experience')";
            try {
                $result = mysqli_query($connection, $query);
                if($result) {
                    if(isset($_FILES["img_file"]) & $_FILES["img_file"]['name'] != '') { 
                        if(!is_dir("../images/$username/")) {
                            mkdir("../images/$username/");
                        }
                        $filepath = "../images/$username/$img";
                        move_uploaded_file($_FILES["img_file"]["tmp_name"], $filepath);
                    }
                    header("Location:../profile/profile.php");
                } else {
                    echo "
                    <div class='form-item'>
                        <div class='error'>An error occurred</div>
                        <label class='label'></label>
                    </div> 
                    ";
                }
            } catch(Exception $e) {
                echo $e;
            }
        }
    }
?>