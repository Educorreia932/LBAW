<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model {
    use HasFactory;

    protected $table = 'message';

    public function sender() {
        return $this->hasOne(Member::class, "id");
    }
}
