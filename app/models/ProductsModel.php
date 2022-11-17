<?php
class ProductsModel
{
    private $db;
    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=tudai-web2-tp2;charset=utf8', 'root', '');
    }

    public function GetProducts(string $order = "id", string $sort = "asc", int $page = 1, int $size = 0)
    {
        $sentence = null;
        if ($size <= 0) {
            if (mb_strtolower($sort) === "asc") {
                if (mb_strtolower($order) === "id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `id` ASC");
                } elseif (mb_strtolower($order) === "name") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `name` ASC");
                } elseif (mb_strtolower($order) === "description") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `description` ASC");
                } elseif (mb_strtolower($order) === "price") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `price` ASC");
                } elseif (mb_strtolower($order) === "stock") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `stock` ASC");
                } elseif (mb_strtolower($order) === "fk_category") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `fk_category` ASC");
                } elseif (mb_strtolower($order) === "category_id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `category_id` ASC");
                } elseif (mb_strtolower($order) === "type") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `type` ASC");
                } elseif (mb_strtolower($order) === "brand") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `brand` ASC");
                }
            } else {
                if (mb_strtolower($order) === "id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `id` DESC");
                } elseif (mb_strtolower($order) === "name") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `name` DESC");
                } elseif (mb_strtolower($order) === "description") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `description` DESC");
                } elseif (mb_strtolower($order) === "price") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `price` DESC");
                } elseif (mb_strtolower($order) === "stock") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `stock` DESC");
                } elseif (mb_strtolower($order) === "fk_category") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `fk_category` DESC");
                } elseif (mb_strtolower($order) === "category_id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `category_id` DESC");
                } elseif (mb_strtolower($order) === "type") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `type` DESC");
                } elseif (mb_strtolower($order) === "brand") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `brand` DESC");
                }
            }
        } else {
            if (mb_strtolower($sort) === "asc") {
                if (mb_strtolower($order) === "id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `id` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "name") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `name` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "description") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `description` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "price") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `price` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "stock") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `stock` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "fk_category") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `fk_category` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "category_id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `category_id` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "type") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `type` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "brand") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `brand` ASC LIMIT :offset, :size");
                }
            } else {
                if (mb_strtolower($order) === "id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `id` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "name") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `name` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "description") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `description` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "price") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `price` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "stock") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `stock` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "fk_category") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `fk_category` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "category_id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `category_id` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "type") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `type` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "brand") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id ORDER BY `brand` DESC LIMIT :offset, :size");
                }
            }
            $offset = ($page - 1) * $size;
            $sentence->bindParam("offset", $offset, PDO::PARAM_INT);
            $sentence->bindParam("size", $size, PDO::PARAM_INT);
        }
        $sentence->execute();
        return $sentence->fetchAll(PDO::FETCH_OBJ);
    }

    public function getProductsByCategory(string $category_id, string $order = "id", string $sort = "asc", int $page = 1, int $size = 0)
    {
        $sentence = null;
        if ($size <= 0) {
            if (mb_strtolower($sort) === "asc") {
                if (mb_strtolower($order) === "id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `id` ASC");
                } elseif (mb_strtolower($order) === "name") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `name` ASC");
                } elseif (mb_strtolower($order) === "description") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `description` ASC");
                } elseif (mb_strtolower($order) === "price") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `price` ASC");
                } elseif (mb_strtolower($order) === "stock") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `stock` ASC");
                } elseif (mb_strtolower($order) === "fk_category") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `fk_category` ASC");
                } elseif (mb_strtolower($order) === "category_id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `category_id` ASC");
                } elseif (mb_strtolower($order) === "type") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `type` ASC");
                } elseif (mb_strtolower($order) === "brand") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `brand` ASC");
                }
            } else {
                if (mb_strtolower($order) === "id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `id` DESC");
                } elseif (mb_strtolower($order) === "name") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `name` DESC");
                } elseif (mb_strtolower($order) === "description") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `description` DESC");
                } elseif (mb_strtolower($order) === "price") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `price` DESC");
                } elseif (mb_strtolower($order) === "stock") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `stock` DESC");
                } elseif (mb_strtolower($order) === "fk_category") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `fk_category` DESC");
                } elseif (mb_strtolower($order) === "category_id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `category_id` DESC");
                } elseif (mb_strtolower($order) === "type") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `type` DESC");
                } elseif (mb_strtolower($order) === "brand") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `brand` DESC");
                }
            }
        } else {
            if (mb_strtolower($sort) === "asc") {
                if (mb_strtolower($order) === "id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `id` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "name") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `name` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "description") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `description` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "price") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `price` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "stock") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `stock` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "fk_category") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `fk_category` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "category_id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `category_id` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "type") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `type` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "brand") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `brand` ASC LIMIT :offset, :size");
                }
            } else {
                if (mb_strtolower($order) === "id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `id` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "name") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `name` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "description") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `description` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "price") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `price` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "stock") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `stock` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "fk_category") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `fk_category` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "category_id") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `category_id` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "type") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `type` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "brand") {
                    $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE fk_category = :id_category ORDER BY `brand` DESC LIMIT :offset, :size");
                }
            }
            $offset = ($page - 1) * $size;
            $sentence->bindParam("offset", $offset, PDO::PARAM_INT);
            $sentence->bindParam("size", $size, PDO::PARAM_INT);
        }
        $sentence->bindParam("id_category", $category_id, PDO::PARAM_STR);
        $sentence->execute();
        return $sentence->fetchAll(PDO::FETCH_OBJ);
    }

    public function GetProductById(int $id)
    {
        $sentence = $this->db->prepare("SELECT products.id, products.name, products.description, products.price, products.stock, categories.id AS category_id, categories.type, categories.brand FROM products JOIN categories ON products.fk_category = categories.id WHERE products.id = :id");
        $sentence->bindParam("id", $id, PDO::PARAM_STR);
        $sentence->execute();
        return $sentence->fetch(PDO::FETCH_OBJ);
    }

    public function GetCount()
    {
        $sentence = $this->db->prepare("SELECT COUNT(`id`) AS `count` FROM `products`");
        $sentence->execute(array());
        return $sentence->fetch(PDO::FETCH_OBJ);
    }

    public function PostProduct(string $name, string $description, string $price, int $stock, int $category_id)
    {
        $sentence = $this->db->prepare("INSERT INTO `products`(`name`, `description`, `price`, `stock`, `fk_category`) VALUES (:name,:description,:price,:stock,:category_id)");
        $sentence->bindParam(":name", $name, PDO::PARAM_STR);
        $sentence->bindParam(":description", $description, PDO::PARAM_STR);
        $sentence->bindParam(":price", $price, PDO::PARAM_STR);
        $sentence->bindParam(":stock", $stock, PDO::PARAM_STR);
        $sentence->bindParam(":category_id", $category_id, PDO::PARAM_STR);
        $sentence->execute();
        $id = $this->db->lastInsertId();
        if (isset($id)) {
            return $this->GetProductById(intval($id));
        }
        return false;
    }

    public function PutProduct(int $id, string $name, string $description, string $price, int $stock, int $category_id)
    {
        $sentence = $this->db->prepare("UPDATE `products` SET `name`=:name,`description`=:description,`price`=:price,`stock`=:stock,`fk_category`=:category_id WHERE id=:id");
        $sentence->bindParam(":id", $id, PDO::PARAM_STR);
        $sentence->bindParam(":name", $name, PDO::PARAM_STR);
        $sentence->bindParam(":description", $description, PDO::PARAM_STR);
        $sentence->bindParam(":price", $price, PDO::PARAM_STR);
        $sentence->bindParam(":stock", $stock, PDO::PARAM_STR);
        $sentence->bindParam(":category_id", $category_id, PDO::PARAM_STR);
        $sentence->execute();
        if (isset($id)) {
            return $this->GetProductById(intval($id));
        }
        return false;
    }

    public function DeleteProduct(int $id)
    {
        $sentence = $this->db->prepare("DELETE FROM `products` WHERE id=:id");
        $sentence->bindParam("id", $id, PDO::PARAM_STR);
        $sentence->execute();
    }
}
