<?php


namespace Formatter;


interface OutputFormatter
{
    public function format(array $output): string;
}