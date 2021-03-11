<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Author;

use App\Http\Controllers\AbstractController;
use App\Services\Author\AuthorService;

/**
 * Class AuthorController
 * @package App\Http\Controllers\V1\Author
 */
class AuthorController extends AbstractController
{
    /**
     * @var array|string[]
     */
    protected array $searchFields = [
        'nome',
        'sobrenome'
    ];

    /**
     * AuthorController constructor.
     * @param AuthorService $service
     */
    public function __construct(AuthorService $service)
    {
        parent::__construct($service);
    }
}
