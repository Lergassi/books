<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Helper
{
    public static function hasOldAttribute(Model $model, string $attribute)
    {
        $attr = explode(".", $attribute);
        $attr = $attr[count($attr) - 1];

        if (old()) {
            return old($attribute);
        } else {
            return $model->$attr;
        }
    }

    /**
     * Обертка для trans(). Если поле не найдено, поиск происходит в файле lang/@lang/app. Переменные в файле записываются без префиксов.
     * @param null $key
     * @param array $replace
     * @param null $locale
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    public static function trans($key = null, $replace = [], $locale = null)
    {
        $trans = app('translator');

        if ($trans->has($key))
            return trans($key, $replace, $locale);
        else {
            $keys = explode(".", $key);
            $keyNew = $keys[count($keys) - 1];

            return trans("app." . $keyNew);
        }
    }
}