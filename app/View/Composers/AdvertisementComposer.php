<?php 

namespace App\View\Composers;

use App\Http\Controllers\Client\HomeController;
use Illuminate\View\View;

class AdvertisementComposer
{
    protected $homeController;

    public function __construct(HomeController $homeController)
    {
        $this->homeController = $homeController;
    }

    public function compose(View $view)
    {
        $advertisement = $this->homeController->advertisement();

        $view->with('advertisement', $advertisement);
    }
}