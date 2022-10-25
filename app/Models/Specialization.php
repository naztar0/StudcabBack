<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'cathedra_id',
    ];

    public $timestamps = false;

    public function cathedra()
    {
        return $this->belongsTo(Cathedra::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
