<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ClassOffer;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\ClassOffer  $classOffer
     * @return \Illuminate\Http\Response
     */
    public function index(ClassOffer $classOffer)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassOffer  $classOffer
     * @return \Illuminate\Http\Response
     */
    public function store(ClassOffer $class_offer)
    {
        $favorite = new Favorite();

        // $favorite->user_id = Auth::user()->id;
        $favorite->user_id = 2;
        
        $favorite->class_offer_id = $class_offer->id;
        
        $favorite->save();

        // return redirect()
        //     ->route('class_offers.show', $class_offer);
        return response($favorite, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassOffer  $classOffer
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(ClassOffer $classOffer, Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassOffer  $classOffer
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassOffer $classOffer, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassOffer  $classOffer
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassOffer $class_offer, Favorite $favorite)
    {
        $favorite->delete();
        return response('', 204);
        // return redirect()->route('class_offers.show', $class_offer);
    }
}
