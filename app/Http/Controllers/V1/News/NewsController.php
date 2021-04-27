<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\News;

use App\Helpers\OrderByHelper;
use App\Http\Controllers\AbstractController;
use App\Services\News\NewsService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class NewsController
 * @package App\Http\Controllers\V1\News
 */
class NewsController extends AbstractController
{
    /**
     * @var array|string[]
     */
    protected array $searchFields = [
        'titulo',
        'slug',
        'subtitulo'
    ];

    /**
     * NewsController constructor.
     * @param NewsService $service
     */
    public function __construct(NewsService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param Request $request
     * @param int $author
     * @return JsonResponse
     */
    public function findByAuthor(Request $request, int $author): JsonResponse
    {
        try {
            $limit = (int) $request->get('limit', 10);
            $orderBy = $request->get('order_by', []);

            if (!empty($orderBy)) {
                $orderBy = OrderByHelper::treatOrderBy($orderBy);
            }

            $result = $this->service->findByAuthor($author, $limit, $orderBy);

            $response = $this->successResponse($result, Response::HTTP_PARTIAL_CONTENT);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

    /**
     * @param Request $request
     * @param string $param
     * @return JsonResponse
     */
    public function findBy(Request $request, string $param): JsonResponse
    {
        try {
            $result = $this->service->findBy($param);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

    /**
     * @param Request $request
     * @param string $param
     * @return JsonResponse
     */
    public function deleteBy(Request $request, string $param): JsonResponse
    {
        try {
            $result['deletado'] = $this->service->deleteBy($param);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }

    /**
     * @param Request $request
     * @param int $author
     * @return JsonResponse
     */
    public function deleteByAuthor(Request $request, int $author): JsonResponse
    {
        try {
            $result['deletado'] = $this->service->deleteByAuthor($author);
            $response = $this->successResponse($result);
        } catch (Exception $e) {
            $response = $this->errorResponse($e);
        }

        return response()->json($response, $response['status_code']);
    }
}
