<?php

namespace App\Http\Controllers;

use App\Api\Prova123Milhas as Prova123MilhasApi;
use App\Services\FlightsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlightController extends Controller
{
    const FLIGHTS_API_URL = 'http://prova.123milhas.net/api/flights';

    /**
     * @var array
     */
    public $flights = [];

    /**
     * @var Prova123MilhasApi
     */
    private $prova123MilhasApi;

    /**
     * @var FlightsService
     */
    private $flightsService;

    public function __construct(Prova123MilhasApi $prova123MilhasApi, FlightsService $flightsService)
    {
        $this->prova123MilhasApi = $prova123MilhasApi;
        $this->flightsService = $flightsService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function find(Request $request): JsonResponse
    {
        try {
            $flights = $this->prova123MilhasApi->getFlights();
            $data = $this->flightsService->flightsGrouping($flights);

            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => [
                    'msg' => $e->getMessage()],
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
            ], 500);
        }
    }
}
