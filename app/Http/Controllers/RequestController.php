<?php

namespace App\Http\Controllers;

use App\Models\ClassOffer;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\ClassOffer  $class_offer
     * @return \Illuminate\Http\Response
     */
    public function store(ClassOffer $class_offer)
    {
        $request = new Request([
            'class_offer_id' => $class_offer->id,
            'user_id' => Auth::user()->id,
        ]);
        // dd($request);
        try {
            // 登録
            $request->save();
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors('リクエストでエラーが発生しました');
        }

        return redirect()
            ->route('class_offers.show', $class_offer)
            ->with('notice', 'リクエストしました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassOffer  $class_offer
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassOffer $class_offer, Request $request)
    {
        $request->delete();

        return redirect()->route('class_offers.show', $class_offer)
            ->with('notice', 'リクエストを取り消しました');
    }

    /**
     *
     * @param  \App\Models\ClassOffer  $class_offer
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approval(ClassOffer $class_offer, Request $request)
    {
        $request->status = Request::STATUS_APPROVAL;
        $request->save();

        return redirect()->route('class_offers.show', $class_offer)
            ->with('notice', 'リクエストを承認しました');
    }

    /**
     *
     * @param  \App\Models\ClassOffer  $class_offer
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reject(ClassOffer $class_offer, Request $request)
    {
        $request->status = Request::STATUS_REJECT;
        $request->save();

        return redirect()->route('class_offers.show', $class_offer)
            ->with('notice', 'リクエストを却下しました');
    }
}
