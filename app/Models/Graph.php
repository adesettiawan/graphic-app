<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graph extends Model
{
    use HasFactory;
    protected $table = 'graphs';
    protected $primaryKey = 'id';
    protected $keyType = 'string';    // If primaryKey string you can add keyType
    protected $guarded = [];

    public $timestamps = false;  // If you don't use timestamps you can add this line


    /**
     * Get the user that owns the News
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
