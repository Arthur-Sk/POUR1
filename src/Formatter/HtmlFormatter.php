<?php

namespace Formatter;


class HtmlFormatter implements OutputFormatter
{
    public function format(array $output): string
    {
        return implode('<br/>', $output);
    }
}