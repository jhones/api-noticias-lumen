<?php

declare(strict_types=1);

namespace App\Repositories\News;

use App\Models\ImageNews\ImageNews;
use App\Repositories\AbstractRepository;

/**
 * Class NewsRepository
 * @package App\Repositories\News
 */
class NewsRepository extends AbstractRepository
{
    /**
     * @param int $authorId
     * @param int $limit
     * @param array $orderBy
     * @return array
     */
    public function findByAuthor(int $authorId, int $limit = 10, array $orderBy = []): array
    {
        $results = $this->model::where('autor_id', $authorId);

        foreach ($orderBy as $key => $value) {
            if (strstr($key, '-')) {
                $key = substr($key, 1);
            }

            $results->orderBy($key, $value);
        }

        return $results->paginate($limit)
            ->appends([
                'order_by' => implode(',', array_keys($orderBy)),
                'limit' => $limit
            ])
            ->toArray();
    }

    /**
     * @param string $param
     * @return array
     */
    public function findBy(string $param): array
    {
        $query = $this->model::query();

        if (is_numeric($param)) {
            $news = $query->findOrFail($param);
        } else {
            $news = $query->where('slug', $param)
                ->get();
        }

        return $news->toArray();
    }

    /**
     * @param string $param
     * @param array $data
     * @return bool
     */
    public function editBy(string $param, array $data): bool
    {
        if (is_numeric($param)) {
            $news = $this->model::find($param);
        } else {
            $news = $this->model::where('slug', $param);
        }

        return $news->update($data) ? true : false;
    }

    /**
     * @param string $param
     * @return bool
     */
    public function deleteBy(string $param): bool
    {
        if (is_numeric($param)) {
            $news = $this->model::destroy($param);
        } else {
            $news = $this->model::where('slug', $param)
                ->delete();
        }

        return $news ? true : false;
    }

    /**
     * @param int $authorId
     * @return bool
     */
    public function deleteByAuthor(int $authorId): bool
    {
        $news = $this->model::where('autor_id', $authorId)
            ->delete();

        return $news ? true : false;
    }
}
