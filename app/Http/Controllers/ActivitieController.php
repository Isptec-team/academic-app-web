<?php

namespace App\Http\Controllers;

use App\Models\Activitie;
use Illuminate\Http\Request;

class ActivitieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('actividade');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'data' => 'required',
            'local' => 'required',
            'preletores' => 'required'
        ]);

        $input = $request->all();

        if($request->hasFile('img'))
        {
            $destination_path = 'public/images/activities';
            if($request->file('img')->isValid())
            {

                $image = $request->file('img');
                $image_name = $image->getClientOriginalName();
                $path = $request->file('img')->storeAs($destination_path, $image_name);

                $input['img'] = $image_name;
            }
        }
        
        return Activitie::create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Activitie::find($id);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $activitie = Activitie::find($id);
        $activitie->update($request->all());
        return $activitie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Activitie::destroy($id);
    }
}