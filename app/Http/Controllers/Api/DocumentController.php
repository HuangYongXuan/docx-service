<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $this->makeValidator([
            'page' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1',
            'name' => 'nullable|string'
        ]);

        $query = Document::query();

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
            'name' => 'required|min:2|max:64|unique:documents,name',
            'is_enable' => 'nullable|boolean',
            'is_auth' => 'nullable|boolean',
        ];

        $this->makeValidator($rules);

        $data = $request->only(array_keys($rules));
        $data['crested_users_id'] = \Auth::user()->id;
        $result = Document::create($data);

        if ($rules) {
            return toSuccess(200, [], '创建成功');
        }

        return toError(-2000, [], '创建失败');
    }

    /**
     * Display the specified resource.
     *
     * @param Document $document
     * @return array
     */
    public function show(Document $document)
    {
        return toSuccess(200, $document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Document $document
     * @return array
     */
    public function update(Request $request, Document $document)
    {
        if ($document->crested_users_id !== \Auth::id()) {
            return toError(-404, [], '无法找到数据');
        }

        $rules = [
            'name' => 'nullable|string|max:64|min:2|unique:documents,name',
            'is_enabled' => 'nullable|boolean',
            'is_auth' => 'nullable|boolean',
        ];
        $this->makeValidator($rules);

        $data = $request->only(array_keys($rules));

        if ($document->update($data)) {
            return toSuccess(200, $document, '更新成功');
        }
        return toError(500, [], '更新失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Document $document
     * @return array
     */
    public function destroy(Document $document)
    {
        if (Document::destroy($document->id)) {
            return toSuccess(200, [], '删除成功');
        }

        return toError(500, [], '删除失败');
    }
}
