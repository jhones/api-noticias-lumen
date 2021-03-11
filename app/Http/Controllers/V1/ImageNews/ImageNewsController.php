<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\ImageNews;

use App\Http\Controllers\AbstractController;
use App\Services\ImageNews\ImageNewsService;
use App\Services\ServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ImageNewsController
 * @package App\Http\Controllers\V1\ImageNews
 */
class ImageNewsController extends AbstractController
{
    /**
     * @var array
     */
    protected array $searchFields = [];

    /**
     * ImageNewsController constructor.
     * @param ImageNewsService $service
     */
    public function __construct(ImageNewsService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param Request $request
     * @param int $news
     * @return JsonResponse
     */
    public function findByNews(Request $request, int $news): JsonResponse
    {
        try {
            $result = $this->service->findByNews($news);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

    /**
     * @param Request $request
     * @param int $news
     * @return JsonResponse
     */
    public function deleteByNews(Request $request, int $news): JsonResponse
    {
        try {
            $result['deletado'] = $this->service->deleteByNews($news);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }
}
