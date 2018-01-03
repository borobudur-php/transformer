<?php
/**
 * This file is part of the Borobudur package.
 *
 * (c) 2018 Borobudur <http://borobudur.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Borobudur\Component\Transformer;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
trait MutatorTrait
{
    protected function mutate(array $data): array
    {
        $mutated = [];
        foreach ($data as $attribute => $value) {
            $method = sprintf('transform%s', ucfirst($this->camelize($attribute)));

            if (method_exists($this, $method)) {
                $mutated[$attribute] = $this->{$method}($value);
            } else {
                $mutated[$attribute] = $value;
            }
        }

        return $mutated;
    }

    protected function camelize(string $text): string
    {
        return strtr(ucwords(strtr($text, array('_' => ' ', '.' => '_ ', '\\' => '_ '))), array(' ' => ''));
    }
}
