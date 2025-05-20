<?php
namespace App\Tests\Service;

use App\Service\HttpClient\CharacterApiClient;
use App\Service\HttpClient\BaseApiClient;
use PHPUnit\Framework\TestCase;
/**
 * Testy jednostkowy dla klasy CharacterApiClient
 */
class CharacterApiClientTest extends TestCase
{
  /**
   * Testuje, czy metoda getAllCharacters zwraca prawidłowe dane
   *
   * Symuluje odpowiedź z BaseApiClient i sprawdza
   * czy dane są poprawnie przetwarzane przez CharacterApiClient
   */
  public function testGetAllCharactersReturnsResults(): void
  {
    $mockBase = $this->createMock(BaseApiClient::class);
    $mockBase->method('request')->willReturn([
      'info' => ['pages' => 42],
      'results' => [['id' => 1, 'name' => 'Rick']]
    ]);

    $client = new CharacterApiClient($mockBase);
    $response = $client->getAllCharacters();

    $this->assertEquals(42, $response['info']['pages']);
    $this->assertCount(1, $response['results']);
    $this->assertEquals('Rick', $response['results'][0]['name']);
  }

  /**
   * Testuje, czy CharacterApiClient rzuca wyjątek, gdy BaseApiClient zgłasza błąd
   */
  public function testGetAllCharactersThrowsExceptionOnApiError(): void
  {
    $mockApiClient = $this->createMock(BaseApiClient::class);
    $mockApiClient->method('request')
      ->willThrowException(new \Exception('API error'));

    $client = new CharacterApiClient($mockApiClient);

    $this->expectException(\Exception::class);
    $client->getAllCharacters();
  }
}