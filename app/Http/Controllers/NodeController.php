<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Support\Facades\DB;
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

        $pageSize = config("app.pageSize", 10);
        $nodes = Node::orderBy("created_at", "DESC")->paginate($pageSize);

        return view("node/index", [
            "nodes" => $nodes,
            "columns" => [
                "id",
                "title",
                "created_at",
                "text",
                "book_id",
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function create(Request $request)
    {
        $node = new Node();
        $nodeItem = new NodeItem();

        if ($book_id = $request->get("book_id")) {
            $node->book_id = $book_id;
        } elseif ($nodeItemId = $request->get("nodeItem_id")) {
            $nodeItem = NodeItem::find($nodeItemId);
            $node->book_id = $nodeItem->node->book_id;
        } else {
            throw new \Exception("Для создания узла нужно указать book_id или nodeItem_id. Доступно со страниц просмотра модели.");
        }

        $nodeItemsCollection = NodeItem::all();

        return view("node/create", [
            "node" => $node,
            "nodeItemsCollection" => $nodeItemsCollection,
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

        //TODO: Временное решение. Сделать интерфейс для создания новых узлов и узлов связанных с ответами.
        //TODO: Добавить выбор узла. Несколько ответов могут ссылаться на один узел.
        $params = [];
        if ($request->input("node.prev_item_id")) {
            $params["nodeItem_id"] = $request->input("node.prev_item_id");
        } elseif ($request->input("node.book_id")) {
            $params["book_id"] = $request->input("node.book_id");
        }

        if ($validatedData->fails()) {
            return redirect()->route("node.create", $params)
                ->withErrors($validatedData)
                ->withInput($request->input());
        }

        $node = new Node();
        $node->fill($request->get("node"));

        DB::beginTransaction();
        if ($success = $node->save()) {
            if ($request->input("node.prev_item_id")) {
                $nodeItemPrev = NodeItem::find($request->input("node.prev_item_id"));
                $nodeItemPrev->next_node_id = $node->id;
                $success = $nodeItemPrev->save() && $success;
            }

            if ($request->input("node.isStart")) {
                $success = Book::where("id", $node->book_id)
                    ->update(["start_node_id" => $node->id]) && $success;
            }
        }

        if ($success) {
            DB::commit();

            return redirect()->route("node.show", ["node" => $node->id]);
        } else {
            DB::rollBack();

            return redirect()->route("node.create", $params)
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
        $nodeItemsCollection = Book::find($node->book_id)->nodeItems;

        return view("node/edit", [
            "node" => $node,
            "nodeItemsCollection" => $nodeItemsCollection,
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
