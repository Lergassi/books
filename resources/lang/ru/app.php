<?php

return [
    "id" => "ID",
    "created_at" => "Дата создания",
    "updated_at" => "Дата обновления",
    "book" => [
        "attributes" => [
            "id" => "id",
            "title" => "Название",
            "description" => "Описание",
        ]],
    "node" => [
        "attributes" => [
            "text" => "Текст",
            "book_id" => "Книга (ID)",
            "title" => "Заголовок",
        ]],
    "nodeItem" => [
        "attributes" => [
            "node_id" => "Узел (ID)",
            "text" => "Текст",
            "node_next_id" => "Следующий узел (ID)",
        ]
    ]
];