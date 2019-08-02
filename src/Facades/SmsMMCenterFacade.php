<?php


namespace Avlima\SmsMMCenter\Facades;


use Illuminate\Support\Facades\Facade;

class SmsMMCenterFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'sms-mmcenter';
    }
}
