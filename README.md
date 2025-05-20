# Rick and Morty App

Aplikacja Symfony korzystająca z zewnętrznego API [Rick and Morty](https://rickandmortyapi.com). Umożliwia przeglądanie postaci z paginacją i stylizacją w Tailwind CSS.

---

## Wymagania

- [Docker](https://www.docker.com)
- [Docker Compose](https://docs.docker.com/compose)

## Wykorzystane technologie

- PHP v8.2.28
- Symfony v7.2.5
- Node.js v20.19.2
- npm v10.8.2
- Tailwind CSS v3.4.17

---

## Instalacja

### 1. Sklonuj repozytorium i przejdź do folderu projektu

```bash
git clone https://github.com/fraemi/rick_and_morty.git
cd rick_and_morty
```

### 2. Zbuduj i uruchom kontenery Dockera

```bash
docker-compose up --build
```

## Uruchamianie testów aplikacji

### 1. Uruchom kontenery Dockera

```bash
docker-compose up
```

### 2. Uruchom testy

```bash
docker-compose exec php php bin/phpunit
```
