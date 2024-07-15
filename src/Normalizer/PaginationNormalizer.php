<?php

namespace App\Normalizer;

use App\Entity\Habitat;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;


class PaginationNormalizer implements NormalizerInterface
{

    public function __construct (
        #[Autowire(service: 'serializer.normalizer.object')]
        private readonly NormalizerInterface $normalizer){
        
    }

    // public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    // {
    //     if (!$object instanceof PaginationInterface) {
    //         throw new \InvalidArgumentException('The object must be an instance of PaginationInterface.');
    //     }

    //     return [    
    //         'items' => array_map(fn (Habitat $habitat) => $this->normalizer->normalize($habitat, $format, $context), $object->getItems()),
    //         'total' => $object->getTotalItemCount(),
    //         'page' => $object->getCurrentPageNumber(),
    //         'lastPage' => ceil($object->getTotalItemCount()  / $object->getItemNumberPerPage()),
    //         'itemsPerPage' => $object->getItemNumberPerPage()
    //     ];
    // }

 public function normalize($object, string $format = null, array $context = []): array
{
    if (!$object instanceof PaginationInterface) {
        throw new \InvalidArgumentException('The object must be an instance of PaginationInterface.');
    }

    $itemsPerPage = $object->getItemNumberPerPage();
    if ($itemsPerPage <= 0) {
        throw new \LogicException('Items per page must be greater than zero.');
    }

    $totalItems = $object->getTotalItemCount();

    return [
        'items' => $this->normalizeItems($object->getItems(), $format, $context),
        'total' => $totalItems,
        'page' => $object->getCurrentPageNumber(),
        'lastPage' => max(1, ceil($totalItems / $itemsPerPage)),
        'itemsPerPage' => $itemsPerPage,
    ];
}

private function normalizeItems(iterable $items, ?string $format, array $context): array
{
    $normalizedItems = [];
    foreach ($items as $item) {
        $normalizedItems[] = $this->normalizer->normalize($item, $format, $context);
    }
    return $normalizedItems; 
}



    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof PaginationInterface;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            PaginationInterface::class => true
        ];
    }
}
