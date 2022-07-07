<?php
    if (!array_key_exists('username', $_SESSION) || !isset($_SESSION['username'])) {
        echo "
        <div style='width:100%;height:50vh;text-align:center;color:red'>Access Denied</div>
        ";
        exit();
    }
    include '../common/post.php';
    include '../common/db.php';

    $query= "SELECT * FROM $posts_table WHERE user_name='".$_SESSION['username']."'";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result)) {
        foreach($result as $row) {
            $post = new Post($row);
            $country = explode(",",$post->country)[0];
            $start = date_format(date_create($post->start), "Y M d");
            $end = date_format(date_create($post->end), "Y M d");
            $cities = implode(", ", $post->cities);
            $cost = number_format($post->cost,0,"",",");
            $transportation = implode(", ", $post->transportation);
            $residence = implode(", ", $post->residence);
            echo " 
                <div class='post'>
                <div class='post-header'>
                    <img class='post-img' onerror='this.src = \"../app_images/post.png\"' src='../images/".$_SESSION['username']."/$post->img'>
                    <h3 style='text-align: center;'>".$post->cities[0].", ".$country."</h3>
                    <b>From: </b><span>".$start."</span><br>
                    <b>Until: </b><span>$end</span><br>
                    <b>Cities: </b><span>$cities</span><br>
                    <b>Cost: </b><span>".$cost." T</span><br>
                    <b>Transportation: </b><span>$transportation</span><br>
                    <b>Residence: </b><span>$residence</span><br>
                    <b>Highlights: </b><span>$post->highlights</span><br>
                </div>
                <div style='width:100%;float: left;'><b>Experience: </b><a>
                $post->experience</a></div>
                
                </div>
            ";
        }
    }
?>
<!-- <button class='edit-post-button' >
                    <i class='fa fa-edit' style='font-size: 3vmin;background-color: none;'></i>
                </button> -->