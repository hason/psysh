<?php

/*
 * This file is part of Psy Shell
 *
 * (c) 2012-2014 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Util;

/**
 * A utility class for getting Reflectors.
 *
 * @author Martin Hasoň <martin.hason@gmail.com>
 */
class ReadlineHistory
{
    public static function fromFile($file)
    {
        $history = file_get_contents($file);
        if (!$history) {
            return array();
        }

        // libedit doesn't seem to support non-unix line separators.
        $history = explode("\n", $history);

        // shift the history signature, ensure it's valid
        if (array_shift($history) !== '_HiStOrY_V2_') {
            return array();
        }

        // decode the line
        $history = array_map('static::parseLine', $history);
        // filter empty lines & comments
        return array_values(array_filter($history));
    }

    /**
     * From GNUReadline (readline/histfile.c & readline/histexpand.c):
     * lines starting with "\0" are comments or timestamps;
     * if "\0" is found in an entry,
     * everything from it until the next line is a comment.
     *
     * @param string $line The history line to parse.
     *
     * @return string | null
     */
    protected static function parseLine($line)
    {
        // empty line, comment or timestamp
        if (!$line || $line[0] === "\0") {
            return;
        }
        // if "\0" is found in an entry, then
        // everything from it until the end of line is a comment.
        if (($pos = strpos($line, "\0")) !== false) {
            $line = substr($line, 0, $pos);
        }

        return ($line !== '') ? String::unvis($line) : null;
    }
}