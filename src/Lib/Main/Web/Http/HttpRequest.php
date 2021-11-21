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

    public function get($name)
    {
        try {
            if (array_key_exists($name, $this->request)) {
                return $this->request[$name];
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function query(string $name)
    {
        try {
            if (array_key_exists($name, $this->get)) {
                return $this->get[$name];
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function file(string $name)
    {
        try {
            if (array_key_exists($name, $this->files)) {
                return $this->files[$name];
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function input(string $name)
    {
        try {
            if (array_key_exists($name, $this->post)) {
                return $this->post[$name];
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function ip()
    {
        try {
            if (array_key_exists('REMOTE_ADDR', $this->server)) {
                return $this->server['REMOTE_ADDR'];
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function method()
    {
        try {
            if (array_key_exists('REQUEST_METHOD', $this->server)) {
                return $this->server['REQUEST_METHOD'];
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function cookie(string $name)
    {
        try {
            if (array_key_exists($name, $this->cookie)) {
                return $this->cookie[$name];
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function hasFile(string $name): bool
    {
        try {
            if (!empty($this->files[$name])) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
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
        try {
            if ($this->method() == $method) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function missing(string $name): bool
    {
        try {
            if (empty($this->request[$name])) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function has(string $name): bool
    {
        try {
            if (!empty($this->request[$name])) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function filled(string $name): bool
    {
        try {
            if (!empty($this->request[$name])) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
}