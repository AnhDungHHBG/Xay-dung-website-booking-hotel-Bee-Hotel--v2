
<?php 

class AboutController extends BaseController
{
    public function loadModels() {}

    public function about_us() {
     
        $this->viewApp->requestView('about.index' );
    }
}