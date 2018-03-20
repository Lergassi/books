<?php

namespace App;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Book $book
 */
class Read extends Model
{
    use StatusTrait;

    private $book;
    private $currentNode;

    const STATUS_READ = 10;
    const STATUS_END = 20;

    #region setters
    /**
     * @return mixed
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * @param mixed $book
     */
    public function setBook(Book $book)
    {
        $this->book = $book;
//        $this->nameSession .= $book->id;
    }

    /**
     * @return mixed
     */
    public function getCurrentNode()
    {
        return $this->currentNode;
    }

    /**
     * @param mixed $currentNode
     */
    public function setCurrentNode(Node $currentNode)
    {
        $this->currentNode = $currentNode;
    }
    #endregion

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * @param Book $book
     * @return Read
     */
    public static function init(Book $book)
    {
        $read = new Read();
        $read->setBook($book);
        $read->start();
        $read->setStatus(static::STATUS_READ);
        $read->saveRead();

        return $read;
    }

    /**
     * @return mixed
     */
    public function currentNode()
    {
        return $this->currentNode;
    }

    /**
     *
     */
    public function start()
    {
        $this->currentNode = Node::find($this->book->start_node_id);
    }

    /**
     * Сохраняет данные в сессию. По умолчанию не вызывается ни из одного метода, кроме init.
     */
    public function saveRead()
    {
        session([static::getNameSession($this->getBook()) => $this]);
    }

    /**
     * Устанавливает текущий узел если на него ссылается ответ. Если ответ не содержит следующего узла бросается исключение.
     * Для определения возможности установки следующего узла использовать isFinish()
     * @param NodeItem $nodeItem
     * @throws \Exception
     */
    public function choice(NodeItem $nodeItem)
    {
        if (!$nodeItem->nextNode())
            throw new \Exception("Ответ не ссылается на узел.");

        $this->setCurrentNode($nodeItem->nextNode()->first());

    }

    /**
     * @param int $book_id
     * @return Read|null
     */
    public static function loadRead(int $book_id): ?Read
    {
        $book = Book::find($book_id);
        if (!($read = session(static::getNameSession($book)))) {
            $read = Read::init($book);
        }

        return $read;
    }

    /**
     *
     */
    public function reset()
    {
        session()->forget(static::getNameSession($this->getBook()));
    }

    /**
     * Если ответ не ссылается на следующий узел - книга считается законченной.
     * @param NodeItem $nodeItem
     * @return bool
     */
    public function isFinish(NodeItem $nodeItem)
    {
        return $nodeItem->nextNode()->first() === null;
    }

    /**
     *
     */
    public function end()
    {
        $this->status = self::STATUS_END;
    }

    /**
     * @param int|null $status
     * @return array|mixed
     */
    public static function getStatusLabels(int $status = null)
    {
        $labels = [
            static::STATUS_READ => "Чтение",
            static::STATUS_END => "Закончено",
        ];

        return $status === null ? $labels : $labels[$status];
    }

    public static function getNameSession(Book $book)
    {
        return sprintf("readObj_%s", $book->id);
    }

    public static function hasObject(Book $book)
    {
        return session()->get(static::getNameSession($book)) !== null;
    }
}

