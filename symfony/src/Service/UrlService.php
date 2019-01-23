<?php
/**
 * Created by PhpStorm.
 * User: Mateo
 * Date: 18.1.2019.
 * Time: 18:04
 */

namespace App\Service;


use App\Entity\UrlId;
use App\Network\PhpUrlIdGeneratorMK;
use App\Repository\UrlRepositoryInterface;

class UrlService
{
    private $urlRepository;
    public function __construct(UrlRepositoryInterface $urlRepository){
        $this->urlRepository = $urlRepository;
    }

    public function fetchAll()
    {
        return $this->urlRepository->findAll();
    }

    public function fetchUrls($urlIdArray)
    {
        return $this->urlRepository->findById($urlIdArray);
    }

    public function saveUrl(string $url): UrlId
    {
        $urlId = new UrlId();
        $generatedId = (new PhpUrlIdGeneratorMK())->generate($url);
        $urlId->setUrl($url);
        $urlId->setUrlID($generatedId);
        $this->urlRepository->save($urlId);
        return $urlId;
    }

    public function updateUrl($id,$url) : UrlId
    {
        $urlId_ = $this->urlRepository->findOneById($id);
        if(empty($urlId_)){
            return $urlId_;
        }
		$generatedId = (new PhpUrlIdGeneratorMK())->generate($url);
        $urlId_->setUrl($url);
        $urlId_->setUrlID($generatedId);
        $this->urlRepository->save($urlId_);
        return $urlId_;
    }

    public function deleteUrl($id): void
    {
        $urlId_ = $this->urlRepository->findOneById($id);
        $this->urlRepository->delete($urlId_);
    }

}