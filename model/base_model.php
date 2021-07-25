<?php
require_once "base_model.php";

/**
 * Undocumented class
 */
class BaseModel
{
    private $conn = null;
    private $db_name = DB_NAME;
    private $db_host = DB_HOST;
    private $db_user = DB_USER;
    private $db_port = DB_PORT;
    private $db_pass = DB_PASSWORD;

    protected $join;
    protected $where;
    protected $order;
    protected $limit;
    protected $having;
    protected $query;
    protected $group_by;

    protected $param_key_incrementor = 0;
    protected $parameters = [];

    protected $TABLE_NAME;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name;port=$this->db_port", $this->db_user, $this->db_pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //Being silent here for no reason
        }
    }

    public function createQuery($select_fields = null)
    {
        $select = "*";
        if ($select_fields) {
            if (is_array($select_fields) && !empty($select_fields)) {
                foreach ($select_fields as $field) {
                    if (!empty($field))
                        $select .= " $field";
                }
            } else if (is_string($select_fields) && !empty($select_fields))
                $select = $select_fields;
        }

        $this->query = "SELECT $select FROM $this->TABLE_NAME";
        return $this;
    }

    public function sortBy($field, $asc = false)
    {
        # code...
        $this->order = " ORDER BY $field " . ($asc ? "ASC" : "DESC");
        return $this;
    }

    public function limit($offset, $count)
    {
        $this->limit = " LIMIT $offset, $count";
        return $this;
    }

    public function where($field, $value, $operator = "=")
    {
        $where = "$field $operator " . $this->_parameterize($value);
        $this->_setWhere($where);
        return $this;
    }

    /**
     * Executes the built query with one of the createQuery[X] methods and other query binding methods.
     * returns count of the total row without using order and limit.
     * 
     * Throws an Exception if invalid query string is foiund.
     * @return int
     */
    public function getCount()
    {
        # code...
        if ($this->conn === null) {
            return false;
        }

        if ($this->query == null) {
            throw new Exception('Null query string. Please use createQueryX methods to build a query');
        }

        $query = $this->query . $this->join . $this->where . $this->group_by . $this->having;

        $stmt = $this->conn->prepare($query);
        $stmt->execute($this->parameters ? $this->parameters : null);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->rowCount();
    }

    /**
     * Executes the built query with one of the createQuery[X] methods and other query binding methods.
     * returns result as an associative array.
     * 
     * Throws an Exception if invalid query string is foiund.
     * @return Array on success. false on failure
     */
    public function fetch()
    {
        if ($this->conn === null) {
            return false;
        }
        if ($this->query == null) {

            throw new Exception('Null query string. Please use createQueryX methods to build a query');
        }

        try {
            $query = $this->query . $this->join . $this->where . $this->group_by . $this->having . $this->order . $this->limit;

            //echo $query;
            $stmt = $this->conn->prepare($query);
            $stmt->execute($this->parameters ? $this->parameters : null);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            throw $e;
        }
    }


    protected function _setWhere($condition_string)
    {
        if ($this->where)
            $this->where .= " AND " . $condition_string;
        else
            $this->where = " WHERE " . $condition_string;
    }

    protected function _setHaving($condition_string)
    {
        # code...
        if ($this->having)
            $this->having .= " AND " . $condition_string;
        else
            $this->having = " HAVING " . $condition_string;
    }

    /**
     * Creates a new parameter key for PDO like ikey0, ikey1 ... and binds the passed value to that key.
     * retuns the key to use in the query as placeholder.
     *
     * @param string $value
     * @return string
     */
    protected function _parameterize($value)
    {
        $this->parameters["ikey" . ++$this->param_key_incrementor] = $value;
        return ":" . "ikey" . $this->param_key_incrementor;
    }
}
