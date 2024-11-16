<?php 

namespace App\View\Composers;

use App\Http\Controllers\Client\HomeController;
use Illuminate\View\View;

class PostComposer
{
    protected $homeController;

    public function __construct(HomeController $homeController)
    {
        $this->homeController = $homeController;
    }

    public function compose(View $view)
    {
        $featuredPosts = $this->homeController->featuredPosts();

        $view->with('featuredPosts', $featuredPosts);
    }
}
