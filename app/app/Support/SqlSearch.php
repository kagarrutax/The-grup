<?php

namespace App\Support;

class SqlSearch
{
    public static function like(?string $value): string
    {
        $normalized = SearchNormalizer::normalize($value);

        if ($normalized === '') {
            return '%';
        }

        return '%'.str_replace(' ', '%', $normalized).'%';
    }

    public static function expression(string $columnExpression): string
    {
        $expression = "LOWER(COALESCE({$columnExpression}, ''))";

        foreach (self::replacements() as $search => $replace) {
            $expression = "REPLACE({$expression}, '{$search}', '{$replace}')";
        }

        return $expression;
    }

    private static function replacements(): array
    {
        return [
            'á' => 'a',
            'à' => 'a',
            'ä' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'å' => 'a',
            'é' => 'e',
            'è' => 'e',
            'ë' => 'e',
            'ê' => 'e',
            'í' => 'i',
            'ì' => 'i',
            'ï' => 'i',
            'î' => 'i',
            'ó' => 'o',
            'ò' => 'o',
            'ö' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ú' => 'u',
            'ù' => 'u',
            'ü' => 'u',
            'û' => 'u',
            'ñ' => 'n',
            'ç' => 'c',
        ];
    }
}
