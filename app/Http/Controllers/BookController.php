<?php

namespace App\Http\Controllers;

use App\Book;
use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");

        $this->authorizeResource(Book::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Book::class);

        $pageSize = 10;
        $books = Book::orderBy("created_at", "DESC")->paginate($pageSize);

        return view("book/index", [
            "books" => $books,
            "columns" => [
                "id",
                "title",
                "created_at",
                "updated_at",
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
        $book = Book::createSample();

        return view("book/create", [
            "book" => $book,
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
            return redirect()->route("book.create")
                ->withErrors($validatedData)
                ->withInput($request->input());
        }

        $book = new Book();
        $book->fill($request->get("book"));

        if ($book->save()) {
            return redirect()->route("book.show", ["book" => $book->id]);
        } else {
            return redirect()->route("book.create")
                ->withErrors([
                    "error" => "Ошибка при сохранении."
                ])
                ->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view("book/view", [
            "book" => $book,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view("book/edit", [
            "book" => $book,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validatedData = $this->createValidator($request);

        if ($validatedData->fails()) {
            return redirect()->route("book.edit")
                ->withErrors($validatedData)
                ->withInput($request->input());
        }

        $book->fill($request->get("book"));

        if ($book->save()) {
            return redirect()->route("book.show", ["book" => $book->id]);
        } else {
            return redirect()->route("book.edit")
                ->withErrors([
                    "error" => "Ошибка при сохранении."
                ])
                ->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        Book::destroy($book->id);

        return redirect("/book");
    }

    function createValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'book.title' => 'required',
        ]);
    }
}
