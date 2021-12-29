<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;
use App\Http\Requests\TagFormRequest;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    // ============================================================================

    public function create()
    {
        return view('tags.create-edit');
    }

    // ============================================================================

    public function store(TagFormRequest $tag)
    {
        $dataFormTag   = $tag->all();

        $insert  = Tag::create($dataFormTag);

        if ($insert) {
            return redirect ()->route('tags.index');
        } else {
            return redirect ()->route('tags.create');
        }
    }

    // ============================================================================

    public function show($id)
    {
        //
    }

    // ============================================================================

    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('tags.create-edit', compact('tag'));
    }

    // ============================================================================

    public function update(TagFormRequest $tag, $id)
    {
        $dataForm = $tag->all();
        $tagFind  = Tag::find($id);

        $update   = $tagFind->update($dataForm);

        if ($update) {
            return redirect()->route('tags.index');
        } else {
            return redirect()->route('tags.edit')->with(['errors' => 'Falha ao editar']);
        }
    }

    // ============================================================================

    public function destroy($id)
    {
        $tag = Tag::find($id);

        $delete = $tag->delete();

        if ($delete) {
            return redirect()->route('tags.index');
        } else {
            return redirect()->route('tags.index')->with(['errors' => 'Falha ao deletar']);
        }
    }
}
