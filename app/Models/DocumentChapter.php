<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DocumentChapter
 *
 * @property int $id
 * @property int $documents_id
 * @property int|null $parent_id
 * @property string $name
 * @property bool $is_enable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapter whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapter whereDocumentsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapter whereIsEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapter whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DocumentChapter extends Model
{
    protected $fillable = [
        'documents_id',
        'parent_id',
        'name',
        'is_enable',
    ];
}
