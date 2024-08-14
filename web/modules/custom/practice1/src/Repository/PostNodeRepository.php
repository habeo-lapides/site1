<?php

namespace Drupal\practice1\Repository;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 *
 */
final class PostNodeRepository {

  public function __construct(
    private EntityTypeManagerInterface $entityTypeManager,
  ) {
  }

  /**
   *
   */
  public static function create(ContainerInterface $container): self {
    return new self(
        $container->get(PostNodeRepository::class),
      );
  }

  /**
   * @return array<int, NodeInterface>
   */
  public function findAll(): array {
    $nodeStorage = $this->entityTypeManager->getStorage('node');
    $nodes = $nodeStorage->loadMultiple();

    return $nodes
  }

}
