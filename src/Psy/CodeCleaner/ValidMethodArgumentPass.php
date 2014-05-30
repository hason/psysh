<?php
/**
 * Created by PhpStorm.
 * User: hason
 * Date: 19.2.14
 * Time: 16:29
 */

namespace Psy\CodeCleaner;


class ValidMethodArgumentPass {
// public function __call($name) {}  Method A::__call() must take exactly 2 arguments
// __call($name, &$args) {} Method A::__call() cannot take arguments by reference
// Access level to B::foo() must be public (as in class A)
}
