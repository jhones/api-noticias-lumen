<?php

declare(strict_types=1);

namespace App\Services\ImageNews;

use App\Services\AbstractService;
use InvalidArgumentException;

/**
 * Class ImageNewsService
 * @package App\Services\ImageNews
 */
class ImageNewsService extends AbstractService
{
    /**
     * @param int $newsId
     * @return array
     */
    public function findByNews(int $newsId): array
    {
        return $this->repository->findByNews($newsId);
    }

    /**
     * @param int $newsId
     * @return bool
     */
    public function deleteByNews(int $newsId): bool
    {
        return $this->repository->deleteByNews($newsId);
    }

    /**
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $this->isImage($data['imagem']);
        $data['imagem'] = base64_encode(file_get_contents($data['imagem']));

        return $this->repository->create($data);
    }

    /**
     * @param string $param
     * @param array $data
     * @return bool
     */
    public function editBy(string $param, array $data): bool
    {
        $this->isImage($data['imagem']);
        $data['imagem'] = base64_encode(file_get_contents($data['imagem']));

        return $this->repository->editBy($param, $data);
    }

    /**
     * @param string $string
     * @return bool
     */
    private function isImage(string $string): bool
    {
        $imageArray = getimagesize($string);

        if (!in_array($imageArray[2], [IMAGETYPE_JPEG, IMAGETYPE_PNG])){
            throw new InvalidArgumentException('Arquivo de imagem inválido');
        }

        return true;
    }
}
