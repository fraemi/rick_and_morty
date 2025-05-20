<?php
namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Testy integracyjne dla paginacji w widoku listy postaci
 */
class CharacterPaginationTest extends WebTestCase
{
  /**
   * Testuje paginację na pierwszej stronie
   *
   * Sprawdza:
   * - czy odpowiedź jest poprawna
   * - czy aktywna jest pierwsza strona
   * - czy przycisk "Poprzednia" jest nieklikalny (brak wcześniejszej strony)
   */
  public function testPaginationOnFirstPage(): void
  {
    $client = static::createClient();
    $crawler = $client->request('GET', '/?page=1');

    $this->assertResponseIsSuccessful();

    $this->assertSelectorTextContains('a[aria-current="page"]', '1');

    $this->assertSelectorExists('a.pointer-events-none.opacity-50:contains("Poprzednia")');
  }

  /**
   * Testuje poprawność struktury linków paginacyjnych na stronie środkowej
   *
   * Sprawdza, czy linki do poprzedniej i następnej strony są obecne
   */
  public function testPaginationLinkStructure(): void
  {
    $client = static::createClient();
    $crawler = $client->request('GET', '/?page=2');

    $this->assertResponseIsSuccessful();

    $this->assertSelectorExists('a[href="/?page=1"]');

    $this->assertSelectorExists('a[href="/?page=3"]');
  }

  /**
   * Testuje paginację na ostatniej stronie
   *
   * Sprawdza:
   * - czy aktywna jest ostatnia strona
   * - czy przycisk "Następna" jest nieklikalny (brak kolejnej strony)
   */
  public function testPaginationOnLastPage(): void
  {
    $client = static::createClient();


    $lastPage = 42;
    $crawler = $client->request('GET', '/?page=' . $lastPage);

    $this->assertResponseIsSuccessful();
    $this->assertSelectorTextContains('a[aria-current="page"]', (string) $lastPage);

    $this->assertSelectorExists('a.pointer-events-none.opacity-50:contains("Następna")');
  }
}