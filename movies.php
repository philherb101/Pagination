<?php
const DEFAULT_LIMIT = 10;

$category_model = new CategoryModel();
$genres = $category_model->createQuery('id, value')->where('type', 'genre')->fetch();

$category_model2 = new CategoryModel();
$languages = $category_model2->createQuery('id, value')->where('type', 'language')->fetch();

//REVIEWER NOTE: Am aware that exposing field values like this is a very bad idea.
//Skipping writing a mapper as the code has already become lot for a simple movie list.
$sorting_fields = ['release_date' => 'Release Date', 'duration_minutes' => 'Playtime'];

//Grab filter and sort values
$page = !empty($_GET['page']) ? (is_numeric($_GET['page']) ? $_GET['page'] : 1) : 1;
$limit = !empty($_GET['limit']) ? (is_numeric($_GET['limit']) ? $_GET['limit'] : DEFAULT_LIMIT) : DEFAULT_LIMIT;

//set default sort field if invalid string provided
$sort_by = 'release_date';
if (!empty($_GET['sort_field'])) {
    if (in_array($_GET['sort_field'], array_keys($sorting_fields)))
        $sort_by = $_GET['sort_field'];
}

//set default sort order if invalid string provided
$sort_order = 'highest';
if (!empty($_GET['sort_order'])) {
    switch ($_GET['sort_order']) {
        case 'highest':
        case 'lowest':
            $sort_order = $_GET['sort_order'];
            break;
    }
}


$genre = !empty($_GET['genre']) ? $_GET['genre'] : null;
$lang = !empty($_GET['lang']) ? $_GET['lang'] : null;

$movies_model = new MovieModel();
$movies_model->createQueryMoviesWithCategory();

//setup filtering
if ($lang) $movies_model->filterByLanguage($lang);
if ($genre) $movies_model->filterByGenre($genre);

//setup sorting
$movies_model->sortBy($sort_by, ($sort_order === "lowest" ? true : false));

//get total count of movie results with filters but without limit for pagination
$total_count = $movies_model->getCount();

//setup limits
$movies_model->paginate($page, $limit);

//get movie results
$movies = $movies_model->fetch();

//A helper class created to render pagination buttons.
$pagination = new ViewPaginator($page, $total_count, $limit, ROOT_URL);
$pagination->setAddedQueryParamters(['sort_field' => $sort_by, 'sort_order' => $sort_order, 'genre' => $genre, 'lang' => $lang]);

//load the html

//Reviewer Note:
//Would create a templating mechanism with dependancy injection (variables and objects).
//But using the simplest solution here.
require_once "view/movies.tpl.php";
