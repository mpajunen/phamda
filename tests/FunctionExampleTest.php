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

use Phamda\Phamda;

class FunctionExampleTest extends \PHPUnit_Framework_TestCase
{
    public function test_()
    {
        $sub10 = Phamda::subtract(Phamda::_(), 10);
        $this->assertSame(42, $sub10(52));
    }

    public function testAll()
    {
        $isPositive = function ($x) { return $x > 0; };
        $this->assertSame(false, Phamda::all($isPositive, [1, 2, 0, -5]));
        $this->assertSame(true, Phamda::all($isPositive, [1, 2, 1, 11]));
    }

    public function testAllPass()
    {
        $isEven            = function ($x) { return $x % 2 === 0; };
        $isPositive        = function ($x) { return $x > 0; };
        $isEvenAndPositive = Phamda::allPass([$isEven, $isPositive]);
        $this->assertSame(false, $isEvenAndPositive(5));
        $this->assertSame(false, $isEvenAndPositive(-4));
        $this->assertSame(true, $isEvenAndPositive(6));
    }

    public function testAlways()
    {
        $alwaysFoo = Phamda::always('foo');
        $this->assertSame('foo', $alwaysFoo());
    }

    public function testAny()
    {
        $isPositive = function ($x) { return $x > 0; };
        $this->assertSame(true, Phamda::any($isPositive, [1, 2, 0, -5]));
        $this->assertSame(false, Phamda::any($isPositive, [-3, -7, -1, -5]));
    }

    public function testAnyPass()
    {
        $isEven           = function ($x) { return $x % 2 === 0; };
        $isPositive       = function ($x) { return $x > 0; };
        $isEvenOrPositive = Phamda::anyPass([$isEven, $isPositive]);
        $this->assertSame(true, $isEvenOrPositive(5));
        $this->assertSame(true, $isEvenOrPositive(-4));
        $this->assertSame(false, $isEvenOrPositive(-3));
    }

    public function testApply()
    {
        $concat3 = function ($a, $b, $c) { return $a . $b . $c; };
        $this->assertSame('foobarba', Phamda::apply($concat3, ['foo', 'ba', 'rba']));
    }

    public function testBinary()
    {
        $add3 = function ($a = 0, $b = 0, $c = 0) { return $a + $b + $c; };
        $add2 = Phamda::binary($add3);
        $this->assertSame(42, $add2(27, 15, 33));
    }

    public function testBoth()
    {
        $lt          = function ($x, $y) { return $x < $y; };
        $arePositive = function ($x, $y) { return $x > 0 && $y > 0; };
        $test        = Phamda::both($lt, $arePositive);
        $this->assertSame(false, $test(9, 4));
        $this->assertSame(false, $test(-3, 11));
        $this->assertSame(true, $test(5, 17));
    }

    public function testComparator()
    {
        $lt      = function ($x, $y) { return $x < $y; };
        $compare = Phamda::comparator($lt);
        $this->assertSame(-1, $compare(5, 6));
        $this->assertSame(1, $compare(6, 5));
        $this->assertSame(0, $compare(5, 5));
    }

    public function testConstruct()
    {
        $date = Phamda::construct(\DateTime::class, '2015-03-15');
        $this->assertSame('2015-03-15', $date->format('Y-m-d'));
    }

    public function testConstructN()
    {
        $construct = Phamda::constructN(1, \DateTime::class);
        $this->assertSame('2015-03-15', $construct('2015-03-15')->format('Y-m-d'));
    }

    public function testCompose()
    {
        $add5         = function ($x) { return $x + 5; };
        $square       = function ($x) { return $x ** 2; };
        $addToSquared = Phamda::compose($add5, $square);
        $this->assertSame(21, $addToSquared(4));
        $hello      = function ($target) { return 'Hello ' . $target; };
        $helloUpper = Phamda::compose($hello, 'strtoupper');
        $upperHello = Phamda::compose('strtoupper', $hello);
        $this->assertSame('Hello WORLD', $helloUpper('world'));
        $this->assertSame('HELLO WORLD', $upperHello('world'));
    }

    public function testCurry()
    {
        $add        = function ($x, $y, $z) { return $x + $y + $z; };
        $addHundred = Phamda::curry($add, 100);
        $this->assertSame(123, $addHundred(20, 3));
    }

    public function testCurryN()
    {
        $add    = function ($x, $y, $z = 0) { return $x + $y + $z; };
        $addTen = Phamda::curryN(3, $add, 10);
        $this->assertSame(23, $addTen(10, 3));
        $addTwenty = $addTen(10);
        $this->assertSame(25, $addTwenty(5));
    }

    public function testEach()
    {
        $date    = new \DateTime('2015-02-02');
        $addDays = function ($number) use ($date) { $date->modify("+$number days"); };
        Phamda::each($addDays, [3, 6, 2]);
        $this->assertSame('2015-02-13', $date->format('Y-m-d'));
    }

    public function testEachIndexed()
    {
        $date        = new \DateTime('2015-02-02');
        $addCalendar = function ($number, $type) use ($date) { $date->modify("+$number $type"); };
        Phamda::eachIndexed($addCalendar, ['months' => 3, 'weeks' => 6, 'days' => 2]);
        $this->assertSame('2015-06-15', $date->format('Y-m-d'));
    }

    public function testEither()
    {
        $lt          = function ($x, $y) { return $x < $y; };
        $arePositive = function ($x, $y) { return $x > 0 && $y > 0; };
        $test        = Phamda::either($lt, $arePositive);
        $this->assertSame(false, $test(-5, -16));
        $this->assertSame(true, $test(-3, 11));
        $this->assertSame(true, $test(17, 3));
    }

    public function testEvolve()
    {
        $object = ['foo' => 'bar', 'fiz' => 'buz'];
        $this->assertSame(['foo' => 'BAR', 'fiz' => 'buz'], Phamda::evolve(['foo' => 'strtoupper'], $object));
    }

    public function testFalse()
    {
        $false = Phamda::false();
        $this->assertSame(false, $false());
    }

    public function testFilter()
    {
        $gt2 = function ($x) { return $x > 2; };
        $this->assertSame(['bar' => 3, 'baz' => 4], Phamda::filter($gt2, ['foo' => 2, 'bar' => 3, 'baz' => 4]));
    }

    public function testFilterIndexed()
    {
        $smallerThanNext = function ($value, $key, $list) { return isset($list[$key + 1]) ? $value < $list[$key + 1] : false; };
        $this->assertSame([0 => 3, 2 => 2], Phamda::filterIndexed($smallerThanNext, [3, 6, 2, 19]));
    }

    public function testFind()
    {
        $isPositive = function ($x) { return $x > 0; };
        $this->assertSame(15, Phamda::find($isPositive, [-5, 0, 15, 33, -2]));
    }

    public function testFindIndex()
    {
        $isPositive = function ($x) { return $x > 0; };
        $this->assertSame(2, Phamda::findIndex($isPositive, [-5, 0, 15, 33, -2]));
    }

    public function testFindLast()
    {
        $isPositive = function ($x) { return $x > 0; };
        $this->assertSame(33, Phamda::findLast($isPositive, [-5, 0, 15, 33, -2]));
    }

    public function testFindLastIndex()
    {
        $isPositive = function ($x) { return $x > 0; };
        $this->assertSame(3, Phamda::findLastIndex($isPositive, [-5, 0, 15, 33, -2]));
    }

    public function testFlatMap()
    {
        $split = function ($string) { return str_split($string); };
        $this->assertSame(['a', 'b', 'c', 'd', 'e'], Phamda::flatMap($split, ['abc', 'de']));
    }

    public function testFlip()
    {
        $sub        = function ($x, $y) { return $x - $y; };
        $flippedSub = Phamda::flip($sub);
        $this->assertSame(10, $flippedSub(20, 30));
    }

    public function testGroupBy()
    {
        $firstChar  = function ($string) { return $string[0]; };
        $collection = ['abc', 'cbc', 'cab', 'baa', 'ayb'];
        $this->assertSame(
            ['a' => [0 => 'abc', 4 => 'ayb'], 'c' => [1 => 'cbc', 2 => 'cab'], 'b' => [3 => 'baa']],
            Phamda::groupBy($firstChar, $collection)
        );
    }

    public function testIfElse()
    {
        $addOrSub = Phamda::ifElse(Phamda::lt(0), Phamda::add(-10), Phamda::add(10));
        $this->assertSame(15, $addOrSub(25));
        $this->assertSame(7, $addOrSub(-3));
    }

    public function testInvoker()
    {
        $addDay = Phamda::invoker(1, 'add', new \DateInterval('P1D'));
        $this->assertSame('2015-03-16', $addDay(new \DateTime('2015-03-15'))->format('Y-m-d'));
        $this->assertSame('2015-03-13', $addDay(new \DateTime('2015-03-12'))->format('Y-m-d'));
    }

    public function testIsInstance()
    {
        $isDate = Phamda::isInstance(\DateTime::class);
        $this->assertSame(true, $isDate(new \DateTime()));
        $this->assertSame(false, $isDate(new \DateTimeImmutable()));
    }

    public function testMap()
    {
        $square = function ($x) { return $x ** 2; };
        $this->assertSame([1, 4, 9, 16], Phamda::map($square, [1, 2, 3, 4]));
    }

    public function testMapIndexed()
    {
        $keyExp = function ($value, $key) { return $value ** $key; };
        $this->assertSame([1, 2, 9, 64], Phamda::mapIndexed($keyExp, [1, 2, 3, 4]));
    }

    public function testMaxBy()
    {
        $getFoo = function ($item) { return $item->foo; };
        $a      = (object) ['baz' => 3, 'bar' => 16, 'foo' => 5];
        $b      = (object) ['baz' => 1, 'bar' => 25, 'foo' => 8];
        $c      = (object) ['baz' => 14, 'bar' => 20, 'foo' => -2];
        $this->assertSame($b, Phamda::maxBy($getFoo, [$a, $b, $c]));
    }

    public function testMinBy()
    {
        $getFoo = function ($item) { return $item->foo; };
        $a      = (object) ['baz' => 3, 'bar' => 16, 'foo' => 5];
        $b      = (object) ['baz' => 1, 'bar' => 25, 'foo' => 8];
        $c      = (object) ['baz' => 14, 'bar' => 20, 'foo' => -2];
        $this->assertSame($c, Phamda::minBy($getFoo, [$a, $b, $c]));
    }

    public function testNAry()
    {
        $add3 = function ($a = 0, $b = 0, $c = 0) { return $a + $b + $c; };
        $add2 = Phamda::nAry(2, $add3);
        $this->assertSame(42, $add2(27, 15, 33));
        $add1 = Phamda::nAry(1, $add3);
        $this->assertSame(27, $add1(27, 15, 33));
    }

    public function testNone()
    {
        $isPositive = function ($x) { return $x > 0; };
        $this->assertSame(false, Phamda::none($isPositive, [1, 2, 0, -5]));
        $this->assertSame(true, Phamda::none($isPositive, [-3, -7, -1, -5]));
    }

    public function testNot()
    {
        $equal    = function ($a, $b) { return $a === $b; };
        $notEqual = Phamda::not($equal);
        $this->assertSame(true, $notEqual(15, 13));
        $this->assertSame(false, $notEqual(7, 7));
    }

    public function testPartial()
    {
        $add    = function ($x, $y, $z) { return $x + $y + $z; };
        $addTen = Phamda::partial($add, 10);
        $this->assertSame(17, $addTen(3, 4));
        $addTwenty = Phamda::partial($add, 2, 3, 15);
        $this->assertSame(20, $addTwenty());
    }

    public function testPartialN()
    {
        $add       = function ($x, $y, $z = 0) { return $x + $y + $z; };
        $addTen    = Phamda::partialN(3, $add, 10);
        $addTwenty = $addTen(10);
        $this->assertSame(25, $addTwenty(5));
    }

    public function testPartition()
    {
        $isPositive = function ($x) { return $x > 0; };
        $this->assertSame([[0 => 4, 2 => 7, 4 => 2, 5 => 88], [1 => -16, 3 => -3]], Phamda::partition($isPositive, [4, -16, 7, -3, 2, 88]));
    }

    public function testPipe()
    {
        $add5        = function ($x) { return $x + 5; };
        $square      = function ($x) { return $x ** 2; };
        $squareAdded = Phamda::pipe($add5, $square);
        $this->assertSame(81, $squareAdded(4));
        $hello      = function ($target) { return 'Hello ' . $target; };
        $helloUpper = Phamda::pipe('strtoupper', $hello);
        $upperHello = Phamda::pipe($hello, 'strtoupper');
        $this->assertSame('Hello WORLD', $helloUpper('world'));
        $this->assertSame('HELLO WORLD', $upperHello('world'));
    }

    public function testReduce()
    {
        $concat = function ($x, $y) { return $x . $y; };
        $this->assertSame('foobarbaz', Phamda::reduce($concat, 'foo', ['bar', 'baz']));
    }

    public function testReduceIndexed()
    {
        $concat = function ($accumulator, $value, $key) { return $accumulator . $key . $value; };
        $this->assertSame('nofoobarfizbuz', Phamda::reduceIndexed($concat, 'no', ['foo' => 'bar', 'fiz' => 'buz']));
    }

    public function testReduceRight()
    {
        $concat = function ($x, $y) { return $x . $y; };
        $this->assertSame('foobazbar', Phamda::reduceRight($concat, 'foo', ['bar', 'baz']));
    }

    public function testReduceRightIndexed()
    {
        $concat = function ($accumulator, $value, $key) { return $accumulator . $key . $value; };
        $this->assertSame('nofizbuzfoobar', Phamda::reduceRightIndexed($concat, 'no', ['foo' => 'bar', 'fiz' => 'buz']));
    }

    public function testReject()
    {
        $isEven = function ($x) { return $x % 2 === 0; };
        $this->assertSame([0 => 1, 2 => 3], Phamda::reject($isEven, [1, 2, 3, 4]));
    }

    public function testRejectIndexed()
    {
        $smallerThanNext = function ($value, $key, $list) { return isset($list[$key + 1]) ? $value < $list[$key + 1] : false; };
        $this->assertSame([1 => 6, 3 => 19], Phamda::rejectIndexed($smallerThanNext, [3, 6, 2, 19]));
    }

    public function testSort()
    {
        $sub = function ($a, $b) { return $a - $b; };
        $this->assertSame([1, 2, 3, 4], Phamda::sort($sub, [3, 2, 4, 1]));
    }

    public function testSortBy()
    {
        $getFoo     = function ($a) { return $a['foo']; };
        $collection = [['foo' => 16, 'bar' => 3], ['foo' => 5, 'bar' => 42], ['foo' => 11, 'bar' => 7]];
        $this->assertSame(
            [['foo' => 5, 'bar' => 42], ['foo' => 11, 'bar' => 7], ['foo' => 16, 'bar' => 3]],
            Phamda::sortBy($getFoo, $collection)
        );
    }

    public function testTap()
    {
        $addDay = function (\DateTime $date) { $date->add(new \DateInterval('P1D')); };
        $date   = new \DateTime('2015-03-15');
        $this->assertSame($date, Phamda::tap($addDay, $date));
        $this->assertSame('2015-03-16', $date->format('Y-m-d'));
    }

    public function testTimes()
    {
        $double = function ($number) { return $number * 2; };
        $this->assertSame([0, 2, 4, 6, 8], Phamda::times($double, 5));
    }

    public function testTrue()
    {
        $true = Phamda::true();
        $this->assertSame(true, $true());
    }

    public function testUnapply()
    {
        $concat = function (array $strings) { return implode(' ', $strings); };
        $this->assertSame('foo ba rba', Phamda::unapply($concat, 'foo', 'ba', 'rba'));
    }

    public function testUnary()
    {
        $add2 = function ($a = 0, $b = 0) { return $a + $b; };
        $add1 = Phamda::nAry(1, $add2);
        $this->assertSame(27, $add1(27, 15));
    }

    public function testZipWith()
    {
        $sum = function ($x, $y) { return $x + $y; };
        $this->assertSame([6, 8], Phamda::zipWith($sum, [1, 2, 3], [5, 6]));
    }
}
