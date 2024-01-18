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
        $discuss = $_GET['discuss'];
        $sql = "SELECT * FROM threads WHERE thread_id = '$discuss'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $thread_id = $row["thread_id"];
                $thread_title = $row["thread_title"];
                $thread_desc = $row["thread_desc"];
                $thread_user_id = $row["thread_user_id"];
                echo '<div class="container">
                <div class="p-2 mt-4 mb-4 bg-success bg-opacity-75 rounded-3">
                    <div class="container-fluid py-5">
                        <h1 class="display-3 text-white">'.$thread_title.'</h1>
                        <p class="fs-5">' .$thread_desc. '</p>
                        <p class="fs-6">Asked By: <b>'.$thread_user_id.'</b></p>
                    </div>
                </div>
            </div>';
            }
        }
    ?>

    <?php
    $alert = false;
    if(isset($_POST['submit'])){
    $comment_desc = $_POST['comment_desc'];
    $insert_query = "INSERT INTO `comments` (`comment_desc`, comment_thread_id) VALUES ('$comment_desc', '$discuss')";
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
            <h1 class="mb-3">Post A Comment</h1>
            <?php
            if($alert){
                echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Comment Post Successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            ?>
            <form method="post" action=<?php echo"threads_list.php?discuss=$discuss"?>>
                <div class="mb-3">
                    <textarea class="form-control" id="comment_desc" name="comment_desc"
                        style="height: 100px" placeholder="Write You Comment ...."></textarea>
                    <button type="submit" class="submit btn btn-success my-3 mb-0" id="submit"
                        name="submit">Post</button>
                </div>
            </form>
        </div>
    </div>


    <div class="container">
        <hr>
        <h1 class="mb-4">Discussions</h1>
        <?php
        $discuss = $_GET['discuss'];
        $sql2 = "SELECT * FROM comments WHERE comment_thread_id=$discuss";
        $result2 = mysqli_query($con, $sql2);
        if (mysqli_num_rows($result2) > 0) {
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $comment_id = $row2["comment_id"];
                $comment_desc = $row2["comment_desc"];
                $comment_user_id = $row2["comment_user_id"];
                echo'<div class="object mb-4">
                        <div class="media border border-2 rounded">
                            <img src="images/user.png" alt="User Icon" height="35px"><a href="#" class="text-dark"
                            style="font-size: 18px; text-decoration: none;">&nbsp; '.$comment_user_id.'</a>
                            <div class="media-body mx-5 mb-2">
                                <hp class="mt-1">Answer: '.$comment_desc.'</p>
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