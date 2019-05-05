<?php
/**
 * Created by PhpStorm.
 * User: Mateo
 * Date: 17.1.2019.
 * Time: 13:59
 */

namespace App\Controller\RESTController;


use App\Entity\UrlId;
use App\Service\UrlService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UrlControllerREST extends FOSRestController
{
    private $urlService;

    public function __construct(UrlService $urlService)
    {

        if($this->urlService) {
            $this->urlService = $urlService;
        }

        //this is my comment
        echo("hello");
    }

    /**
     * @Rest\Get("/url")
     * @return View
     */
    public function getAll() : View
    {
        $urlIds = $this->urlService->fetchAll();
        return View::create($urlIds);
    }

    /**
     * @Rest\Get("/urls")
     * @param Request $request
     * @return View
     */
    public function getUrls(Request $request) : View
    {
        $urlIdList = explode(',',$request->get('id'));
        $urlIdList = $this->urlService->fetchUrls($urlIdList);
        return View::create($urlIdList);
    }

    /**
     * @Rest\Post("/url")
     * @param Request $request
     * @return View
     */
    public function postUrl(Request $request) : View
    {
        $urlId = $this->urlService->saveUrl($request->get('url'));
        return View::create($urlId, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/url/{id}")
     * @param $id
     * @param Request $request
     * @return View
     */
    public function putUrl($id, Request $request) : View
    {
        $url = $request->get('url');
        $urlId_ = $this->urlService->updateUrl($id, $url);
        if(empty($urlId_)){
            return View::create($urlId_, Response::HTTP_NOT_FOUND);
        }
        return View::create($urlId_, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/url/{id}")
     * @param $id
     * @return View
     */
    public function deleteUrl($id): View{
        $this->urlService->deleteUrl($id);
        return View::create([], Response::HTTP_OK);
    }
}