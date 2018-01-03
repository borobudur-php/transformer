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

use RuntimeException;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class Registry
{
    /**
     * @var TransformerInterface[]
     */
    private $transformers = [];

    public function __construct(array $transformers = [])
    {
        foreach ($transformers as $transformer) {
            $this->add($transformer);
        }
    }

    public function add(TransformerInterface $transformer): void
    {
        $this->transformers[] = $transformer;
    }

    public function get(object $data): TransformerInterface
    {
        foreach ($this->transformers as $transformer) {
            if (true === $transformer->supports($data)) {
                return $transformer;
            }
        }

        throw new RuntimeException(sprintf('There are no transformer for given data "%s"', get_class($data)));
    }

    public function support(object $data): bool
    {
        foreach ($this->transformers as $transformer) {
            if (true === $transformer->supports($data)) {
                return true;
            }
        }

        return false;
    }
}
