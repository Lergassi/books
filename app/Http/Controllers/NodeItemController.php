<?php

namespace App\Http\Controllers;

use Validator;
use App\Node;
use App\NodeItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NodeItemController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->authorizeResource(NodeItem::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', NodeItem::class);

        $pageSize = config("app.pageSize", 10);
        $nodeItems = NodeItem::orderBy("created_at", "DESC")->paginate($pageSize);

        return view("node_item/index", [
            "nodeItems" => $nodeItems,
            "columns" => [
                "id",
                "text",
                "created_at",
                "node_id",
                "next_node_id",
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

        return view("node_item/create", [
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
            return redirect()->route("node_item.create", ["node_id" => $request->input("node_item.node_id")])
                ->withErrors($validatedData)
                ->withInput($request->input());
        }

        $nodeItem = new NodeItem();
        $nodeItem->fill($request->get("nodeItem"));

        if ($nodeItem->save()) {
            return redirect()->route("node.show", ["node" => $nodeItem->node_id]);
        } else {
            return redirect()->route("node_item.create")
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
        return view("node_item/view", [
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
        return view("node_item/edit", [
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

            return redirect()->route("node_item.edit", ["nodeItem" => $nodeItem->id])
                ->withErrors($validatedData)
                ->withInput($request->input());
        }

        $nodeItem->fill($request->get("nodeItem"));

        if ($nodeItem->save()) {
            return redirect()->route("node_item.show", ["nodeItem" => $nodeItem->id]);
        } else {
            return redirect()->route("node_item.edit")
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

        return redirect()->route("node_item.index");
    }

    public function createValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'nodeItem.text' => 'required',
            'nodeItem.node_id' => 'required',
        ]);
    }
}
