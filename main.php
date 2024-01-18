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

    <!-- Image Slider -->
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/1st.jpg" class="d-block w-100" alt="Progamming Pic">
            </div>
            <div class="carousel-item">
                <img src="images/2nd.jpg" class="d-block w-100" alt="Progamming Pic">
            </div>
            <div class="carousel-item">
                <img src="images/3rd.jpg" class="d-block w-100" alt="Progamming Pic">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Category Cards -->
    <div class="container my-5">
        <h1 class="text-center my-5">Browse Category</h1>
        <div class="row">         
            <?php
            $sql = "SELECT * FROM category";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $cate_id = $row["cate_id"];
                    $cate_name = $row["cate_name"];
                    $cate_desc = $row["cate_desc"];
                echo '<div class="col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="images/'.$cate_id.'.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">'.$cate_name.'</h5>
                            <p class="card-text" style="height: 8rem;">'. substr($cate_desc, 0 ,150).'...</p>
                            <a href="threads.php?thread='.$cate_id.'" class="btn btn-primary">Check Threads</a>
                        </div>
                    </div>
                </div>';
                }
            }
            ?>
        </div>
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