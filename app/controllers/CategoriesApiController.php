<?php
require_once 'app/controllers/ApiController.php';
require_once "app/models/CategoriesModel.php";
require_once "app/models/ProductsModel.php";
require_once "app/views/JsonView.php";

class CategoriesApiController
{

    private $columns;
    private $status;
    private $error;
    private $model;
    private $productsModel;
    private $view;
    private $apiController;
    private $maxsize;

    public function __construct()
    {
        $this->columns = array("id", "type", "brand");
        $this->status = 200;
        $this->error = new StdClass();
        $this->model = new CategoriesModel();
        $this->productsModel = new ProductsModel();
        $this->view = new JsonView();
        $this->apiController = new ApiController();
        $this->maxsize = 2147483647; //usar 9223372036854775807 en produccion y compus de 64 bits
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
            $this->view->response($this->model->getCategories($order, $sort, intval($page), intval($size)), $this->status);
        }
    }

    public function getCategoryById($params)
    {
        if (isset($params[':ID'])) {
            if (is_numeric($params[":ID"])) {
                $data = $this->model->getCategoryById(intval($params[":ID"]));
                if ($data === false) {
                    $this->status = 404;
                    $this->error->code = "CategoryDoesNotExist";
                    $this->error->detail = "La categoria no existe";
                    $this->error->params = new stdClass();
                }
            } else {
                $this->status = 400;
                $this->error->code = "InvalidID";
                $this->error->detail = "ID no valido";
                $this->error->params = new stdClass();
            }
        }

        // vista
        if ($this->status !== 200) {
            $this->view->response($this->error, $this->status);
        } else {
            $this->view->response($data, $this->status);
        }
    }

    public function postCategory($params)
    {
        $data = $this->apiController->getData();
        $row = false;
        if (
            $data !== null && !empty($data->type) && !empty($data->brand) &&
            is_string($data->type) && is_string($data->brand) &&
            strlen($data->type) <= 100 && strlen($data->brand) <= 100
        ) {
            $row = $this->model->postCategory($data->type, $data->brand);
            if ($row === false) {
                $this->status = 500;
                $this->error->code = "FailedPost";
                $this->error->detail = "Categoria no creada";
                $this->error->params = new stdClass();
            } else {
                $this->status = 201;
            }
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

    public function putCategory($params)
    {
        $data = $this->apiController->getData();
        $row = false;
        if (
            $data !== null && !empty($data->type) && !empty($data->brand) &&
            is_string($data->type) && is_string($data->brand) &&
            is_numeric($params[":ID"]) && $this->model->getCategoryById(intval($params[":ID"])) !== false &&
            strlen($data->type) <= 100 && strlen($data->brand) <= 100
        ) {
            $row = $this->model->putCategory(intval($params[":ID"]), $data->type, $data->brand);
            if ($row === false) {
                $this->status = 500;
                $this->error->code = "FailedPost";
                $this->error->detail = "Categoria no creada";
                $this->error->params = new stdClass();
            } else {
                $this->status = 201;
            }
        } elseif (is_numeric($params[":ID"]) && $this->model->getCategoryById(intval($params[":ID"])) === false) {
            $this->status = 400;
            $this->error->code = "CategoryDoesNotExist";
            $this->error->detail = "La categoria no existe";
            $this->error->params = new stdClass();
        } elseif (!is_numeric($params[":ID"])) {
            $this->status = 400;
            $this->error->code = "InvalidID";
            $this->error->detail = "ID no valido";
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

    public function deleteCategory($params)
    {
        if (is_numeric($params[":ID"])) {
            $data = $this->model->getCategoryById(intval($params[":ID"]));
            if ($data === false) {
                $this->status = 404;
                $this->error->code = "CategoryDoesNotExist";
                $this->error->detail = "La categoria no existe";
                $this->error->params = new stdClass();
            } elseif (count($this->productsModel->getProductsByCategory(intval($params[":ID"]))) > 0) {
                $this->status = 400;
                $this->error->code = "ConflictingItems";
                $this->error->detail = "Hay productos en la categoria";
                $this->error->params = new stdClass();
            } else {
                $this->model->deleteCategory(intval($params[":ID"]));
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
