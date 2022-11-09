<?php

namespace App\Http\Controllers;

use App\Models\ClassOffer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        $params = $request->query();
        $class_offers = ClassOffer::search($params)->with(['teacher', 'subject'])->order($params)->paginate(5);
        $class_offers->appends($params);
        $class_offers = ClassOffer::myClassOffer($params)->paginate(5);

        return view('dashboard', compact('class_offers', 'params'));
    }
}
