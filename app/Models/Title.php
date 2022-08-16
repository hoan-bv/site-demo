<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Title
 *
 * @property int                                                                     $id
 * @property string                                                                  $lang_title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translation[] $translations
 * @property-read int|null                                                           $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Title newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Title newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Title query()
 * @method static \Illuminate\Database\Eloquent\Builder|Title whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Title whereLangTitle($value)
 * @mixin \Eloquent
 */
class Title extends Model {

    use HasFactory;

    /**
     * @var array
     */
    protected $fillable   = ['lang_title'];

    public    $timestamps = false;

    /**
     * @return HasMany
     */
    function translations() {
        return $this->hasMany(Translation::class);
    }
}
