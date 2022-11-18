<?php
require_once "app/models/ProductsModel.php";
require_once "app/models/CategoriesModel.php";
require_once "app/controllers/ApiController.php";
require_once "app/views/JsonView.php";

class ProductsApiController
{

    private $columns;
    private $status;
    private $error;
    private $model;
    private $categories_model;
    private $api_controller;
    private $view;
    private $maxsize;

    public function __construct()
    {
        $this->columns = array("id", "name", "description", "price", "stock", "category_id", "type", "brand");
        $this->status = 200;
        $this->error = new StdClass();
        $this->model = new ProductsModel();
        $this->categories_model = new CategoriesModel();
        $this->api_controller = new ApiController();
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
                $this->error->detail = "Columna no valida";
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
                $this->error->detail = "Sort no valido";
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
                $this->error->detail = "Pagina muy grande";
                $this->error->params = new stdClass();
                $this->error->params->minsize = 0;
                $this->error->params->maxsize = $this->maxsize;
            } elseif (is_numeric($_GET["size"]) && intval($_GET["size"]) < 0) {
                $this->status = 400;
                $this->error->code = "PageTooSmall";
                $this->error->detail = "Pagina muy pequeña";
                $this->error->params = new stdClass();
                $this->error->params->minsize = 0;
                $this->error->params->maxsize = $this->maxsize;
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
                $this->error->detail = "Pagina no valida";
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
        if (isset($params[':ID'])) {
            if (is_numeric($params[":ID"])) {
                $data = $this->model->getProductById(intval($params[":ID"]));
                if ($data === false) {
                    $this->status = 404;
                    $this->error->code = "ProductDoesNotExist";
                    $this->error->detail = "El producto no existe";
                    $this->error->params = new stdClass();
                }
            } else {
                $this->status = 400;
                $this->error->code = "InvalidID";
                $this->error->detail = "ID no valido";
                $this->error->params = new stdClass();
            }
        }

        if ($this->status !== 200) {
            $this->view->response($this->error, $this->status);
        } else {
            $this->view->response($data, $this->status);
        }
    }

    public function getProductsByCategory($params)
    {
        //validacion de id
        if (!is_numeric($params[":ID"])) {
            $this->status = 400;
            $this->error->code = "InvalidID";
            $this->error->detail = "ID no valido";
            $this->error->params = new stdClass();
        } elseif (is_numeric($params[":ID"]) && $this->categories_model->GetCategoryById(intval($params[":ID"])) === false) {
            $this->status = 404;
            $this->error->code = "CategoryDoesNotExist";
            $this->error->detail = "La categoria no existe";
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
                $this->error->detail = "Columna no valida";
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
                $this->error->detail = "Sort no valido";
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
                $this->error->detail = "Pagina muy grande";
                $this->error->params = new stdClass();
                $this->error->params->minsize = 0;
                $this->error->params->maxsize = $this->maxsize;
            } elseif (is_numeric($_GET["size"]) && intval($_GET["size"]) < 0) {
                $this->status = 400;
                $this->error->code = "PageTooSmall";
                $this->error->detail = "Pagina muy pequeña";
                $this->error->params = new stdClass();
                $this->error->params->minsize = 0;
                $this->error->params->maxsize = $this->maxsize;
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
                $this->error->detail = "Pagina no valida";
                $this->error->params = new stdClass();
                $this->error->params->maxpage = $maxpage;
            }
        }

        //enviar datos
        if ($this->status !== 200) {
            $this->view->response($this->error, $this->status);
        } else {
            $this->view->response($this->model->getProductsByCategory($params[":ID"], $order, $sort, intval($page), intval($size)), $this->status);
        }
    }

    public function postProduct($params)
    {
        $data = $this->api_controller->getData();
        $row = false;
        if (
            $data !== null && isset($data->name) && isset($data->description) && isset($data->price) && isset($data->stock) && isset($data->category_id) &&
            is_string($data->name) && is_string($data->description) && is_string($data->price) && is_int($data->stock) && is_int($data->category_id) &&
            strlen($data->name) <= 200 && strlen($data->description) <= 999999999 && preg_match("/^\d{1,8}\.\d{2}$/", $data->price) === 1 && is_int($data->category_id) &&
            $this->categories_model->GetCategoryById($data->category_id) !== false
        ) {
            $row = $this->model->postProduct($data->name, $data->description, $data->price, $data->stock, $data->category_id);
            if ($row === false) {
                $this->status = 500;
                $this->error->code = "FailedPost";
                $this->error->detail = "Categoria no creada";
                $this->error->params = new stdClass();
            } else {
                $this->status = 201;
            }
        } elseif (isset($data->category_id) && is_int($data->category_id) && $this->categories_model->GetCategoryById($data->category_id) === false) {
            $this->status = 400;
            $this->error->code = "CategoryDoesNotExist";
            $this->error->detail = "La categoria no existe";
            $this->error->params = new stdClass();
        } else {
            $this->status = 400;
            $this->error->code = "InvalidPostData";
            $this->error->detail = "Datos no validos";
            $this->error->params = new stdClass();
        }

        if ($this->status === 201) {
            $this->view->response($row, $this->status);
        } else {
            $this->view->response($this->error, $this->status);
        }
    }

    public function putProduct($params)
    {
        $data = $this->api_controller->getData();
        $row = false;
        if (
            $data !== null && isset($data->name) && isset($data->description) && isset($data->price) && isset($data->stock) && isset($data->category_id) &&
            is_string($data->name) && is_string($data->description) && is_string($data->price) && is_int($data->stock) && is_int($data->category_id) &&
            strlen($data->name) <= 200 && strlen($data->description) <= 999999999 && preg_match("/^\d{1,8}\.\d{2}$/", $data->price) === 1 && is_int($data->category_id) &&
            is_numeric($params[":ID"]) && $this->model->getProductById(intval($params[":ID"])) !== false &&
            $this->categories_model->GetCategoryById($data->category_id) !== false
        ) {
            $row = $this->model->putProduct(intval($params[":ID"]), $data->name, $data->description, $data->price, $data->stock, $data->category_id);
            if ($row === false) {
                $this->status = 500;
                $this->error->code = "FailedPost";
                $this->error->detail = "Categoria no creada";
                $this->error->params = new stdClass();
            } else {
                $this->status = 201;
            }
        } elseif (is_numeric($params[":ID"]) && $this->model->getProductById(intval($params[":ID"])) === false) {
            $this->status = 400;
            $this->error->code = "ProductDoesNotExist";
            $this->error->detail = "El producto no existe";
            $this->error->params = new stdClass();
        } elseif (!is_numeric($params[":ID"])) {
            $this->status = 400;
            $this->error->code = "InvalidID";
            $this->error->detail = "ID no valido";
            $this->error->params = new stdClass();
        } elseif (isset($data->category_id) && is_int($data->category_id) && $this->categories_model->GetCategoryById($data->category_id) === false) {
            $this->status = 400;
            $this->error->code = "CategoryDoesNotExist";
            $this->error->detail = "La categoria no existe";
            $this->error->params = new stdClass();
        } else {
            $this->status = 400;
            $this->error->code = "InvalidPutData";
            $this->error->detail = "Datos no validos";
            $this->error->params = new stdClass();
        }

        if ($this->status === 201) {
            $this->view->response($row, $this->status);
        } else {
            $this->view->response($this->error, $this->status);
        }
    }

    public function deleteProduct($params)
    {
        if (is_numeric($params[":ID"])) {
            $data = $this->model->GetProductById(intval($params[":ID"]));
            if ($data === false) {
                $this->status = 404;
                $this->error->code = "CategoryDoesNotExist";
                $this->error->detail = "La categoria no existe";
                $this->error->params = new stdClass();
            } else {
                $this->model->DeleteProduct(intval($params[":ID"]));
            }
        } else {
            $this->status = 400;
            $this->error->code = "InvalidID";
            $this->error->detail = "ID no valido";
            $this->error->params = new stdClass();
        }

        if ($this->status === 200) {
            $this->view->response($data, $this->status);
        } else {
            $this->view->response($this->error, $this->status);
        }
    }
}
