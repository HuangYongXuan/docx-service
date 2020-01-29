<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DocumentChapterContent;
use Illuminate\Http\Request;

class DocumentChapterContentController extends Controller
{
    /**
     * 通过document_chapter_id获取内容
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $this->makeValidator([
            'document_chapter_id' => 'required|integer|exists:document_chapters,id',
        ]);
        $id = $request->get('document_chapter_id');

        return toSuccess(200, DocumentChapterContent::where('document_chapter_id', $id)->get());

    }

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
        $data['contents'] = json_encode($data['contents']);

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
        if ($request->has('contents')) {
            $data['contents'] = json_encode($data['contents']);
        }

        if ($documentChapterContent->update($data)) {
            return toSuccess(200, $documentChapterContent, '更新成功');
        }
        return toError(500, [], '更新失败');
    }
}
