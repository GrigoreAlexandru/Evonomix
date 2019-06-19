<?php

namespace App\Http\Controllers;

use App\ScheduleContent;
use Auth;
use Illuminate\Support\Facades\Storage;

class ScheduleContentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $contents = ScheduleContent::where('user_id', Auth::id());

        if (request()->has('status')) {
            $contents = $contents->where('status', request('status'));
        }

        $contents = $contents->orderBy('created_at', 'DESC')
            ->paginate(4*3)
            ->appends('status', request('status'));


        return view('ScheduleContents.index', compact('contents'));
    }


    public function create()
    {
        return view('ScheduleContents.create');
    }

    public function store()
    {
        request()->validate([
            'image' => 'required|image',
            'description' => 'required'
        ]);

        $content = new ScheduleContent();
        $content->user_id = Auth::id();
        $content->image = request('image')->store('uploads', 'public');
        $content->description = request('description');
        $content->schedule_on = empty(request('schedule_on')) ? null : date_format(date_create(request('schedule_on')), 'Y-m-d H:i');
        $content->status = empty($content->schedule_on) ? 'Unscheduled' : 'Scheduled';

        $content->save();

        return redirect()->route('content.index');
    }

    public function edit(ScheduleContent $content)
    {
        abort_unless(auth()->user()->id === $content->user_id, 403);
        return view('ScheduleContents.edit', compact('content'));
    }

    public function update(ScheduleContent $content)
    {
        abort_unless(auth()->user()->id === $content->user_id, 403);

        request()->validate([
            'image' => 'image'
        ]);

        $image = request('image');
        $description = request('description');
        $date = request('schedule_on');

        $content->image = empty($image) ? $content->image : $image->store('uploads', 'public');
        $content->description = empty($description) ? $content->description : $description;


        if (!empty($date)) {
            $content->schedule_on = date_format(date_create($date), 'Y-m-d H:i');
            $content->status = 'Scheduled';
        }

        $content->save();

        return redirect()->route('content.index');
    }

    public function destroy(ScheduleContent $content){
        Storage::delete('public/' . $content->image);
        $content->delete();
        return redirect()->route('content.index')->with('status','Content deleted');
    }
}
