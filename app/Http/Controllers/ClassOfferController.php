<?php

namespace App\Http\Controllers;

use App\Models\ClassOffer;
use App\Models\Subject;
use App\http\Requests\ClassOfferRequest;
use App\Models\ClassOfferView;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClassOffer $class_offer, Request $request)
    {
        $params = $request->query();
        $class_offers = ClassOffer::search($params)->with(['teacher', 'subjects'])->order($params)->paginate(5);
        $class_offers->appends($params);
        $subjects = Subject::all();
        return view('class_offers.index', compact('class_offers', 'subjects', 'params'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ClassOffer $class_offer)
    {
        $subjects = Subject::all();
        return view('class_offers.create', compact('subjects', 'class_offer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ClassOfferRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassOfferRequest $request)
    {
        $class_offer = new ClassOffer($request->all());
        $class_offer->teacher_id = $request->user()->teacher->id;

        try {
            $class_offer->save();
            // $class_offer->subjects()->detach();
            $class_offer->subjects()->attach($request->subject_id);
            // foreach ($request["subject_id"] as $subject) {
            //     // tag保存
            //     $subject_id = Subject::firstOrCreate(['name' => $subject]);
            //     // 中間テーブルの保存
            //     $class_offer->subjects()->attach($subject_id);
            // }
        } catch (\Throwable $th) {
            return back()->withInput()
                ->withErrors('掲載情報登録処理でエラーが発生しました');
        }

        return redirect()
            ->route('class_offers.show', $class_offer)
            ->with('notice', '掲載情報を登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassOffer  $class_offer
     * @return \Illuminate\Http\Response
     */
    public function show(ClassOffer $class_offer)
    {
        ClassOfferView::updateOrCreate([
            'class_offer_id' => $class_offer->id,
            'user_id' => Auth::user()->id,
        ]);

        $request = !isset(Auth::user()->teacher)
            ? $class_offer->requests()->firstWhere('user_id', Auth::user()->id) : '';

        $requests = Auth::user()->id == $class_offer->teacher->user_id
            ? $class_offer->requests()->with('user')->get()
            : [];

        $messages = $class_offer->messages->load('user');

        $favorite = Favorite::with('classOffer')
            ->where('user_id', auth()->user()->id)
            ->where('class_offer_id', $class_offer->id)
            ->first();

        return view('class_offers.show', compact('class_offer', 'request', 'requests', 'messages', 'favorite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassOffer  $class_offer
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassOffer $class_offer)
    {
        $subjects = Subject::all();
        // dd($subjects);
        return view('class_offers.edit', compact('class_offer', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ClassOfferRequest $request
     * @param  \App\Models\ClassOffer  $class_offer
     * @return \Illuminate\Http\Response
     */
    public function update(ClassOfferRequest $request, ClassOffer $class_offer)
    {
        if (Auth::user()->cannot('update', $class_offer)) {
            return redirect()->route('class_offers.show', $class_offer)
                ->withErrors('自分の掲載情報以外は更新できません');
        }
        $class_offer->fill($request->all());
        try {
            $class_offer->save();
            $class_offer->subjects()->detach();
            $class_offer->subjects()->attach($request->subject_id);
            // foreach ($request["subject_id"] as $subject) {
            //     // tag保存
            //     $subject_id = Subject::firstOrCreate(['name' => $subject]);
            //     // 中間テーブルの保存

            //     $class_offer->subjects()->attach($subject_id);
            // }
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors('掲載情報更新処理でエラーが発生しました');
        }
        return redirect()->route('class_offers.show', $class_offer)
            ->with('notice', '掲載情報を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassOffer  $class_offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassOffer $class_offer)
    {
        if (Auth::user()->cannot('delete', $class_offer)) {
            return redirect()->route('class_offers.show', $class_offer)
                ->withErrors('自分の掲載情報以外は削除できません');
        }

        try {
            $class_offer->delete();
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors('掲載情報削除処理でエラーが発生しました');
        }

        return redirect()->route('class_offers.index')
            ->with('notice', '掲載情報を削除しました');
    }
}
