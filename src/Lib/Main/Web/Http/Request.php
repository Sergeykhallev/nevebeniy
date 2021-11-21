<?php
namespace Src\Lib\Main\Web\Http;

interface Request
{
    public function get(string $name): string;
    public function input(string $name): string;
    public function file(string $name): string;
    public function hasFile(string $name): bool;
    public function method(): string;
    public function isMethod(string $method): bool;
    public function ip(): string;
    public function query(string $name): string;
    public function only(array $only): array;
    public function except(array $except): array;
    public function has(string $name): bool;
    public function filled(string $name): bool;
    public function missing(string $name): bool;
    public function cookie(string $name): string;
}