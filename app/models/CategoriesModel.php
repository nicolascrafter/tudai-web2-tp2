<?php
class CategoriesModel
{
    private $db;
    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=tudai-web2-tp2;charset=utf8', 'root', '');
    }

    public function GetCategories(string $order = "id", string $sort = "asc", int $page = 1, int $size = 0)
    {
        $sentence = null;
        if ($size <= 0) {
            if (mb_strtolower($sort) === "asc") {
                if (mb_strtolower($order) === "id") {
                    $sentence = $this->db->prepare("SELECT * FROM `categories` ORDER BY `id` ASC");
                } elseif (mb_strtolower($order) === "type") {
                    $sentence = $this->db->prepare("SELECT * FROM `categories` ORDER BY `type` ASC");
                } elseif (mb_strtolower($order) === "brand") {
                    $sentence = $this->db->prepare("SELECT * FROM `categories` ORDER BY `brand` ASC");
                }
            } else {
                if (mb_strtolower($order) === "id") {
                    $sentence = $this->db->prepare("SELECT * FROM `categories` ORDER BY `id` DESC");
                } elseif (mb_strtolower($order) === "type") {
                    $sentence = $this->db->prepare("SELECT * FROM `categories` ORDER BY `type` DESC");
                } elseif (mb_strtolower($order) === "brand") {
                    $sentence = $this->db->prepare("SELECT * FROM `categories` ORDER BY `brand` DESC");
                }
            }
        } else {
            if (mb_strtolower($sort) === "asc") {
                if (mb_strtolower($order) === "id") {
                    $sentence = $this->db->prepare("SELECT * FROM `categories` ORDER BY `id` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "type") {
                    $sentence = $this->db->prepare("SELECT * FROM `categories` ORDER BY `type` ASC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "brand") {
                    $sentence = $this->db->prepare("SELECT * FROM `categories` ORDER BY `brand` ASC LIMIT :offset, :size");
                }
            } else {
                if (mb_strtolower($order) === "id") {
                    $sentence = $this->db->prepare("SELECT * FROM `categories` ORDER BY `id` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "type") {
                    $sentence = $this->db->prepare("SELECT * FROM `categories` ORDER BY `type` DESC LIMIT :offset, :size");
                } elseif (mb_strtolower($order) === "brand") {
                    $sentence = $this->db->prepare("SELECT * FROM `categories` ORDER BY `brand` DESC LIMIT :offset, :size");
                }
            }
            $offset = ($page - 1) * $size;
            $sentence->bindParam("offset", $offset, PDO::PARAM_INT);
            $sentence->bindParam("size", $size, PDO::PARAM_INT);
        }
        $sentence->execute();
        return $sentence->fetchAll(PDO::FETCH_OBJ);
    }

    public function GetCategoryById(int $id)
    {
        $sentence = $this->db->prepare("SELECT * FROM categories WHERE id=:id");
        $sentence->bindParam("id", $id, PDO::PARAM_STR);
        $sentence->execute();
        return $sentence->fetch(PDO::FETCH_OBJ);
    }

    public function GetCount()
    {
        $sentence = $this->db->prepare("SELECT COUNT(`id`) AS `count` FROM `categories`");
        $sentence->execute(array());
        return $sentence->fetch(PDO::FETCH_OBJ);
    }

    public function PostCategory(string $tipo, string $marca)
    {
        $sentence = $this->db->prepare("INSERT INTO `categories`(`type`, `brand`) VALUES (?,?)");
        $sentence->execute(array($tipo, $marca));
        $id = $this->db->lastInsertId();
        if (isset($id)) {
            return $this->GetCategoryById(intval($id));
        }
        return false;
    }

    //put

    public function DeleteCategory(int $id)
    {
        $sentence = $this->db->prepare("DELETE FROM `categories` WHERE id=:id");
        $sentence->bindParam("id", $id, PDO::PARAM_STR);
        $sentence->execute();
    }
}
