<?php
class MoviesModel
{
    private $conn = null;
    private $db_name = DB_NAME;
    private $db_host = DB_HOST;
    private $db_user = DB_USER;
    private $db_port = DB_PORT;
    private $db_pass = DB_PASSWORD;


    private $select;
    private $join;
    private $where;
    private $order;
    private $limit;
    private $having;

    public function __construct()
    {
        //REVIEWER NOTE: 
        //DB connection would probably be handled in a base model which would be extended by this and other model classes in a real project.
        //adding it here since i am creating only one model class

        try {
            $this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name;port=$this->db_port", $this->db_user, $this->db_pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //Being silent here for no reason
        }
    }

    /**
     * Add filters
     *
     * @param [string] $field
     * @param [type] $value
     * @return void
     */
    public function setFilter($field, $value)
    {
        # code...
    }

    public function sortBy($field, $asc = false)
    {
        # code...
        $this->order = " ORDER BY $field " . ($asc ? "ASC" : "DESC");
        return $this;
    }

    public function paginate($page_number, $per_page)
    {
        $this->limit($per_page * ($page_number - 1), $per_page);
        return $this;
    }

    public function limit($offset, $count)
    {
        $this->limit = " LIMIT $offset, $count";
        return $this;
    }

    public function filterByLanguage($language)
    {
        # code...
        $cond = " lang LIKE '%$language%'";
        $this->_setHaving($cond);
        return $this;
    }

    public function filterByGenre($genre)
    {
        # code...
        $cond = " genre LIKE '%$genre%'";
        $this->_setHaving($cond);
        return $this;
    }

    public function exec()
    {
    }

    private function _setHaving($condition_string)
    {
        # code...
        if ($this->having)
            $this->having .= " AND " . $condition_string;
        else
            $this->having = " HAVING " . $condition_string;
    }

    public function getMoviesWithCategories()
    {
        if ($this->conn === null) {
            return false;
        }

        $query = "SELECT 
        movies.*, 
        GROUP_CONCAT(CASE WHEN categories.type = 'genre' THEN categories.value ELSE NULL END) genre, 
        GROUP_CONCAT(CASE WHEN categories.type = 'language' THEN categories.value ELSE NULL END) lang   
        FROM movies 
        LEFT JOIN rel_movie_categories on movies.id = rel_movie_categories.movie_id
        LEFT JOIN categories on rel_movie_categories.category_id = categories.id
        GROUP BY movies.id" .
            $this->having .
            $this->order .
            $this->limit;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}
