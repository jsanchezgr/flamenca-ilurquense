<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;


class EventController extends Controller
{
    public function list(Request $request)
    {
        $events = Event::where('date', '>=', Carbon::now())->get();

        return view('admin.events.list')->with('events', $events);
    }

    public function edit(Request $request, string $id)
    {
        // TODO: Show single event

        return view('admin.events.list')->with('event', $id);
    }
}
