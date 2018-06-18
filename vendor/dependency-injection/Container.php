<?php

namespace Gifts\DependencyInjection;


class Container
{

    private $objects;

    public function set($object)
    {
        $this->objects[get_class($object)] = $object;
    }

    public function has($class)
    {
        return array_key_exists($class, $this->objects);
    }

    public function get($class)
    {
        $object = (!empty($this->objects[$class]) ? $this->objects[$class] : null);
        if (empty($object)) {
            $parameters = $this->resolveInjectionParameter($class);
            if (!empty($parameters)) {
                $reflection_class = new \ReflectionClass($class);
                $object = $reflection_class->newInstanceArgs($parameters);;
            } else {
                $reflection_class = new \ReflectionClass($class);
                $object = $reflection_class->newInstance();;
            }
            $this->objects[$class] = $object;
        }

        return $object;
    }

    protected function resolveInjectionParameter($class)
    {
        $reflectionClass = new \ReflectionClass($class);
        $hasConstruct = $reflectionClass->hasMethod('__construct');
        $injectionParameters = null;
        if ($hasConstruct) {
            $constructMethod = $reflectionClass->getMethod('__construct');
            $constructParameters = $constructMethod->getParameters();
            $injectionParameters = [];
            foreach ($constructParameters as $parameter) {
                $reflectionType = $parameter->getType();
                if (!empty($reflectionType->getName()) && !in_array(
                        $reflectionType->getName(),
                        ['int', 'string', 'array']
                    )) {
                    if (class_exists($reflectionType->getName())) {
                        $injectionParameters[] = $this->get($reflectionType->getName());
                    }
                }
            }


        }

        return $injectionParameters;
    }

}