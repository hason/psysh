<?php

/*
 * This file is part of Psy Shell
 *
 * (c) 2012-2014 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Readline;

use Psy\Util\ReadlineHistory;
use Psy\Util\String;

/**
 * A Libedit-based Readline implementation.
 *
 * This is largely the same as the Readline implementation, but it emulates
 * support for `readline_list_history` since PHP decided it was a good idea to
 * ship a fake Readline implementation that is missing history support.
 */
class Libedit extends GNUReadline
{
    /**
     * Let's emulate GNU Readline by manually reading and parsing the history file!
     *
     * @return boolean
     */
    public static function isSupported()
    {
        return function_exists('readline') && !function_exists('readline_list_history');
    }

    /**
     * {@inheritDoc}
     */
    public function listHistory()
    {
        return ReadlineHistory::fromFile($this->historyFile);
    }
}
