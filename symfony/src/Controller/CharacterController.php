<?php

namespace App\Controller;

use App\Service\HttpClient\CharacterApiClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/** 
 * Kontroler odpowiedzialny za dane o postaciach
 */
class CharacterController extends AbstractController
{
  private CharacterApiClient $characterApiClient;

  /**
   * Konstruktor kontrolera wykorzystujący klienta API do pobierania danych o postaciach
   * @param CharacterApiClient $characterApiClient Klient API do pobierania danych o postaciach
   */
  public function __construct(CharacterApiClient $characterApiClient)
  {
    $this->characterApiClient = $characterApiClient;
  }

  #[Route('/', name: 'get_all_characters', methods: ['GET'])]
  /**
   * Wyświetla listę wszystkich postaci z paginacją
   *
   * @param Request $request Obiekt żądania HTTP
   * @return Response Renderowana strona z listą postaci
   */
  public function getAllCharacters(Request $request): Response
  {
    $page = $request->query->getInt('page', 1);
    $data = $this->characterApiClient->getAllCharacters($page);

    return $this->render('character/index.html.twig', [
      'characters' => $data['results'],
      'info' => $data['info'],
      'page' => $page
    ]);
  }
}