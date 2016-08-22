<?php

/*
 * This file is part of develophub.net.
 *
 * (c) DevelopHub <master@develophub.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ReposRepository
 * @package namespace App\Repositories;
 */
interface ReposRepository extends RepositoryInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function createFromGithubAPI(array $data);

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function updateFromGithubAPI($id, array $data);

    /**
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug);

    /**
     * @param $limit
     * @return mixed
     */
    public function findHottest($limit = 5);

    /**
     * @param int $limit
     * @return mixed
     */
    public function findNewest($limit = 5);

    /**
     * @param int $limit
     * @return mixed
     */
    public function findTrend($limit = 5);

    /**
     * @param int $limit
     * @return mixed
     */
    public function findRecommend($limit = 10);

    /**
     * Find data by multiple values in one field
     *
     * @param       $field
     * @param array $values
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhereInPaginate($field, array $values, $columns = ['*']);

    /**$limit
     * @return int
     */
    public function count();

    /**
     * @param $keyword
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function search($keyword, $page = 1, $limit = 15);

    /**
     * @param $keyword
     * @param array $where
     * @return mixed
     */
    public function searchList($keyword, $where = []);
}
