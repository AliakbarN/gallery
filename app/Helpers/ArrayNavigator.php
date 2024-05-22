<?php

namespace App\Helpers;

class ArrayNavigator
{

    protected static string $pathSeparator = '.';

    public static function get(array $data, string $path): mixed
    {
        $subPaths = self::getSubPaths($path);

        return self::find($data, $subPaths, 0);
    }

    protected static function find(array $data, array $path, int $subPathIndex): mixed
    {
        $subPath = $path[$subPathIndex];
        $needy = null;

        if (array_key_exists($subPath, $data)) {
            if (is_array($data[$subPath])) {
                if (count($path) !== ($subPathIndex + 1)) {
                    $needy = self::find($data[$subPath], $path, $subPathIndex + 1);
                } else {
                    $needy = $data[$subPath];
                }
            } else {
                $needy = $data[$subPath];
            }
        }

        return $needy;
    }

    protected static function getSubPaths(string $path): array
    {
        return explode(self::$pathSeparator, $path);
    }

    /**
     * @param string $pathSeparator
     */
    public static function setPathSeparator(string $pathSeparator): void
    {
        self::$pathSeparator = $pathSeparator;
    }
}
