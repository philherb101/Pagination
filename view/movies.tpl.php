<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, Movies</title>
</head>

<body style="background-color: aliceblue;">
    <div class="container mt-5" style="max-width: 600px;">

        <div id="filter-box">
            <form action='index.php'>
                <div class="d-flex mb-2">

                    <div class="input-group mx-2">
                        <label class="input-group-text" for="select-genre">Genre</label>
                        <select class="form-select" id="select-genre" name="genre">
                            <option value="" <?= (!$genre ? "selected" : "") ?>>All</option>
                            <?php
                            foreach ($genres as $item)
                                echo "<option value='" . $item['value'] . "'" . ($item['value'] == $genre ? "selected" : "") . ">" . $item['value'] . "</option>" ?>
                        </select>
                    </div>

                    <div class="input-group mx-2">
                        <label class="input-group-text" for="select-language">Language</label>
                        <select class="form-select" id="select-language" name="lang">
                            <option value="" <?= (!$lang ? "selected" : "") ?>>All</option>
                            <?php foreach ($languages as $item)
                                echo "<option value='" . $item['value'] . "'" . ($item['value'] == $lang ? "selected" : "") . ">" . $item['value'] . "</option>" ?>
                        </select>
                    </div>


                </div>
                <div class="d-flex">
                    <div class="input-group mx-2">
                        <label class="input-group-text" for="sort-by">Sort by</label>
                        <select class="form-select" id="sort-by" name="sort_field">
                            <?php foreach ($sorting_fields as $key => $item) echo "<option value='$key'" . ($key == $sort_by ? "selected" : "") . ">$item</option>" ?>
                        </select>
                        <select class="form-select" id="sort-order" name="sort_order">

                            <option value="highest" <?= ($sort_order === "highest" ? "selected" : "") ?>>Highest First</option>
                            <option value="lowest" <?= ($sort_order === "lowest" ? "selected" : "") ?>>Lowest First</option>
                        </select>
                    </div>


                    <button type="submit" id="search" value="submit" class="btn btn-primary btn-sm">Search</button>
                </div>
            </form>
        </div>
        <br>
        <div id="movie_results mt-3">

            <?php
            if ($movies) {
                foreach ($movies as $movie) {
            ?>
                    <div class="card movie_card mb-3">
                        <div class="card-body d-flex">
                            <img class="poster" style="width: 200px; height: 300px" src="<?= $movie['featured_image'] ?>" />
                            <div class="details mx-2">
                                <h4 class="title p-0 m-0"><?= $movie['title'] ?> </h4>
                                <small>
                                    <span class="language">
                                        <b>Language:</b> <?= $movie['lang'] ?></span> <br />
                                    <b>Playtime:</b> <?= $movie['duration_minutes'] ?> Minutes <br />
                                    <b>Genre:</b> <span class="genre"><?= $movie['genre'] ?></span>
                                </small>
                                <p class="description mt-2"><?= $movie['description'] ?></p>


                                <small class="release_date"> <b>Released:</b> <?= $movie['release_date'] ?> </small>
                            </div>

                        </div>
                    </div>

            <?php }
            } else {
                echo "<p class='text-center'> No match found.</p>";
            } ?>
        </div>
        <div id="pagination" class="mb-5 my-3 d-flex flex-column justify-content-center">
            <div class="justify-content-center d-flex">
                <?= $pagination->renderButtons() ?>
            </div>
            <p class="mt-3 text-center">Page <?= $pagination->getCurrentPageNumber() ?> of <?= $pagination->getLastPageNumber() ?></p>
        </div>


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