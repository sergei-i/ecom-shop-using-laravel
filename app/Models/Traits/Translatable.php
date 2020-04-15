<?php


namespace App\Models\Traits;


use Illuminate\Support\Facades\App;

trait Translatable
{
    protected $defaultLocale = 'ru';

    public function __($originFieldName)
    {
        $locale = App::getLocale() ?? $this->defaultLocale;

        if ($locale === 'en') {
            $filedName = $originFieldName . '_en';

            if (is_null($this->$filedName) || empty($this->$filedName)) {
                return $this->$originFieldName;
            }
        } else {
            $filedName = $originFieldName;
        }

        if (array_key_exists($originFieldName, $this->attributes)) {
            return $this->$filedName;
        } else {
            throw new \LogicException('no such attribute for model' . get_class($this));
        }


    }
}
