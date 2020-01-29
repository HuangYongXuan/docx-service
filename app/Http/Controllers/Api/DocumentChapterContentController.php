<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DocumentChapterContent;
use Illuminate\Http\Request;

class DocumentChapterContentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $rules = [
            'document_chapter_id' => 'required|integer|exists:document_chapters,id',
            'contents' => 'required|array',
            'title' => 'required|string|max:255',
        ];
        $this->makeValidator($rules);

        $data = $request->only(array_keys($rules));

        $documentChapterContent = DocumentChapterContent::create($data);

        return toSuccess(200, $documentChapterContent, '创建成功');
    }

    /**
     * Display the specified resource.
     *
     * @param DocumentChapterContent $documentChapterContent
     * @return array
     */
    public function show(DocumentChapterContent $documentChapterContent)
    {
        return toSuccess(200, $documentChapterContent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param DocumentChapterContent $documentChapterContent
     * @return array
     */
    public function update(Request $request, DocumentChapterContent $documentChapterContent)
    {
        $rules = [
            'contents' => 'nullable|array',
            'title' => 'nullable|string|max:255',
        ];
        $this->makeValidator($rules);

        $data = $request->only(array_keys($rules));
        if (empty($data)) {
            return toError(404, [], '没事数据会被更新');
        }
        if ($documentChapterContent->update($data)) {
            return toSuccess(200, $documentChapterContent, '更新成功');
        }
        return toError(500, [], '更新失败');
    }
}
