<?php
const DEFAULT_LIMIT = 10;

// $page = isset($_POST['page']) ? (is_numeric($_POST['page']) ? $_POST['page'] : 1) : 1;
// $limit = isset($_POST['limit']) ? (is_numeric($_POST['limit']) ? $_POST['limit'] : DEFAULT_LIMIT) : DEFAULT_LIMIT;
// $sortBy = isset($_POST['sortBy']) ? $_POST['sortBY'] : 'release_date';
// $filters = isset($_POST['filters']) ? $_POST['filters'] : null;



$movies_model = new MoviesModel();
//setup filtering


//setup sorting


//setup limits



$movies = $movies_model->getMoviesWithCategories();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container" style="max-width: 600px;">

        <div id="filter-box">
            <form>
                <div class="d-flex mb-2">

                    <div class="input-group mx-2">
                        <label class="input-group-text" for="inputGroupSelect01">Genre</label>
                        <select class="form-select" id="inputGroupSelect01">
                            <option selected>All</option>
                            <option value="action">Action</option>
                            <option value="drama">Drama</option>
                        </select>
                    </div>

                    <div class="input-group mx-2">
                        <label class="input-group-text" for="inputGroupSelect01">Language</label>
                        <select class="form-select" id="inputGroupSelect01">
                            <option selected>All</option>
                            <option value="action">English</option>
                            <option value="drama">Hindi</option>
                        </select>
                    </div>


                </div>
                <div class="d-flex">
                    <div class="input-group mx-2">
                        <label class="input-group-text" for="inputGroupSelect01">SORT BY</label>
                        <select class="form-select" id="inputGroupSelect01">
                            <option value="action">Release Date</option>
                            <option value="drama">Playtime</option>
                        </select>
                        <select class="form-select" id="inputGroupSelect01">
                            <option value="action">Highest</option>
                            <option value="drama">Lowest</option>
                        </select>
                    </div>


                    <button type="submit" id="search" class="btn btn-primary btn-sm">Search</button>
                </div>
            </form>
        </div>
        <div id="movie_results">
            <div class="card movie_card">
                <div class="card-body d-flex">
                    <img class="poster" style="width: 200px; height: 300px" src="" />
                    <div class="details mx-2">
                        <h4 class="title">This is a movie title</h4>
                        <p class="description">This is a long yet short movie description which I am writing to preview how long text would fit into this container along with the image and blah blah blah.</p>
                        <p class="genre">Sci-Fi, Action</p>
                        <p class="language"> English</p>
                        <p class="release_date"> 24 July 2021 </p>
                    </div>

                </div>
            </div>
        </div>
        <div id="pagination"></div>


        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>