<?php
namespace App\Service\HttpClient;

/*
Klient API do pobierania danych o postaciach z zewnętrznego źródła
*/
class CharacterApiClient
{
  private BaseApiClient $apiClient;

  /**
   * Konstruktor wykorzystujący bazowego klienta API, który obsługuje zapytania HTTP
   * @param BaseApiClient $apiClient Klient bazowy API
   */
  public function __construct(BaseApiClient $apiClient)
  {
    $this->apiClient = $apiClient;
  }

  /**
   * Funkcja pobierająca listę wszysktich postaci obsługująca paginację 
   * @param int $page Numer strony (domyślnie 1)
   * @return array{info: mixed, results: mixed} [
   *   'info' => informacje o wynikach (liczba wszystkich wyników, liczba stron)
   *   'results' => tablica wyników (postaci)
   * ]
   */
  public function getAllCharacters(int $page = 1): array
  {
    $response = $this->apiClient->request('GET', '/character/', [], $page);

    return [
      'info' => $response['info'] ?? null,
      'results' => $response['results'] ?? []
    ];
  }
}