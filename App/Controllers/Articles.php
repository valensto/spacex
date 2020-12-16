<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Article;

class Articles extends \Core\Controller
{
    public function read()
    {
        $article = Article::bySlug($this->route_params["slug"]);
        $hightlights = Article::getHightlights();
        View::renderTemplate('Articles/read.twig', [
            "article" => $article,
            "hightlights" => $hightlights
        ]);
    }
}
