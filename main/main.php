<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="main.css">
        <script src="../main.js"></script>
    </head>
    <body class="grey" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
        <div class="header grey">
            <h2 style="margin-left: 3vmin;font-size:5vmin">Vacation Blog</h2>
            <?php 
                session_start();
                if (!array_key_exists('username', $_SESSION) || !isset($_SESSION['username'])) {
                    echo "
                        <button class='grey' id='login-button' onclick='login()'>login</button>
                    ";
                } else {
                    echo "
                    <a href='../profile/profile.php'><img class='pic' src='";
                            if(array_key_exists('img', $_SESSION)) {
                                echo '../../'.$_SESSION['img']; 
                            } else {
                                echo 'nothing';
                            }
                        echo "'
                        style = 'margin-right:2vw;height:min(20vmin,50px);width:min(20vmin,50px);'
                        onerror='this.src = \"../app_images/profile.png\"'
                    ></a>
                    ";
                }
            ?>
        </div>
        <div style="
            text-align: center;
            width: 100%;
            margin-top: calc(min(20vmin,50px) + 30px);
            ">
            <?php
                include '../common/post.php';
                include '../common/db.php';
                $query = "SELECT * FROM $posts_table";
                $result = mysqli_query($connection, $query);
                if(mysqli_num_rows($result)) {
                    foreach($result as $row) {
                        $post = new Post($row);
                        $start = date_format(date_create($post->start), "Y M d");
                        $end = date_format(date_create($post->end), "Y M d");
                        $cities = implode(", ", $post->cities);
                        $cost = number_format($post->cost,0,"",",");
                        $transportation = implode(", ", $post->transportation);
                        $residence = implode(", ", $post->residence);
                        echo " 
                            <div class='post'>
                                <img class='pic' src='../../$post->user_img'
                                    onerror=\"this.src = '../app_images/profile.png'\"
                                >
                                <a class='username'>
                                    ".$post->username."
                                </a>
                                <div class='post-header'>
                                    <img class='post-img' onerror='this.src = \"../app_images/post.png\"' src='../images/".$post->username."/$post->img'>
                                    <h3 style='text-align: center;'>".$post->cities[0].", ".$post->country."</h3>
                                    <b>From: </b><span>".$start."</span><br>
                                    <b>Until: </b><span>$end</span><br>
                                    <b>Cities: </b><span>$cities</span><br>
                                    <b>Cost: </b><span>".$cost." T</span><br>
                                    <b>Transportation: </b><span>$transportation</span><br>
                                    <b>Residence: </b><span>$residence</span><br>
                                    <b>Highlights: </b><span>$post->highlights</span><br>
                                </div>
                                <div style='width:100%;float: left;'><b>Experience: </b><a>
                                $post->experience
                                </a></div>
                            </div>
                        ";
                    }
                }
            ?>
        </div>
    </body>
</html> 
