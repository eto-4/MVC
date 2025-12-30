<?php

/**
 * Sanitizer
 *
 * Classe encarregada de netejar i normalitzar dades d'entrada
 * (formularis HTML, $_POST, $_GET, etc.)
 *
 * No valida regles de negoci, només saneja valors.
 */
class Sanitizer
{
    /**
     * Neteja un array de dades (normalment $_POST)
     */
    public static function clean(array $data): array
    {
        // Dudas: que valores se mueven por aqui? dar ejemplo de que se ven en cada linea.
        $cleaned = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $cleaned[$key] = self::cleanArray($value);
            }
            else {
                $cleaned[$key] = self::cleanValue($value);
            }
        }

        return $cleaned;
    }

    /**
     * Neteja un valor escalar
     */
    public static function cleanValue($value)
    {
        if (!is_string($value)) {
            return $value;
        }

        $value = trim($value);
        $value = strip_tags($value);

        return $value;
    }

    /**
     * Neteja un array (ex: tags[])
     */
    public static function cleanArray(array $values): array
    {
        $cleaned = [];

        foreach ($values as $value) {
            if (is_string($value)) {
                $value = trim($value);
                $value = strip_tags($value);

                if ($value !== '') {
                    $cleaned[] = $value;
                }
            }
        }

        return $cleaned;
    }

    /**
     * Converteix un valor a enter segur
     */
    public static function toInt($value): ?int
    {
        if ($value === '' || $value === null) {
            return null;
        }

        return filter_var($value, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
    }

    /**
     * Converteix un valor a float segur
     */
    public static function toFloat($value): ?float
    {
        if ($value === '' || $value === null) {
            return null;
        }

        return filter_var($value, FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);
    }   
}