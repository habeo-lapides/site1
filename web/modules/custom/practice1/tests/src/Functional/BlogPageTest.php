<?php

namespace Drupal\Tests\practice1\Functional;

use Drupal\Tests\BrowserTestBase;
use Symfony\Component\HttpFoundation\Response;

/**
 *
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
   *
   */
  public function testPostsAreVisible(): void {

    // Arrange.
    $this->createNode(['type' => 'post', 'title' => 'First post']);
    $this->createNode(['type' => 'post', 'title' => 'Second post']);
    $this->createNode(['type' => 'post', 'title' => 'Third post']);

    // Act.
    $this->drupalGet('/blog');

    // Assert.
    $assert = $this->assertSession();
    $assert->pageTextContains('First post');
    $assert->pageTextContains('Second post');
    $assert->pageTextContains('Third post');
  }

}
