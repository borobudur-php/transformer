<?php
/**
 * This file is part of the Borobudur package.
 *
 * (c) 2017 Borobudur <http://borobudur.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Borobudur\Component\Transformer;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
interface TransformerInterface
{
    /**
     * @param mixed $data
     * @param array $context
     *
     * @return array
     */
    public function transform($data, array $context = []): array;

    /**
     * @param mixed $data
     *
     * @return bool
     */
    public function supports($data): bool;
}
