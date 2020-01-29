<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DocumentChapter;
use Illuminate\Http\Request;

class DocumentChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $this->makeValidator([
            'documents_id' => 'required|integer|min:1|exists:documents,id',
            'name' => 'nullable|string|max:128',
            'page' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1',
        ]);

        $query = DocumentChapter::query()->where('documents_id', \request()->get('documents_id'));

        if (\request()->has('name')) {
            $query->where('name', 'like', '%' . \request()->get('name') . '%');
        }

        return responsePagination($query);
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
            'documents_id' => 'required|integer|min:1|exists:documents,id',
            'parent_id' => 'nullable|integer|exists:document_chapters,id',
            'name' => 'required|string|max:128',
            'is_enable' => 'required|boolean',
        ];

        $this->makeValidator($rules);

        $data = $request->only(array_keys($rules));

        $documentChapter = DocumentChapter::create($data);

        return toSuccess(200, $documentChapter);
    }

    /**
     * Display the specified resource.
     *
     * @param DocumentChapter $documentChapter
     * @return array
     */
    public function show(DocumentChapter $documentChapter)
    {
        return toSuccess(200, $documentChapter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param DocumentChapter $documentChapter
     * @return array
     */
    public function update(Request $request, DocumentChapter $documentChapter)
    {
        $rules = [
            'name' => 'nullable|string|max:128',
            'is_enable' => 'nullable|boolean',
        ];

        $this->makeValidator($rules);

        $data = $request->only(array_keys($rules));

        if ($documentChapter->update($data)) {
            return toSuccess(200, $documentChapter, '更新成功');
        }
        return toError(500, [], '更新失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DocumentChapter $documentChapter
     * @return array
     */
    public function destroy(DocumentChapter $documentChapter)
    {
        if (DocumentChapter::destroy($documentChapter->id)) {
            return toSuccess(200, [], '删除成功');
        }

        return toError(500, [], '删除失败');
    }
}
