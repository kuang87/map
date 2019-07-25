<?php

namespace App\Http\Controllers;

use App\Note;
use App\Point;
use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $points = Point::all();

        return view('point.index', [
            'points' => $points
        ]);
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
        $data = $request->validate([
            'name' => 'required|alpha_dash',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'category' => 'nullable|exists:categories,id',
            'note' => 'nullable|alpha_dash',
        ]);

        $point = new Point();
        $point->name = $data['name'];
        $point->category_id = $data['category'] ?? null;
        $point->latitude = $data['latitude'];
        $point->longitude = $data['longitude'];
        $point->save();

        if ($data['note'] != null){
            $note = new Note();
            $note->point_id = $point->id;
            $note->content = $data['note'];
            $note->save();
        }

        return redirect()->action('PointController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
