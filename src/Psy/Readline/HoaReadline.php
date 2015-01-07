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

use Hoa\Console\Readline\Autocompleter\Aggregate;
use Hoa\Console\Readline\Autocompleter\Path;
use Hoa\Console\Readline\Autocompleter\Word;
use Hoa\Console\Readline\Readline as BaseReadline;
use Psy\Util\ReadlineHistory;

/**
 * @author Martin Hasoň <martin.hason@gmail.com>
 */
class HoaReadline implements Readline
{
    private $readline;
    private $historyFile;
    private $historySize;
    private $eraseDups;

    public function __construct($historyFile = null, $historySize = 0, $eraseDups = false)
    {
        $this->historyFile = $historyFile;
        $this->historySize = $historySize;
        $this->eraseDups = $eraseDups;
        $this->readline = new BaseReadline();
    }

    /**
     * {@inheritdoc}
     */
    public static function isSupported()
    {
        return class_exists('Hoa\Console\Readline\Readline');
    }

    /**
     * {@inheritdoc}
     */
    public function addHistory($line)
    {
        $this->readline->addHistory($line);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function clearHistory()
    {
        $this->readline->clearHistory();

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function listHistory()
    {
        $i = 0;
        $history = array();
        do {
            $line = $this->readline->getHistory($i++);
        } while (null !== $line && $history[] = $line);

        return $history;
    }

    /**
     * {@inheritdoc}
     */
    public function readHistory()
    {
        $this->readline->clearHistory();
        foreach (ReadlineHistory::fromFile($this->historyFile) as $line) {
            $this->readline->addHistory($line);
        };

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function readline($prompt = null)
    {
        return $this->readline->readLine($prompt);
    }

    /**
     * {@inheritdoc}
     */
    public function redisplay()
    {
        // TODO: Implement redisplay() method.
    }

    /**
     * {@inheritdoc}
     */
    public function writeHistory()
    {
        // @todo
        return;
    }

    public function setAutocompleter($autocompleter)
    {
        $this->readline->setAutocompleter(new Aggregate(array(
            new Path(),
            $autocompleter,
        )));
    }
}