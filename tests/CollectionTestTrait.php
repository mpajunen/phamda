<?php

/*
 * This file is part of the Phamda library
 *
 * (c) Mikael Pajunen <mikael.pajunen@gmail.com>
 *
 * For the full copyright and license information, please see the LICENSE
 * file that was distributed with this source code.
 */

namespace Phamda\Tests;

use Phamda\Tests\Fixtures\ArrayCollection;
use Phamda\Tests\Fixtures\ArrayContainer;

trait CollectionTestTrait
{
    /**
     * @param ArrayCollection|ArrayContainer $collection
     *
     * @return array
     */
    protected function getCollectionArray($collection)
    {
        return $collection->toArray();
    }

    protected function getCollectionGroupArray(array $collections)
    {
        return array_map([$this, 'getCollectionArray'], $collections);
    }
}
