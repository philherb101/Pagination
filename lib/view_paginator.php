<?php

class ViewPaginator
{

    /**
     * Number of the curernt page the server is rendering.
     *
     * @var int
     */
    private $page_number;

    /**
     * Total count of results that are available for paginating
     *
     * @var int
     */
    private $total_count;

    /**
     * Number of results rendered per page.
     *
     * @var int
     */
    private $per_page_count;

    /**
     * Html markup for rendering pagination buttons.
     *
     * @var string
     */
    private $pagination_buttons_html;

    /**
     * Http query parameters that may result from form submission for filter and sorting excluding the page and limit paramter.
     *
     * @var array
     */
    private $added_parameters;


    /**
     * Query Sting parameters generated from $added_parameters
     *
     * @var string
     */
    private $added_query_string;


    /**
     * Hmmm. what can I write here.
     *
     * @param int $page_number
     * @param int $total_count
     * @param int $per_page_count
     */
    public function __construct($page_number, $total_count, $per_page_count)
    {
        # code...
        $this->total_count = $total_count;
        $this->page_number = $page_number;
        $this->per_page_count = $per_page_count;
    }

    /**
     * Set the total count of results that are available for paginating.
     *
     * @param int $count
     * @return $this;
     */
    public function setTotalItemsCount($count)
    {
        # code...
        $this->total_count = $count;
        return $this;
    }

    /**
     * Set number of the current page being rendered.
     *
     * @param int $page_number
     * @return $this
     */
    public function setPageNumber($page_number)
    {
        $this->page_number = $page_number;
        return $this;
    }

    /**
     * Set number of items being shown on the page.
     *
     * @param int $count
     * @return $this
     */
    public function setItemsPerPage($count)
    {
        $this->per_page_count = $count;
        return $this;
    }

    /**
     * set http query parameters that may result from form submission for filter and sorting excluding the page and limit paramter.
     *
     * @param array $paramters
     * @return void
     */
    public function setAddedQueryParamters($paramters)
    {
        $this->added_parameters = $paramters;
        $this->added_query_string = urldecode(http_build_query($this->added_parameters));
        return $this;
    }


    public function getCurrentPageNumber()
    {
        return $this->page_number;
    }

    public function getNextPageNumber()
    {
        return $this->page_number + 1;
    }

    public function getLastPageNumber()
    {
        return ceil($this->total_count / $this->per_page_count);
    }

    public function getPreviousPageNumber()
    {
        return $this->page_number - 1;
    }


    //Reviewer Note: Harcoding html here does make this module unusable for other purposes.
    //would write a good module api to allow for customizing of buttons etc.

    /**
     * Builds a string of paginated buttons along with next page, last page, previous page and first page.
     * @return void
     */
    public function createPagination()
    {
        $first_page = 1;
        $last_page = $this->getLastPageNumber();
        $next_page = $this->getNextPageNumber();
        $previous_page = $this->getPreviousPageNumber();

        $url = "/movies/index.php?";
        $added_query_string = $this->added_query_string;

        if ($last_page > 1) {

            $this->pagination_buttons_html = '<div class="btn-group" role="group">';

            if ($this->page_number > $first_page) {
                $this->pagination_buttons_html .= '<a href="' . $url . "&limit=" . $this->per_page_count . '&' . $added_query_string . '&page=' . $first_page . '" class="btn btn-secondary ' . '' . '" >' . '<<' . '</a>';
                $this->pagination_buttons_html .= '<a href="' . $url . "&limit=" . $this->per_page_count . '&' . $added_query_string . '&page=' . ($previous_page) . '" class="btn btn-secondary ' . '' . '" >' . '<' . '</a>';
            }

            for ($page = $first_page; $page <= $last_page; $page++) {

                //display at most five page number buttons. two on left and two on right of the current page.
                //else large data set would create a very long list of buttons.
                if (($page >= $this->page_number - 2 && $page <= $this->page_number + 2) || ($page >= $last_page - 4 && $page <= $first_page + 4)) {
                    $active = $page == $this->page_number ? 'active' : '';
                    $this->pagination_buttons_html .= '<a href="' . $url . "&limit=" . $this->per_page_count . '&' . $added_query_string . '&page=' . $page . '" class="btn btn-secondary ' . $active . '" >' . $page . '</a>';
                }
            }

            if ($this->page_number < $last_page) {

                $this->pagination_buttons_html .= '<a href="' . $url . "&limit=" . $this->per_page_count . '&' . $added_query_string . '&page=' . ($next_page) . '" class="btn btn-secondary ' . '' . '" >' . '>' . '</a>';
                $this->pagination_buttons_html .= '<a href="' . $url . "&limit=" . $this->per_page_count . '&' . $added_query_string . '&page=' . ($last_page) . '" class="btn btn-secondary ' . '' . '" >' . '>>' . '</a>';
            }

            $this->pagination_buttons_html .= "</div>";
        }
    }

    public function getPaginatedButtons()
    {
    }

    public function renderButtons()
    {
        $this->createPagination();
        echo $this->pagination_buttons_html;
    }
}
