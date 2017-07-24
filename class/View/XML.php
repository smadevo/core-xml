<?php
namespace App\View;

/**
 * @inheritDoc
 */
abstract class XML extends Base
{
    const newline = '&#10;';
    const space   = '&#32;';

    /**
     * Encodes XML specific characters.
     *
     * @param string $input
     *
     * @return string
     */
    final protected function encode(string $input): string
    {
        $search = [
            PHP_EOL,
            ' '
        ];
        $replace = [
            self::newline,
            self::space
        ];
        $output = str_replace(
            $search,
            $replace,
            htmlspecialchars(
                $input,
                ENT_XML1|ENT_COMPAT,
                strtoupper($this->getCharset())
            )
        );
        return $output . PHP_EOL;
    }

    /**
     * Removes newlines and surrounding whitespace.
     *
     * @inheritDoc
     */
    protected function renderTemplateWith(array $data): string
    {
        $output = explode(
            PHP_EOL,
            parent::renderTemplateWith($data)
        );
        foreach ($output as $index => $line) {
            $output[$index] = trim($line);
        }
        return str_replace(
            self::space,
            ' ',
            implode(
                '',
                $output
            )
        );
    }
}
