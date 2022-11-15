<?php
require_once "app/models/ProductsModel.php";
require_once "app/models/CategoriesModel.php";
require_once "app/views/JsonView.php";

class ProductsApiController {

    private $columns;
    private $status;
    private $error;
    private $model;
    private $categories_model;
    private $view;
    private $maxsize;

    public function __construct()
    {
        $this->columns = array("id", "name", "description", "price", "stock", "fk_category", "category_id", "type", "brand");
        $this->status = 200;
        $this->error = new StdClass();
        $this->model = new ProductsModel();
        $this->categories_model = new CategoriesModel();
        $this->view = new JsonView();
        $this->maxsize = 2147483647; //usar 9223372036854775807 en produccion y compus de 64 bits
    }

    public function getProducts()
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

        //size, valor por defecto = 0
        $size = 0;
        if (isset($_GET["size"])) {
            if (is_numeric($_GET["size"]) && intval($_GET["size"]) > $this->maxsize) {
                $this->status = 400;
                $this->error->code = "PageTooLarge";
                $this->error->detail = "Pagina Muy Grande";
                $this->error->params = new stdClass();
                $this->error->params->minsize = 0;
                $this->error->params->maxsize = 100;
            } elseif(is_numeric($_GET["size"]) && intval($_GET["size"]) < 0) {
                $this->status = 400;
                $this->error->code = "PageTooSmall";
                $this->error->detail = "Pagina Muy Pequeña";
                $this->error->params = new stdClass();
                $this->error->params->minsize = 0;
                $this->error->params->maxsize = 100;
            } elseif (is_numeric($_GET["size"]) && intval($_GET["size"]) >= 0 && intval($_GET["size"]) <= $this->maxsize) {
                $size = intval($_GET["size"]);
            } else {
                $this->status = 400;
                $this->error->code = "InvalidPageSize";
                $this->error->detail = "Tamaño de pagina no valido";
                $this->error->params = new stdClass();
                $this->error->params->minsize = 0;
                $this->error->params->maxsize = $this->maxsize;
            }
        }

        //page, valor por defecto = 1
        $page = 1;
        $count = intval($this->model->GetCount()->count);
        if ($size === 0) {
            $maxpage = 1;
        } else {
            $maxpage = ceil($count / $size);
        }
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
            $this->view->response($this->model->getProducts($order, $sort, intval($page), intval($size)), $this->status);
        }
    }

    public function getProductById($params)
    {
        echo "Un solo producto";
    }

    public function getProductsByCategory($params)
    {
        //validacion de id
        var_dump($this->categories_model->GetCategoryById(intval($params[":ID"])));
        if (is_numeric($params[":ID"]) && $this->categories_model->GetCategoryById(intval($params[":ID"])) !== false) {} else {
            $status = 400;
            $this->status = 400;
                $this->error->code = "InvalidCategory";
                $this->error->detail = "Categoria No Valida";
                $this->error->params = new stdClass();
        }

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

        //size, valor por defecto = 0
        $size = 0;
        if (isset($_GET["size"])) {
            if (is_numeric($_GET["size"]) && intval($_GET["size"]) > $this->maxsize) {
                $this->status = 400;
                $this->error->code = "PageTooLarge";
                $this->error->detail = "Pagina Muy Grande";
                $this->error->params = new stdClass();
                $this->error->params->minsize = 0;
                $this->error->params->maxsize = 100;
            } elseif(is_numeric($_GET["size"]) && intval($_GET["size"]) < 0) {
                $this->status = 400;
                $this->error->code = "PageTooSmall";
                $this->error->detail = "Pagina Muy Pequeña";
                $this->error->params = new stdClass();
                $this->error->params->minsize = 0;
                $this->error->params->maxsize = 100;
            } elseif (is_numeric($_GET["size"]) && intval($_GET["size"]) >= 0 && intval($_GET["size"]) <= $this->maxsize) {
                $size = intval($_GET["size"]);
            } else {
                $this->status = 400;
                $this->error->code = "InvalidPageSize";
                $this->error->detail = "Tamaño de pagina no valido";
                $this->error->params = new stdClass();
                $this->error->params->minsize = 0;
                $this->error->params->maxsize = $this->maxsize;
            }
        }

        //page, valor por defecto = 1
        $page = 1;
        $count = intval($this->model->GetCount()->count);
        if ($size === 0) {
            $maxpage = 1;
        } else {
            $maxpage = ceil($count / $size);
        }
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
            $this->view->response($this->model->getProductsByCategory($params[":ID"],$order, $sort, intval($page), intval($size)), $this->status);
        }
    }

    public function postProduct($params)
    {
        echo "postProduct";
    }

    public function putProduct($params)
    {
        echo "putProduct";
    }

    public function deleteProduct($params)
    {
        if (is_numeric($params[":ID"])) {
            $data = $this->model->GetProductById(intval($params[":ID"]));
            if ($data === false) {
                $this->status = 404;
                $this->error->code = "CategoryDoesNotExist";
                $this->error->detail = "La Categoria No Existe";
                $this->error->params = new stdClass();
            } else {
                $this->model->DeleteProduct(intval($params[":ID"]));
            }
        } else {
            $this->status = 400;
            $this->error->code = "InvalidID";
            $this->error->detail = "ID No Valido";
            $this->error->params = new stdClass();
        }

        if ($this->status === 200) {
            $this->view->response($data, $this->status);
        } else {
            $this->view->response($this->error, $this->status);
        }
    }
}