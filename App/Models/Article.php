<?php

namespace App\Models;

use PDOException;

class Article extends \Core\Model
{
    public static function getAll($limit = 0)
    {
        try {
            $db = static::getDB();
            $sql = 'SELECT id, title, content, cover, created_at, subtitle, slug
            FROM articles 
            WHERE published = 1
            ORDER BY created_at';

            if ($limit > 0) {
                $sql .= " LIMIT $limit";
            }

            $res = $db->query($sql);

            $results = $res->fetchAll();

            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getHightlights()
    {
        try {
            $db = static::getDB();
            $sql = 'SELECT id, title, content, cover, created_at, subtitle, slug
            FROM articles 
            WHERE published = 1 AND hightlight = 1
            ORDER BY created_at
            LIMIT 5';

            $res = $db->query($sql);

            $results = $res->fetchAll();

            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function byID($id)
    {
        try {
            $db = static::getDB();
            $sql = "SELECT id, title, content, cover, created_at, subtitle, slug
            FROM articles 
            WHERE id = $id";

            $res = $db->query($sql);

            $result = $res->fetch();

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function bySlug($slug)
    {
        try {
            $db = static::getDB();
            $sql = "SELECT id, title, content, cover, created_at, subtitle, slug
            FROM articles 
            WHERE slug = '$slug'";

            // var_dump($sql);
            // die();

            $res = $db->query($sql);

            $result = $res->fetch();

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
