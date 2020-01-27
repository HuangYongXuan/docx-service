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

        $result = $query->paginate(request()->get('page', 1), request()->get('size', 1));

        return toSuccess(200, $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:2|max:64',
            'is_enable' => 'nullable|boolean',
            'is_auth' => 'nullable|boolean',
        ];

        $this->makeValidator($rules);

        $data = $request->only(array_keys($rules));

        $result = Document::create($data);

        if ($rules) {
            return toSuccess(200, [], '创建成功');
        }

        return toError(-2000, [], '创建失败');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
