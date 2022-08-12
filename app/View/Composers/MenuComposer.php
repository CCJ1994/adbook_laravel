<?php

namespace App\View\Composers;

use App\Models\Menu;
use Illuminate\View\View;
use Cache;

class MenuComposer
{
    // 設定用來依賴注入的變數
    protected $menu;

    public function __construct(Menu $menu)
    {
        // 將 Menu Model 依賴注入到 MenuComposer
        $this->menu = $menu;
    }

    public function compose(View $view)
    {
    	// 取得所有分類並放入變數 menus
        $menus = $this->menu->get()->collect()->keyBy('url')->toArray();
        // 將資料綁定至 blade 模板中
        $view->with('menus', $menus);
    }
}
