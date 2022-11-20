<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    // ステータス
    const STATUS_ENTRY = 0;
    const STATUS_APPROVAL = 1;
    const STATUS_REJECT = 2;
    const STATUS_LIST = [
        self::STATUS_ENTRY => 'リクエスト中',
        self::STATUS_APPROVAL => '承認',
        self::STATUS_REJECT => '却下',
    ];

    protected $fillable = [
        'class_offer_id',
        'user_id',
        'status',
    ];

    public function classOffer()
    {
        return $this->belongsTo(ClassOffer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusValueAttribute()
    {
        return self::STATUS_LIST[$this->status];
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'messageable');
    }
}
