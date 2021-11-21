<?php
namespace Src\Lib\Main\Web\Http;

interface Request
{
    public function get(string $name);
    public function input(string $name);
    public function file(string $name);
    public function hasFile(string $name): bool;
    public function method();
    public function isMethod(string $method): bool;
    public function ip();
    public function query(string $name);
    public function only(array $only): array;
    public function except(array $except): array;
    public function has(string $name): bool;
    public function filled(string $name): bool;
    public function missing(string $name): bool;
    public function cookie(string $name);
}