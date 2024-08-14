<?php

namespace Drupal\practice1\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\practice1\Repository\PostNodeRepository;

/**
 *
 */
class BlogPageController extends ControllerBase {

  public function __construct(
    private PostNodeRepository $postNodeRepository,
  ) {
  }

  /**
   *
   */
  public function __invoke(): array {
    $nodes = $this->postNodeRepository->findAll();

    $build = [];
    $build['content']['#theme'] = 'item_list';
    foreach ($nodes as $node) {
      $build['content']['#items'][] = $node->label();
    }

    return $build;
  }

}
