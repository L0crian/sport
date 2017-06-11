<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index($id)
    {
        if(!$id) $id = 1;
        $article = Article::find($id);

        return view('books.show', compact('article'));
    }
}
