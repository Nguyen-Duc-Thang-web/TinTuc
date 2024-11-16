<?php 

namespace App\View\Composers;

use App\Http\Controllers\Client\HomeController;
use Illuminate\View\View;

class CategoryComposer
{
    protected $homeController;

    public function __construct(HomeController $homeController)
    {
        $this->homeController = $homeController;
    }

    public function compose(View $view)
    {
        $categories = $this->homeController->categories();

        $view->with('categories', $categories);
    }
}
