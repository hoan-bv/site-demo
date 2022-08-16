<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Translation
 *
 * @property int      $id
 * @property int      $language_id
 * @property string   $title
 * @property string   $content
 * @property string   $note
 * @property string   $created_at
 * @property string   $updated_at
 * @property Language $language
 * @property int $lang_id
 * @property int $title_id
 * @property string|null $remark
 * @method static \Database\Factories\TranslationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereLangId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereTitleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Translation extends Model {

    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'lang_id',
        'title_id',
        'content',
        'note',
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language() {
        return $this->belongsTo(Language::class, 'id', 'lang_id');
    }

    public function title() {
        return $this->belongsTo(Title::class);
    }
}
