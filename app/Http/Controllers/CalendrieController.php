<?php

namespace App\Http\Controllers;

use App\Calendrie;
use Calendar;
use Illuminate\Http\Request;

class CalendrieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $events = [];

        $data = Calendrie::all();

        if($data->count()){

          foreach ($data as $key => $value) {
            $color = dechex(rand(0x000000, 0xFFFFFF));
           // return $color;

            $events[] = Calendar::event(

                $value->libelle,

                true,

                new \DateTime($value->date_debut),

                new \DateTime($value->date_fin.' +1 day'),
                null,
                [
                    'color' =>'#'.$color,
                    'url' => '#',
                    'description' => "Event Description",
                    'textColor' => '#0A0A0A'
                ]


            );

        }

    }

    $calendar = Calendar::addEvents($events); 

    return view('Events.index', compact('calendar'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $event=new Calendrie;
        $event->libelle=$request->libelle;
        $event->date_debut=$request->date_debut;
        $event->date_fin=$request->date_fin;
        $event->save();
        session()->put('success','event :'.$event->libelle.' est bien ajouter');
        return redirect('events');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Calendrie  $calendrie
     * @return \Illuminate\Http\Response
     */
    public function show(Calendrie $calendrie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Calendrie  $calendrie
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendrie $calendrie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Calendrie  $calendrie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendrie $calendrie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Calendrie  $calendrie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendrie $calendrie)
    {
        //
    }
}
