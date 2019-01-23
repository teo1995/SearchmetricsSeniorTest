<?php
/**
 * Created by PhpStorm.
 * User: Mateo
 * Date: 18.1.2019.
 * Time: 19:15
 */

namespace App\Repository;


use App\Entity\UrlId;

interface UrlRepositoryInterface
{

    /**
     * @param $id
     * @return UrlId|null
     */
    public function findOneById($id): ?UrlId;
    /**
     * @param UrlId $urlId
     */
    public function save(UrlId $urlId): void;

    /**
     * @param UrlId $urlId
     */
    public function delete(UrlId $urlId): void;

    /**
     * @param $urlIdArray
     * @return mixed
     */
    public function findById($urlIdArray) ;

    /**
     * @return mixed
     */
    public function findAll();

}