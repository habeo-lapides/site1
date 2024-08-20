<?php

namespace Drupal\Tests\practice1\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\node\Entity\Node;
use Drupal\practice1\Repository\PostNodeRepository;
use Drupal\Core\Datetime\DrupalDateTime;

class PostNodeRepositoryTest extends KernelTestBase {

  protected static $modules = ['node', 'practice1', 'user'];

  protected function setUp(): void {
    parent::setUp();
    $this->installEntitySchema('user');
    $this->installEntitySchema('node');
  }

  public function testPostsAreReturnedByCreatedDate(): void {
    // Arrange.
    $this->createTestNode([
      'created' => (new DrupalDateTime('-1 week'))->getTimestamp(),
      'title' => 'Post one',
      'type' => 'post',
    ]);

    $this->createTestNode([
      'created' => (new DrupalDateTime('-8 days'))->getTimestamp(),
      'title' => 'Post two',
      'type' => 'post',
    ]);

    $this->createTestNode([
      'created' => (new DrupalDateTime('yesterday'))->getTimestamp(),
      'title' => 'Post three',
      'type' => 'post',
    ]);

    // Act.
    $postRepository = $this->container->get(PostNodeRepository::class);
    self::assertInstanceOf(PostNodeRepository::class, $postRepository);
    $nodes = $postRepository->findAll();

    // Assert.
    self::assertCount(3, $nodes);
  }

  protected function createTestNode($type) {
    $node = Node::create([
      'type' => 'post',
      'title' => $this->randomMachineName(),
      'uid' => 1, // Set the user ID to an existing user ID.
    ]);
    $node->save();
  }
}
