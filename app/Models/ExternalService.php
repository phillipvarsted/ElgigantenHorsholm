<?php

namespace App\Models;

use App\Models\Label;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExternalService extends Model
{
    use HasFactory;

    protected $table = 'external_services';

    public function label()
    {
        return $this->hasOne(Label::class, 'status', 'status');
    }
}
