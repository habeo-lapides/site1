<?php

namespace Drupal\Tests\practice1\Functional;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\node\NodeInterface;
use Drupal\Tests\BrowserTestBase;
use Symfony\Component\HttpFoundation\Response;


/**
 * Blog Page Test.
 *
 * @var string $defaultTheme
 * @var array{0: 'practice1', 1: 'node'} $modules
 */
class BlogPageTest extends BrowserTestBase {

  protected static $modules = ['practice1', 'node'];

  protected $defaultTheme = 'stark';

  /**
   *
   */
  public function testBlogPage(): void {

    $this->drupalGet('/blog');
    $this->assertSession()->statusCodeEquals(Response::HTTP_OK);

  }

  /**
   * Test if
   * @var unset $nodes
   *
   */
  public function testPostsAreVisible(): void {

    // Arrange.
    // $this->createNode(['type' => 'post', 'title' => 'First post']);
    // $this->createNode(['type' => 'post', 'title' => 'Second post']);
    // $this->createNode(['type' => 'post', 'title' => 'Third post']);
    // Arrange.
    $this->createNode([
      'created' => (new DrupalDateTime('-1 week'))->getTimestamp(),
      'title' => 'Post one',
      'type' => 'post',
    ]);

    $this->createNode([
      'created' => (new DrupalDateTime('-8 days'))->getTimestamp(),
      'title' => 'Post two',
      'type' => 'post',
    ]);

    $this->createNode([
      'created' => (new DrupalDateTime('yesterday'))->getTimestamp(),
      'title' => 'Post three',
      'type' => 'post',
    ]);

    // Act.
    $this->drupalGet('/blog');

    // Assert.
    $assert = $this->assertSession();
    $assert->pageTextContains('Post one');
    $assert->pageTextContains('Post two');
    $assert->pageTextContains('Post three');

  }

}
