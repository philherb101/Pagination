<?php
require_once "base_model.php";

class CategoryModel extends BaseModel
{
    function __construct()
    {
        parent::__construct();
        $this->TABLE_NAME = "categories";
    }
}
