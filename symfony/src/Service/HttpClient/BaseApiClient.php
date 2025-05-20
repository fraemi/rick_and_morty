<?php

namespace App\Service\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/*
Klient bazowy do wykonywania żądań HTTP
Udostępnia metodę request do wykonywania żądań HTTP z obsługą paginacji
 */
class BaseApiClient
{
  private HttpClientInterface $client;
  private string $baseUrl;

  /**
   * Konstruktor klasy BaseApiClient
   * @param HttpClientInterface $client Klient HTTP do wykonywania żądań
   * @param string $baseUrl Bazowy URL
   */
  public function __construct(
    HttpClientInterface $client,
    string $baseUrl
  ) {
    $this->client = $client;
    $this->baseUrl = $baseUrl;
  }

  /**
   * Wysyła żądanie HTTP do określonego endpointu
   * @param string $method Metoda HTTP
   * @param string $endpoint URL endpointu względem baseUrl (np. '/users')
   * @param array $options Opcje żądania
   * @param int|null $page Numer strony, jeśli paginacja jest używana
   * @throws \Exception Jeśli odpowiedź HTTP nie ma statusu 200
   * @return array Odpowiedź na żądanie w postacji tablicy
   */
  public function request(string $method, string $endpoint, array $options = [], ?int $page = null): array
  {
    $url = $this->baseUrl . $endpoint;

    $queryParams = $options['query'] ?? [];

    if ($page !== null) {
      $queryParams['page'] = $page;
    }

    $options['query'] = $queryParams;

    $response = $this->client->request($method, $url, $options);

    if ($response->getStatusCode() !== 200) {
      throw new \Exception('Żądanie nie powiodło się. Kod statusu: ' . $response->getStatusCode());
    }

    return $response->toArray();
  }
}