<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MERN Discuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- Include Header -->
    <?php include 'partials/_header.php'?>
    <!-- Include Database -->
    <?php include 'partials/_dbconnect.php'?>

    <?php
        $cate_id = $_GET['thread'];
        $sql = "SELECT * FROM category WHERE cate_id = '$cate_id'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $cate_id = $row["cate_id"];
                $cate_name = $row["cate_name"];
                $cate_desc = $row["cate_desc"];
                echo '<div class="container">
                <div class="p-2 mt-4 mb-4 bg-success bg-opacity-75 rounded-3">
                    <div class="container-fluid py-5">
                        <h1 class="display-3 text-white">Welcome to '.$cate_name.' Forum</h1>
                        <p class="fs-5"><b>'.$cate_name.'</b>: ' .$cate_desc. '</p>
                        <hr>
                        <h4 class="display-6 mb-2 text-white">Forum Rules:</h4>
                        <p class="fs-5">Everyone Must Follow These Guidelines.</p>
                        <ul class="mb-0">
                            <li class="mb-2"><strong>No Spam:</strong> Avoid posting irrelevant or repetitive content that disrupts the flow of discussions.</li>
                            <li class="mb-2"><strong>No Promotion:</strong> Refrain from promoting personal or commercial interests, including products, services, or websites.</li>
                            <li class="mb-2"><strong>Respect Others:</strong> Be courteous and respectful to fellow users, avoiding offensive language, personal attacks, or discrimination.</li>
                            <li class="mb-2"><strong>Stay on Topic:</strong> Contribute to discussions within the designated topics or categories, maintaining relevance to the forum purpose.</li>
                        </ul>
                    </div>
                </div>
            </div>';
            }
        }
    ?>

    <?php
    $alert = false;
    if(isset($_POST['submit'])){
    $thread_title = $_POST['thread_title'];
    $thread_desc = $_POST['thread_desc'];
    $insert_query = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cate_id`) VALUES ('$thread_title','$thread_desc', '$cate_id')";
    $insert_result = mysqli_query($con, $insert_query);
    if($insert_result){
        $alert = true;
    }else{
        echo "Failed";
    }
    }
    ?>
    <div class="container border border-2 rounded-3">
        <div class="form mb-3 mt-3">
            <h1 class="mb-3">Post A Thread</h1>
            <?php
            if($alert){
                echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Thread Post Successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            ?>
            <form method="post" action=<?php echo"threads.php?thread=$cate_id"?>>
                <div class="mb-3">
                    <input type="text" class="form-control" name="thread_title" id="thread_title" placeholder="Write Thread Title">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" id="thread_desc" name="thread_desc" style="height: 100px;" placeholder="Write Thread Description"></textarea>
                </div>
                    <button type="submit" class="submit btn btn-success mb-0" id="submit"
                        name="submit">Post</button>
                </div>
            </form>
        </div>
    </div>


    <div class="container"><hr>
        <h1 class="mb-4">Browse Thread</h1>
        <?php
        $cate_id = $_GET['thread'];
        $sql2 = "SELECT * FROM threads WHERE thread_cate_id=$cate_id";
        $result2 = mysqli_query($con, $sql2);
        if (mysqli_num_rows($result2) > 0) {
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $thread_id = $row2["thread_id"];
                $thread_title = $row2["thread_title"];
                $thread_desc = $row2["thread_desc"];
                $thread_user_id = $row2["thread_user_id"];
                echo'<div class="object mb-4">
                        <div class="media border border-2 rounded">
                            <img src="images/user.png" alt="User Icon" height="35px"><a href="#" class="text-dark"
                            style="font-size: 18px; text-decoration: none;">&nbsp; '.$thread_user_id.'</a>
                            <div class="media-body mx-5 mb-2">
                                <h5 class="mt-1"><a href="threads_list.php?discuss='.$thread_id.'" class="text-success" style="text-decoration:none;">'.$thread_title.'</a></h5>'.$thread_desc.'
                            </div>
                        </div>
                    </div>';
              }
        }
    ?>

    </div>

    <!-- Include Footer -->
    <?php include 'partials/_footer.php'?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>