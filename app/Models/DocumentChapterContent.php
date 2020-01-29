<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DocumentChapterContent
 *
 * @property int $id
 * @property int $document_chapter_id
 * @property mixed $contents
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapterContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapterContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapterContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapterContent whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapterContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapterContent whereDocumentChapterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapterContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapterContent whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $title
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DocumentChapterContent whereTitle($value)
 */
class DocumentChapterContent extends Model
{
    protected $fillable = [
        'document_chapter_id',
        'contents',
        'title',
    ];
}
