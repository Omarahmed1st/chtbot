<?php

namespace App\Models;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use Searchable;

    protected $fillable = ['question', 'answer'];
}
