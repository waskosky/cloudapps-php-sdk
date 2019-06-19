<?php

namespace CloudPrinter\CloudApps\Model;

use CloudPrinter\CloudApps\Exception\ValidationException;
use Particle\Validator\Validator;

/**
 * Class OrderQuoteItem
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class OrderQuoteItem implements ModelInterface
{
    /**
     * @var string OrderItem reference identifier
     */
    private $reference;

    /**
     * @var string Reference of the product
     */
    private $productReference;

    /**
     * @var int The number of copies
     */
    private $count;

    /**
     * @var array Array of zero or more option objects
     */
    private $options = [];

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return $this
     */
    public function setReference(string $reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductReference()
    {
        return $this->productReference;
    }

    /**
     * @param string $productReference
     * @return $this
     */
    public function setProductReference(string $productReference)
    {
        $this->productReference = $productReference;

        return $this;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return $this
     */
    public function setCount(int $count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param Option $option
     * @return $this
     */
    public function addOption(Option $option)
    {
        $this->options[] = $option;

        return $this;
    }

    /**
     * Object to array
     * @return array
     * @throws ValidationException
     */
    public function toArray()
    {
        $data = [
            'reference' => $this->getReference(),
            'product_reference' => $this->getProductReference(),
            'count' => $this->getCount(),
            'options' => [],
        ];

        /** @var Option $option */
        foreach ($this->getOptions() as $option) {
            $data['options'][] = $option->toArray();
        }

        $dataFiltered = array_filter($data);
        $this->validate($dataFiltered);

        return $dataFiltered;
    }

    /**
     * @param array $data
     * @return bool
     * @throws ValidationException
     */
    public function validate(array $data)
    {
        $validator = new Validator();
        $validator->required('reference');
        $validator->required('product_reference');
        $validator->required('count')->numeric();

        $result = $validator->validate($data);

        if ($result->isNotValid()) {
            throw new ValidationException(self::class, $result->getMessages());
        }

        return true;
    }
}
