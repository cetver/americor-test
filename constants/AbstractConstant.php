<?php

namespace app\constants;

abstract class AbstractConstant
{
    /**
     * @param $prefix
     *
     * @return array
     * @throws \ReflectionException
     */
    public function filterByPrefix($prefix)
    {
        $result = [];
        $constants = $this->all();
        foreach ($constants as $name => $value) {
            if (strpos($name, $prefix) !== false) {
                $result[] = $value;
            }
        }

        return $result;
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function all()
    {
        $rc = new \ReflectionClass(static::class);

        return $rc->getConstants();
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function label($key)
    {
        $map = $this->map();
        if (!isset($map[$key])) {
            throw new \InvalidArgumentException('There is no such key');
        }

        return $map[$key];
    }

    /**
     * @return array
     */
    public function map()
    {
        throw new \BadMethodCallException('Not implemented');
    }
}