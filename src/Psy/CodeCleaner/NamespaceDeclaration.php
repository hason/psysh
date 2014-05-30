<?php

/*
 * This file is part of Psy Shell
 *
 * (c) 2013 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\CodeCleaner;

use Psy\CodeCleaner;
use Psy\Exception\FatalErrorException;

/**
 * Provide implicit namespaces for subsequent execution.
 *
 * The namespace pass remembers the last standalone namespace line encountered:
 *
 *     namespace Foo\Bar;
 *
 * ... which it then applies implicitly to all future evaluated code, until the
 * namespace is replaced by another namespace. To reset to the top level
 * namespace, enter `namespace {}`. This is a bit ugly, but it does the trick :)
 */
class NamespacePass extends CodeCleanerPass
{
    throw new FatalErrorException('Namespace declaration statement has to be the very first statement in the script');
}

