<?php
class CategoriesApiController {

    private $columns = array("id", "type", "brand");
    private $status = 200;

    public function getCategories()
    {
        echo "Todas las categories";
        if (!empty($_GET["order"])) {
            echo "Orden<br>";
            $order = "id";
            if (isset($_GET["order"])) {
                in_array($_GET["order"], $this->columns) ? $order = $_GET["order"] : $status = 400;
                var_dump($order);
            }
        }
    }

    public function getCategoryById($id)
    {
        echo "Una sola categoria<br>";
    }

    public function postCategory($id)
    {
        echo "postCategory";
    }

    public function putCategory($id)
    {
        echo "putCategory";
    }

    public function deleteCategory($id)
    {
        echo "deleteCategory";
    }
}