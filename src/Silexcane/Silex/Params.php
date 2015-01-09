<?php
namespace Silexcane\Silex;

class Params implements \ArrayAccess
{
    protected $values = [];

    public function __construct(array $requestParameters, array $names)
    {
        foreach ($names as $name) {
            $key = str_replace('-', '_', $name);
            if (isset($requestParameters[$name])) {
                $this->values[$key] = $requestParameters[$name];
            } else {
                $this->values[$key] = null;
            }
        }
    }

    public function toArray()
    {
        return $this->values;
    }

    public function offsetExists($offset)
    {
        return isset($this->values[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->values[$offset]) ? $this->values[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        $this->values[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->values[$offset]);
    }

    public function __set($name, $value)
    {
        $name = $this->toSnakeCase($name);
        return $this->offsetSet($name, $value);
    }

    public function __get($name)
    {
        $name = $this->toSnakeCase($name);
        return $this->offsetGet($name);
    }

    public function __isset($name)
    {
        $name = $this->toSnakeCase($name);
        return $this->offsetExists($name);
    }

    public function __unset($name)
    {
        $name = $this->toSnakeCase($name);
        return $this->offsetUnset($name);
    }

    protected function toSnakeCase($name)
    {
        // camelCase or PascalCase -> snake_case
        return ltrim(strtolower(preg_replace('/([A-Z])/', '_\\0', $name)), '_');
    }
}
