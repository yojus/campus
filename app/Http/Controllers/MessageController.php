<?php

namespace App\Http\Controllers;

use App\Models\ClassOffer;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\ClassOffer  $class_offer
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassOffer $class_offer, Request $request)
    {
        $message = new Message($request->all());
        $message->messageable_type = 'App\Models\ClassOffer';
        $message->messageable_id = $request->messageable_id;
        $message->user_id = Auth::user()->id;
        $message->message = $request->message;

        try {
            // 登録
            $message->save();
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors('メッセージ登録処理でエラーが発生しました');
        }

        $class_offer = ClassOffer::find($request->messageable_id);

        return redirect()
            ->route('class_offers.show', $class_offer)
            ->with('notice', 'メッセージを登録しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassOffer  $class_offer
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassOffer $class_offer, Message $message)
    {
        $class_offer = $message->messageable;

        if (Auth::user()->id != $message->user_id) {
            return redirect()->route('class_offers.show', $class_offer)
                ->withErrors('自分のメッセージ以外は削除できません');
        }

        try {
            $message->delete();
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors('メッセージ削除処理でエラーが発生しました');
        }

        return redirect()->route('class_offers.show', $class_offer)
        ->with('notice', ' メッセージを削除しました');
    }
}
