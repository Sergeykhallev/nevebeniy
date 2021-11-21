<?php
namespace Src\Lib\Main\Web\Http;

class HttpRequest implements Request
{
    private array $request;
    private array $post;
    private array $get;
    private array $cookie;
    private array $files;
    private array $server;

    public function __construct()
    {
        $this->request = $_REQUEST;
        $this->post = $_POST;
        $this->get = $_GET;
        $this->cookie = $_COOKIE;
        $this->files = $_FILES;
        $this->server = $_SERVER;
    }

    public function get($name): string
    {
        return $this->request[$name];
    }

    public function query(string $name): string
    {
        return $this->get[$name];
    }

    public function file(string $name): string
    {
        return $this->files[$name];
    }

    public function input(string $name): string
    {
        return $this->post[$name];
    }

    public function ip(): string
    {
        return $this->server['REMOTE_ADDR'];
    }

    public function method(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function cookie(string $name): string
    {
        return $this->cookie[$name];
    }

    public function hasFile(string $name): bool
    {
        if (!empty($this->files[$name])) {
            return true;
        }
        return false;
    }

    public function only(array $only): array
    {
        $result = [];
        foreach ($this->post as $item)
        {
            if (!array_search($item, $only)) {
                continue;
            }
            $result[] = $item;
        }
        return $result;
    }

    public function except(array $except): array
    {
        $result = [];
        foreach ($this->post as $item)
        {
            if (array_search($item, $except)) {
                continue;
            }
            $result[] = $item;
        }
        return $result;
    }

    public function isMethod(string $method): bool
    {
        if ($this->method() == $method) {
            return true;
        }
        return false;
    }

    public function missing(string $name): bool
    {
        if (empty($this->request[$name])) {
            return true;
        }
        return false;
    }

    public function has(string $name): bool
    {
        if (!empty($this->request[$name])) {
            return true;
        }
        return false;
    }

    public function filled(string $name): bool
    {
        if (!empty($this->request[$name])) {
            return true;
        }
        return false;
    }
}