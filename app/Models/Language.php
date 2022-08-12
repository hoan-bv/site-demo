<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int           $id
 * @property string        $locale
 * @property int           $code
 * @property Translation[] $translations
 */
class Language extends Model {

    /**
     * @var array
     */
    protected $fillable = [
        'locale',
        'code',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations() {
        return $this->hasMany('App\Translation');
    }
}
