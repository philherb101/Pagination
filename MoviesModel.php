<?php
class MoviesModel
{
    private $conn = null;
    private $db_name = DB_NAME;
    private $db_host = DB_HOST;
    private $db_user = DB_USER;
    private $db_port = DB_PORT;
    private $db_pass = DB_PASSWORD;

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
    }

    public function filterByLanguage($languages)
    {
        # code...
    }

    public function filterByGenre($genras)
    {
        # code...
    }

    public function exec()
    {
    }

    public function getMoviesWithCategories()
    {
        if ($this->conn === null) {
            return false;
        }
    }
}
