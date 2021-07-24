<?php


class Paginator
{
    private $page_number;
    private $total_count;
    private $per_page_count;

    public function __construct()
    {
        # code...
    }

    public function setTotalItemsCount($count)
    {
        # code...
    }

    public function setPageNumber($page_number)
    {
        return $this;
    }

    public function setItemsPerPage($count)
    {
        return $this;
    }

    public function setQueryParamters($paramters)
    {
        return $this;
    }


    public function getPageNumber()
    {
    }

    public function getNextPageNumber()
    {
    }

    public function getPreviousPageNumber()
    {
    }

    public function renderButtons()
    {
        echo '<div class="btn-group" role="group" aria-label="First group">
        <button type="button" class="btn btn-outline-secondary">1</button>
        <button type="button" class="btn btn-outline-secondary">2</button>
        <button type="button" class="btn btn-outline-secondary">3</button>
        <button type="button" class="btn btn-outline-secondary">4</button>
      </div>';
    }
}
