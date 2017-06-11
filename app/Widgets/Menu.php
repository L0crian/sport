<?php

namespace App\Widgets;

use App\Category;
use Arrilot\Widgets\AbstractWidget;
use View;

class Menu extends AbstractWidget
{
    protected $data;
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $this->data = Category::with('articles')->get()->keyBy('id')->toArray();

        return Menu::getMenuHtml($this->getTree());
    }

    public function getTree()
    {
        $tree = [];
        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }

    static public function getMenuHtml($tree){
        $str = '';
        foreach ($tree as $category) {
            $str .= Menu::catToTemplate($category);
        }
        return $str;
    }

    static public function catToTemplate($category)
    {
        return View::make('widgets.part_menu')->with('category', $category)->render();
    }

}