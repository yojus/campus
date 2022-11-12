<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ClassOffer extends Model
{
    use HasFactory;

    // 並び替え
    const SORT_NEW_ARRIVALS = 1;
    const SORT_VIEW_RANK = 2;
    const SORT_LIST = [
        self::SORT_NEW_ARRIVALS => '新着',
        self::SORT_VIEW_RANK => '人気',
    ];

    protected $fillable = [
        'subject_id',
        'school',
        'money',
        'area',
    ];

    public function scopeSearch(Builder $query, $params)
    {
        if (!empty($params['subject_id'])) {
            $query->where('subject_id', $params['subject_id']);
        }
        return $query;
    }

    public function scopeOrder(Builder $query, $params)
    {
        if ((empty($params['sort'])) ||
            (!empty($params['sort']) && $params['sort'] == self::SORT_NEW_ARRIVALS)
        ) {
            $query->latest();
        } elseif (!empty($params['sort']) && $params['sort'] == self::SORT_VIEW_RANK) {
            $query->withCount('classOfferViews')
                ->orderBy('class_offer_views_count', 'desc');
        }

        return $query;
    }

    public function scopeMyClassOffer(Builder $query, $params)
    {
        if (Auth::user()->can('teacher')) {
            $query->latest()
                ->with(['requests', 'subject'])
                ->where('teacher_id', Auth::user()->teacher->id);
        } else {
            $query->latest()
                ->with(['requests', 'subject'])
                ->whereHas('requests', function ($query) use ($params) {
                    $query->where('user_id', Auth::user()->id);
                });
        }

        return $query;
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function classOfferViews()
    {
        return $this->hasMany(ClassOfferView::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'messageable');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
