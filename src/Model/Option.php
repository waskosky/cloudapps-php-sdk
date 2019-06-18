<?php

namespace CloudPrinter\CloudApps\Model;

use CloudPrinter\CloudApps\Exception\ValidationException;
use Particle\Validator\Validator;

/**
 * Class Option
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class Option implements ModelInterface
{
    /**
     * @var string Reference of the option
     */
    private $optionReference;

    /**
     * @var int The number of times the specific option is used per item.
     */
    private $count;

    /**
     * Option constructor.
     * @param string $optionReference
     * @param int $count
     */
    public function __construct(string $optionReference = null, int $count = null)
    {
        if ($optionReference) {
            $this->setOptionReference($optionReference);
        }

        if ($count) {
            $this->setCount($count);
        }
    }

    /**
     * @return string
     */
    public function getOptionReference()
    {
        return $this->optionReference;
    }

    /**
     * @param string $optionReference
     * @return $this
     */
    public function setOptionReference(string $optionReference)
    {
        $this->optionReference = $optionReference;

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
     * Object to array
     * @return array
     * @throws ValidationException
     */
    public function toArray()
    {
        $data = [
            'option_reference' => $this->getOptionReference(),
            'count' => $this->getCount(),
        ];

        $this->validate($data);

        return $data;
    }

    /**
     * @param array $data
     * @return bool
     * @throws ValidationException
     */
    public function validate(array $data)
    {
        $validator = new Validator();
        $validator->required('option_reference');
        $validator->required('count');

        $result = $validator->validate($data);

        if ($result->isNotValid()) {
            throw new ValidationException(self::class, $result->getMessages());
        }

        return true;
    }
}
