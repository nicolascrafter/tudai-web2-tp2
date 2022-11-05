<?php
class ProductsApiController {
    public function getProducts()
    {
        echo "Todas los productos";
    }

    public function getProductById($id)
    {
        echo "Un solo producto";
    }

    public function getProductsByCategory($id)
    {
        echo "Productos por categoria";
    }

    public function postProduct($id)
    {
        echo "postProduct";
    }

    public function putProduct($id)
    {
        echo "putProduct";
    }

    public function deleteProduct($id)
    {
        echo "deleteProduct";
    }
}