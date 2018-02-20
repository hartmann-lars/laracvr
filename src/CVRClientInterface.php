<?php
 namespace sh4dw\LaraCVR;

interface CVRClientInterface
{
    public static function request(array $query, string $requestType, int $from, int $size);
}
