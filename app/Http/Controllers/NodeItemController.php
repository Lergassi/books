<?php

namespace App\Http\Controllers;

use Validator;
use App\Node;
use App\NodeItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NodeItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize = 10;
        $nodeItems = NodeItem::orderBy("created_at", "DESC")->paginate($pageSize);

        return view("nodeItem/index", [
            "nodeItems" => $nodeItems,
            "columns" => [
                "id",
                "text",
                "created_at",
                "node_id",
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function create(Request $request)
    {
        $nodeItem = new NodeItem();

        if ($node_id = $request->get("node_id")) {
            $nodeItem->node_id = $node_id;
            $node = Node::find($node_id);
        } else {
            throw new \Exception("Для создания узла нужно указать node_id. Доступно со страниц просмотра модели.");
        }

        return view("nodeItem/create", [
            "nodeItem" => $nodeItem,
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
            return redirect()->route("nodeItem.create", ["node_id" => $request->input("nodeItem.node_id")])
                ->withErrors($validatedData)
                ->withInput($request->input());
        }

        $nodeItem = new NodeItem();
        $nodeItem->fill($request->get("nodeItem"));

        if ($nodeItem->save()) {
            return redirect()->route("nodeItem.show", ["nodeItem" => $nodeItem->id]);
        } else {
            return redirect()->route("nodeItem.create")
                ->withErrors([
                    "error" => "Ошибка при сохранении."
                ])
                ->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NodeItem  $nodeItem
     * @return \Illuminate\Http\Response
     */
    public function show(NodeItem $nodeItem)
    {
        return view("nodeItem/view", [
            "nodeItem" => $nodeItem,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NodeItem  $nodeItem
     * @return \Illuminate\Http\Response
     */
    public function edit(NodeItem $nodeItem)
    {
        return view("nodeItem/edit", [
            "nodeItem" => $nodeItem,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NodeItem  $nodeItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NodeItem $nodeItem)
    {
        $validatedData = $this->createValidator($request);

        if ($validatedData->fails()) {
            return redirect()->route("nodeItem.edit")
                ->withErrors($validatedData)
                ->withInput($request->input());
        }

        $nodeItem->fill($request->get("nodeItem"));

        if ($nodeItem->save()) {
            return redirect()->route("nodeItem.show", ["nodeItem" => $nodeItem->id]);
        } else {
            return redirect()->route("nodeItem.edit")
                ->withErrors([
                    "error" => "Ошибка при сохранении."
                ])
                ->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NodeItem  $nodeItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(NodeItem $nodeItem)
    {
        NodeItem::destroy($nodeItem->id);

        return redirect("/nodeItem");
    }

    public function createValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'nodeItem.text' => 'required',
            'nodeItem.node_id' => 'required',
        ]);
    }
}
