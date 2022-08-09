<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index() {
        $search = request('search');
        
        if ($search) {
            $events = Event::where([
                ['title', 'like', '%' . $search . '%'],
            ])->get();
        } else {
            $events = Event::all();
        }

        return view('index', compact('events', 'search'));
    }

    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {
        $event = new Event();

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        // Image upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension  = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now') . time()) . '.' . $extension;

            $requestImage->move(public_path('assets/img/events'), $imageName);
            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect()->route('events.create')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id) {
        $user = auth()->user();
        $event = Event::with('user')->findOrFail($id);
        $hasUserJoined = false;

        if ($user) {
            $hasUserJoined = $user->eventsAsParticipant()->where('id', $event->id)->exists();
        }

        return view('events.show', compact('event', 'hasUserJoined'));
    }

    public function dashboard() {
        $user = auth()->user();

        $events = $user->events;
        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', compact('events', 'eventsAsParticipant'));
    }

    public function edit($id) {
        $user = auth()->user();
        $event = Event::where([
            ['id', $id],
            ['user_id', $user->id],
        ])->firstOrFail();

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id) {
        $data = $request->except(['_token', '_method']);
        $user = auth()->user();
        $event = Event::where([
            ['id', $id],
            ['user_id', $user->id],
        ])->firstOrFail();

        // Image upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension  = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now') . time()) . '.' . $extension;
            $requestImage->move(public_path('assets/img/events'), $imageName);
            $data['image'] = $imageName;

            if ($event->image) {
                unlink(public_path('assets/img/events/' . $event->image));
            }
        }

        $event->update($data);

        return redirect()->route('events.edit', $id)->with('msg', 'Evento editado com sucesso!');
    }

    public function join($id) {
        $event = Event::findOrFail($id);
        $user = auth()->user();
        $user->eventsAsParticipant()->sync($event->id);

        return redirect()->route('events.show', $id)->with('msg', 'Sua presença está confirmada no evento: ' . $event->title);
    }

    public function leave($id) {
        $event = Event::findOrFail($id);
        $user = auth()->user();
        $user->eventsAsParticipant()->detach($event->id);

        return redirect()->route('dashboard', $id)->with('msg', 'Você saiu com sucesso do evento: ' . $event->title);
    }

    public function destroy($id) {
        $user = auth()->user();
        $event = Event::where([
            ['id', $id],
            ['user_id', $user->id],
        ])->firstOrFail();

        if ($event->image) {
            unlink(public_path('assets/img/events/' . $event->image));
        }

        $event->delete();

        return redirect()->route('dashboard')->with('msg', 'Evento deletado com sucesso!');
    }
}
