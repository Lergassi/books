<?php

namespace App\Http\Controllers;

use App\Book;
use App\NodeItem;
use App\Read;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
/**
 * Загрузка модели Read из сессии (или её создание) происходит в AppServiceProvider.
 */
class ReadController extends Controller
{
    /**
     * ReadController constructor.
     */
    public function __construct()
    {
        $this->middleware("auth");
        $this->authorizeResource(Read::class);
    }

    /**
     * @param Read $read
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function read(Read $read)
    {
        $this->authorize('read', [Read::class, $read]);

        if (!$read->isStatus(Read::STATUS_READ)) {
            return redirect()->route("read.info", ["read" => $read->getBook()->id]);
        }

        return view("read/read", [
            "read" => $read,
        ]);
    }

    /**
     * @param Read $read
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Read $read)
    {
        return view("read/info", [
            "read" => $read,
        ]);
    }

    /**
     * @param Read $read
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Read $read)
    {
        $read->reset();

        return redirect()->route("read.info", ["read" => $read->getBook()->id]);
    }

    /**
     * @param Read $read
     * @param NodeItem $nodeItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function choice(Read $read, NodeItem $nodeItem)
    {
        if ($read->isFinish($nodeItem)) {
            $read->end();
            return redirect()->route("read.info", ["read" => $read->getBook()->id]);
        }

        $read->choice($nodeItem);
        $read->saveRead();

        return redirect()->route("read", ["read" => $read->getBook()->id]);
    }
}
