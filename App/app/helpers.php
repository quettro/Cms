<?php

if (!function_exists('redirect_now'))
{
    /**
     * @param $to
     * @param int $status
     * @param array $headers
     * @param $secure
     * @return void
     */
    function redirect_now($to, int $status = 302, array $headers = [], $secure = null): void
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(redirect($to, $status, $headers, $secure));
    }
}

if (!function_exists('redirect_now_if'))
{
    /**
     * @param bool $boolean
     * @param $to
     * @param int $status
     * @param array $headers
     * @param null $secure
     * @return void
     */
    function redirect_now_if(bool $boolean, $to, int $status = 302, array $headers = [], $secure = null): void
    {
        if ($boolean) {
            redirect_now($to, $status, $headers, $secure);
        }
    }
}
