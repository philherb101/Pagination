<?php
require "base_model.php";
class MovieModel extends BaseModel
{
    function __construct()
    {
        parent::__construct();
        $this->TABLE_NAME = "movies";
    }

    public function paginate($page_number, $per_page)
    {
        $this->limit($per_page * ($page_number - 1), $per_page);
        return $this;
    }

    public function filterByLanguage($language)
    {
        # code...
        $cond = " lang LIKE " . $this->_parameterize("%$language%");
        $this->_setHaving($cond);
        return $this;
    }

    public function filterByCategoryIds($ids_array)
    {
    }

    public function filterByGenre($genre)
    {
        # code...
        $cond = " genre LIKE " . $this->_parameterize("%$genre%");
        $this->_setHaving($cond);
        return $this;
    }

    public function filterByTitle($title)
    {
        $this->where("title", $title);
    }

    public function createQueryMoviesWithCategory()
    {
        $this->query = "SELECT 
        movies.*, 
        GROUP_CONCAT(CASE WHEN categories.type = 'genre' THEN categories.value ELSE NULL END) genre, 
        GROUP_CONCAT(CASE WHEN categories.type = 'language' THEN categories.value ELSE NULL END) lang   
        FROM movies";

        $this->join = " LEFT JOIN rel_movie_categories on movies.id = rel_movie_categories.movie_id
        LEFT JOIN categories on rel_movie_categories.category_id = categories.id";

        $this->group_by = " GROUP BY movies.id";

        return $this;
    }
}
