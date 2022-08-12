<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $language_id
 * @property string   $title
 * @property string   $content
 * @property string   $note
 * @property string   $created_at
 * @property string   $updated_at
 * @property Language $language
 */
class Translation extends Model {
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'language_id',
        'title',
        'content',
        'note',
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language() {
        return $this->belongsTo('App\Language');
    }
}
