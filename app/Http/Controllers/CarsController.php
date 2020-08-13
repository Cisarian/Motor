<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\User;
use Calendar;

use App\Mail\MotApproval;

use App\cars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SlackError;
use Illuminate\Support\Facades\Mail;


class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
            $cars = Cars::where('user_id', Auth::user()->id)->get();
            return view('cars.index', ['cars'=>$cars]);             
        } else {
            return view('cars.index');             

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = request()->validate([
            'make' => 'required',
            'model' => 'required',
            'registration' => 'required',
            'color' => 'required',
        ]);

        request()->validate([
            'image'=> 'required|max:9096'
        ]);

        $validatedData['user_id'] = Auth::user()->id;

        $cars = Cars::create($validatedData);

        $extension = $request->image->getExtension();
        $name = $request->image->getClientOriginalName();
        $request->image->storeAs('/public', $name.".".$extension);
        $url = Storage::url($name.".".$extension);
        $cars->image()->create(['name'=>$name, 'url'=>$url]);

        return redirect(route('cars_home'));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function show(cars $cars)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function edit(cars $id)
    {
        return view('cars.edit', ['car'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cars $id)
    {
        $validatedData = request()->validate([
            'make' => 'required',
            'model' => 'required',
            'registration' => 'required',
            'color' => 'required',
        ]);

        $id -> update($validatedData);

        if($request->hasFile('image'))
        {
            $extension = $request->image->getExtension();
            $name = $request->image->getClientOriginalName();
            $request->image->storeAs('/public', $name.".".$extension);
            $url = Storage::url($name.".".$extension);
            $id->image()->update(['name'=>$name, 'url'=>$url]);
        }
        
        return redirect(route('cars_home'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function destroy(cars $id)
    {
        $id->delete();
        return redirect(route('cars_home'));
    }

    public function createDate($id)
    {
        error_log('hello');
        return view('cars.mot_create', ['id'=>$id]);
    }

    public function storeDate(Request $request, cars $id)
    {
        $string = $request->mot." ".$request->time;
        $time = Carbon::createFromFormat('Y-m-d H:i', $string, 'Europe/London')->format('Y-m-d H:i:s')->toDateTimeString();
        $id->mot_time = $time;
        $id->request = 1;
    $id->save();
        return redirect()->back();
    }

    public function setStatus(Request $request)
    {

        if ($request['name'] == 'accept')
        {
            
            
            $car = Cars::where('id', $request->id)->first();            
            $car->MOT = 1;
            $car->request = 0;
            $car->save();
            
            $user = User::where('id', $car->user_id)->first();
            Mail::to($user->email)->send(new MotApproval('accept'));

        } else {
            $car = Cars::where('id', $request->id);
            $car->request = 0;
            $car->save();

            $user = User::where('id', $car->user_id)->first();
            Mail::to($user->email)->send(new MotApproval('decline'));


            // send markdown email
        }
        
        
    }

    public function adminView()
    {
        $users = User::all();
        $cars = Cars::all();
        $events = [];
        $data = Cars::all()->take(5);
        return view('cars.admin_view', ['cars' => $cars,
                                        'users'=>$users]);
    }

    public function adminCalendar()
    {
        $data = Cars::where('MOT', 1)->take(5)->get();
        return view('cars.calendar', ['cars'=>$data]);
        

    }



}

//$message = 'hello slack';
//$url = "https://hooks.slack.com/services/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";
//Notification::route('slack', env('SLACK_HOOK'))->notify(new SlackError());