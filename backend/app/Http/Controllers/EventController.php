<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
                               'guild_id'       => 'required|exists:guilds,id',
                               'name'           => 'required|string|max:255',
                               'event_date'     => 'nullable|date',
                               'event_time'     => 'nullable',
                               'maximum_people' => 'nullable|integer',
                               'details'        => 'nullable|string',
                           ]);

        $event = Event::create([
                                   'guild_id'          => $request->guild_id,
                                   'name'              => $request->name,
                                   'event_date'        => $request->event_date,
                                   'event_time'        => $request->event_time,
                                   'participant_limit' => $request->participant_limit,
                                   'details'           => $request->details,
                               ]);

        return response()->json(['message' => 'Event created successfully'], 201);
    }

    public function index()
    {
        $events = Event::with('users')->get();
        return response()->json($events);
    }

    public function show($id)
    {
        $event = Event::with('users')->findOrFail($id);
        return response()->json($event);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
                               'status'  => 'required|string|in:attending,not attending,undecided,adjusting',
                               'comment' => 'nullable|string',
                           ]);

        $event = Event::findOrFail($id);
        $event->users()->updateExistingPivot(Auth::id(), [
            'status'  => $request->status,
            'comment' => $request->comment,
        ]);

        return response()->json(['message' => 'Status updated successfully']);
    }
}
