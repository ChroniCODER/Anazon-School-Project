<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\ProductExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class ProductExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getProductById', [ProductExtensionRuntime::class, 'getProductById']),
        ];
    }
}
