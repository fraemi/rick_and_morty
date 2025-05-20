<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Testy integracyjne dla CharacterController
 */
class CharacterControllerTest extends WebTestCase
{
  /**
   * Testuje, czy strona z listą postaci renderuje się poprawnie
   *
   * Sprawdza: 
   * - status odpowiedzi
   * - obecność nagłówka H1
   * - tytuł strony zawiera odpowiedni tekst
   */
  public function testCharactersPageRendersSuccessfully(): void
  {
    $client = static::createClient();
    $client->request('GET', '/');

    $this->assertResponseIsSuccessful();
    $this->assertSelectorExists('h1');
    $this->assertPageTitleContains('Postacie w Rick and Morty');
  }
}
