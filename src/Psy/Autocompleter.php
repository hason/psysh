<?php

/*
 * This file is part of Psy Shell
 *
 * (c) 2012-2014 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy;

class Autocompleter implements \Hoa\Console\Readline\Autocompleter\Autocompleter
{
    private $shell;

    public function __construct(Shell $shell)
    {
        $this->shell = $shell;
    }

    /**
     * Complete a word.
     * Returns null for no word, a full-word or an array of full-words.
     *
     * @access  public
     * @param   string &$prefix Prefix to autocomplete.
     * @return  mixed
     */
    public function complete(&$prefix)
    {
        var_dump($prefix);
        $out    = [];
        $length = mb_strlen($prefix);

        $variables = $this->shell->getScopeVariables();

        $functions = get_defined_functions();
        $functions = array_merge($functions['internal'], $functions['user']);
        $functions = array_change_key_case(array_combine($functions, $functions));

        $classes = array_merge(get_declared_classes(), get_declared_interfaces(), get_declared_traits());
        $classes = array_change_key_case(array_combine($classes, $classes));

        foreach(array() as $word)
            if(mb_substr($word, 0, $length) === $prefix)
                $out[] = $word;

        if (empty($out)) {
            return null;
        }

        if (1 === count($out)) {
            return $out[0];
        }

        return $out;
    }

    /**
     * Get definition of a word.
     * Example: \b\w+\b. PCRE delimiters and options must not be provided.
     *
     * @access  public
     * @return  string
     */
    public function getWordDefinition()
    {
        return '(\$.*|\b\w+\b)';
    }


}