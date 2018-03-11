<?php

namespace App\Http\Controllers;

use App\Book;
use Validator;
use App\Node;
use App\NodeItem;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->authorizeResource(Node::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Node::class);

        $pageSize = 10;
        $nodes = Node::orderBy("created_at", "DESC")->paginate($pageSize);

        return view("node/index", [
            "nodes" => $nodes,
            "columns" => [
                "id",
                "title",
                "created_at",
                "text",
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $node = new Node();

        return view("node/create", [
            "node" => $node,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->createValidator($request);

        if ($validatedData->fails()) {
            return redirect()->route("node.create")
                ->withErrors($validatedData)
                ->withInput($request->input());
        }

        $node = new Node();
        $node->fill($request->get("node"));

        if ($node->save()) {
            return redirect()->route("node.show", ["node" => $node->id]);
        } else {
            return redirect()->route("node.create")
                ->withErrors([
                    "error" => "Ошибка при сохранении."
                ])
                ->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node)
    {
        return view("node/view", [
            "node" => $node,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node)
    {
        return view("node/edit", [
            "node" => $node,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Node $node)
    {
        $validatedData = $this->createValidator($request);

        if ($validatedData->fails()) {
            return redirect()->route("node.edit")
                ->withErrors($validatedData)
                ->withInput($request->input());
        }

        $node->fill($request->get("node"));

        if ($node->save()) {
            return redirect()->route("node.show", ["node" => $node->id]);
        } else {
            return redirect()->route("node.edit")
                ->withErrors([
                    "error" => "Ошибка при сохранении."
                ])
                ->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node)
    {
        Node::destroy($node->id);

        return redirect("/node");
    }

    public function createValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'node.text' => 'required',
            'node.book_id' => 'required',
        ]);
    }
}
