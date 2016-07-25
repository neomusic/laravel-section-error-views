<?php namespace  NeoMusic\LaravelSectionErrorViews\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

abstract class SectionHandler extends ExceptionHandler
{
  protected $pathErrors = "errors.";
  protected $backendPathErrors = "errors.";
  protected $frontendPathErrors = "errors.";

  public function setPathErrors($pathErrors)
  {
    $this->pathErrors = $pathErrors;
  }

  protected function renderHttpException(HttpException $e)
  {
    $status = $e->getStatusCode();

    if(view()->exists($this->pathErrors . $status)) {
      return response()->view($this->pathErrors . $status, ['exception' => $e], $status, $e->getHeaders());
    } else {
      return parent::renderHttpException($e);
    }
  }

  protected function renderBackoffice($request, $e)
  {
    $this->setPathErrors($this->backendPathErrors);
    parent::render($request, $e);
  }

  protected function renderFrontend($request, $e)
  {
    $this->setPathErrors($this->frontendPathErrors);
    parent::render($request, $e);
  }

  public function render($request, Exception $e)
  {
    $this->sectionRender();
    return parent::render($request, $e);
  }

  abstract function sectionRender();
}