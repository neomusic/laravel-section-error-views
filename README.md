# Laravel Section Error Views
## This package is usefull if your project have multi sections with different views

for example: In your project you have two sections `backend` and `frontend, each section have different views for handle error

 backend -> ```resources/views/backend/errors```
 
 frontend -> ```resources/views/frontend/errors```
 
However, if an exception is thrown but not the view exists for that section? **Don't worry**

The generic view will continue to exist, as well as the response in json in case of an API is called

##install
* `composer require neomusic/laravel-section-error-views`
* go to `app/Exceptions/Handler` and extends this class with `NeoMusic\LaravelSectionErrorViews\Exceptions\SectionHandler`
* implement function `sectionRender` with your criteria for example:

    ```
    public function sectionRender($request,Exception $e)
      {
        if($request->is('admin/*')) {
          $this->renderBackoffice($request, $e);
        } else {
          $this->renderFrontend($request, $e);
        }
      }
    ```