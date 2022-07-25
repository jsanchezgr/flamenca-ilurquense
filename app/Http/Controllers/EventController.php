<?php

namespace App\Http\Controllers;

use App\Http\Resources\Event\EventCollection;
use App\Http\Resources\Event\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class EventController extends Controller
{
    public function list(Request $request): JsonResponse
    {
        $events = Event::all();
        return response()->json(new EventCollection($events));
    }

    public function retrieve(Request $request, string $pk): JsonResponse
    {
        $event = Event::find($pk);

        if (!$event)
        {
            return response()->json(['message' => 'NOT_FOUND'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(new EventResource($event));
    }

    public function create(Request $request): JsonResponse
    {
        return response()->json([], Response::HTTP_CREATED);
    }
}
