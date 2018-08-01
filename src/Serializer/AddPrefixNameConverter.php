<?php

namespace TwoDotsTwice\ISchoolApiClient\Serializer;

use function preg_quote;
use function preg_replace;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class AddPrefixNameConverter implements NameConverterInterface
{
    /**
     * @var string
     */
    private $prefix;

    /**
     * @var \Symfony\Component\Serializer\NameConverter\NameConverterInterface
     */
    private $nameConverter;

    public function __construct(string $prefix, NameConverterInterface $nameConverter)
    {
        $this->prefix = $prefix;
        $this->nameConverter = $nameConverter;
    }

    public function normalize($propertyName)
    {
        $normalized = $this->nameConverter->normalize($propertyName);

        return $this->prefix . $normalized;
    }

    public function denormalize($propertyName)
    {
        $pattern = '/^' . preg_quote($this->prefix) . '/';
        $propertyName = preg_replace($pattern, '', $propertyName);

        return $this->nameConverter->denormalize($propertyName);
    }
}
