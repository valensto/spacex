<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Article;

class Home extends \Core\Controller
{
    public function index()
    {
        $articles = Article::getAll(10);
        $hightlights = Article::getHightlights();
        View::renderTemplate('Home/index.twig', [
            "articles" => $articles,
            "hightlights" => $hightlights
        ]);
    }
}
