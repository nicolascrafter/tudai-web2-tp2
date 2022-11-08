<?php
require_once "app/models/CategoriesModel.php";
require_once "app/views/JsonView.php";

class CategoriesApiController
{

    private $columns;
    private $status;
    private $error;
    private $model;
    private $view;

    public function __construct()
    {
        $this->columns = array("id", "type", "brand");
        $this->status = 200;
        $this->error = new StdClass();
        $this->model = new CategoriesModel();
        $this->view = new JsonView();
    }

    public function getCategories()
    {
        //order, valor por defecto = id
        $order = "id";
        if (isset($_GET["order"])) {
            if (in_array(mb_strtolower($_GET["order"]), $this->columns)) {
                $order = $_GET["order"];
            } else {
                $this->status = 400;
                $this->error->code = "InvalidColumn";
                $this->error->detail = "Columna No Valida";
                $this->error->params = new stdClass();
                $this->error->params->columns = $this->columns;
            }
        }
        //sort, valor por defecto = asc
        $sort = "asc";
        if (isset($_GET["sort"])) {
            if (mb_strtolower($_GET["sort"]) === "asc" || mb_strtolower($_GET["sort"]) === "desc") {
                $sort = $_GET["sort"];
            } else {
                $this->status = 400;
                $this->error->code = "InvalidSort";
                $this->error->detail = "Sort No Valido";
                $this->error->params = new stdClass();
                $this->error->params->sorts = array("asc", "desc");
            }
        }

        //size, valor por defecto = 100
        $size = 100;
        if (isset($_GET["size"])) {
            if (is_numeric($_GET["size"]) && intval($_GET["size"]) >= 1 && intval($_GET["size"]) <= 100) {
                $size = $_GET["size"];
            } else {
                $this->status = 400;
                $this->error->code = "PageTooLarge";
                $this->error->detail = "Pagina Muy Grande";
                $this->error->params = new stdClass();
                $this->error->params->maxsize = 100;
            }
        }

        //page, valor por defecto = 1
        $page = 1;
        $count = intval($this->model->GetCount()->count);
        $maxpage = ceil($count / $size);
        if (isset($_GET["page"])) {
            if (is_numeric($_GET["page"]) && intval($_GET["page"]) >= 1 && intval($_GET["page"]) <= $maxpage) {

                $page = $_GET["page"];
            } else {
                $this->status = 400;
                $this->error->code = "InvalidPage";
                $this->error->detail = "Pagina No Valida";
                $this->error->params = new stdClass();
                $this->error->params->maxpage = $maxpage;
            }
        }

        //enviar datos
        if ($this->status !== 200) {
            $this->view->response($this->error, $this->status);
        } else {
            $this->view->response($this->model->getCategories($order, $sort, intval($page), intval($size)), $this->status);
        }
    }

    public function getCategoryById($params)
    {
        echo "Una sola categoria<br>";
    }

    public function postCategory($params)
    {
        echo "postCategory";
    }

    public function putCategory($params)
    {
        echo "putCategory";
    }

    public function deleteCategory($params)
    {
        echo "deleteCategory";
    }
}
