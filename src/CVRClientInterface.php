<?php
 namespace Sh4dw\Laracvr;

interface CVRClientInterface
{
    public static function request(array $query, string $requestType, int $from, int $size);
}
