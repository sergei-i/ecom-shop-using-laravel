<?php


namespace App\Services;


use App\Models\Currency;
use Carbon\Carbon;

class CurrencyConversion
{
    public const DEFAULT_CURRENCY_CODE = 'RUB';

    protected static $container;

    public static function loadContainer()
    {
        if (is_null(self::$container)) {
            $currencies = Currency::get();
            foreach ($currencies as $currency) {
                self::$container[$currency->code] = $currency;
            }
        }
    }

    public static function getCurrencies()
    {
        self::loadContainer();
        return self::$container;
    }

    public static function convert($sum, $originCurrencyCode = self::DEFAULT_CURRENCY_CODE, $targetCurrencyCode = null)
    {
        self::loadContainer();
        $originCurrency = self::$container[$originCurrencyCode];

        if ($originCurrency->code != self::DEFAULT_CURRENCY_CODE) {
            if ($originCurrency->rate != 0 || $originCurrency->updated_at->startOfDay()->toString() !== Carbon::now()->startOfDay()->toString()) {
                CurrencyRates::getRates();
                self::loadContainer();
                $originCurrency = self::$container[$originCurrencyCode];
            }
        }

        if (is_null($targetCurrencyCode)) {
            $targetCurrencyCode = session('currency', self::DEFAULT_CURRENCY_CODE);
        }
        $targetCurrency = self::$container[$targetCurrencyCode];

        if ($targetCurrency->code != self::DEFAULT_CURRENCY_CODE) {
            if ($targetCurrency->rate == 0 || $targetCurrency->updated_at->startOfDay()->toString() !== Carbon::now()->startOfDay()->toString()) {
                CurrencyRates::getRates();
                self::loadContainer();
                $originCurrency = self::$container[$originCurrencyCode];
            }
        }

        return $sum / $originCurrency->rate * $targetCurrency->rate;
    }

    public static function getCurrencySymbol()
    {
        self::loadContainer();
        $currencyFromSession = session('currency', self::DEFAULT_CURRENCY_CODE);
        $currency = self::$container[$currencyFromSession];
        return $currency->symbol;
    }

    public static function getBaseCurrency()
    {
        self::loadContainer();

        foreach (self::$container as $currency) {
            if ($currency->isMain()) {
                return $currency;
            }
        }
    }
}
