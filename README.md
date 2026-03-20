<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
# Jogo RPG (Laravel)
 
<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
Projeto web de RPG por turnos desenvolvido com Laravel, com foco em cadastro de jogadores, escolha de classes, batalhas PvE/PvP, progressão de nível e ranking.
 
## About Laravel
## ✨ Funcionalidades
 
Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:
 Cadastro e login de players.
 Escolha de classe/personagem.
 Batalhas por turnos contra computador e contra outros players.
 Sistema de XP e nível.
 Registro de vitórias/derrotas.
 Listagens de players, batalhas em andamento e totais por país.
 Tema claro/escuro via sessão.
 
 [Simple, fast routing engine](https://laravel.com/docs/routing).
 [Powerful dependency injection container](https://laravel.com/docs/container).
 Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
 Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
 Database agnostic [schema migrations](https://laravel.com/docs/migrations).
 [Robust background job processing](https://laravel.com/docs/queues).
 [Real-time event broadcasting](https://laravel.com/docs/broadcasting).
## 🧱 Stack
 
Laravel is accessible, powerful, and provides tools required for large, robust applications.
 **Backend:** PHP 8.5 + Laravel 12
 **Banco:** MySQL
 **Frontend build:** Vite + TailwindCSS
 **Container:** Docker (imagem PHP-FPM)
 
## Learning Laravel
## 📁 Estrutura principal
 
Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.
```text
app/
  Http/Controllers/      # Fluxos principais (cadastro, login, batalha, etc.)
  Http/Middleware/       # Regras de acesso
  Models/                # Entidades (Player, Batalha, Personagem, ...)
  Services/              # Regras de negócio auxiliares
routes/
  web.php                # Rotas da aplicação
database/migrations/     # Estrutura do banco
```
 
You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.
## ✅ Pré-requisitos
 
If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.
 PHP 8.5+
 Composer 2+
 Node.js 20+
 MySQL 8+
 
## Laravel Sponsors
## 🚀 Como rodar localmente
 
We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).
1. Clone o projeto.
2. Instale as dependências PHP:
 
### Premium Partners
```bash
composer install
```
 
 **[Vehikl](https://vehikl.com)**
 **[Tighten Co.](https://tighten.co)**
 **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
 **[64 Robots](https://64robots.com)**
 **[Curotec](https://www.curotec.com/services/technologies/laravel)**
 **[DevSquad](https://devsquad.com/hire-laravel-developers)**
 **[Redberry](https://redberry.international/laravel-development)**
 **[Active Logic](https://activelogic.com)**
3. Instale as dependências front-end:
 
## Contributing
```bash
npm install
```
 
Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).
4. Crie o arquivo de ambiente:
 
## Code of Conduct
```bash
cp .env.example .env
```
 
In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).
5. Gere a chave da aplicação:
 
## Security Vulnerabilities
```bash
php artisan key:generate
```
 
If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.
6. Ajuste as variáveis de banco no `.env`.
 
## License
7. Rode as migrations:
 
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
```bash
php artisan migrate
```

8. Inicie backend + queue + Vite:

```bash
composer run dev
```

> O comando acima sobe `php artisan serve`, `queue:listen` e `npm run dev` em paralelo.

## 🧪 Testes

Rodar testes:

```bash
php artisan test
```

Ou via script Composer:

```bash
composer test
```

## ⚙️ Variáveis de ambiente importantes

Baseado no `.env.example`, ajuste pelo menos:

 `APP_ENV`, `APP_KEY`, `APP_DEBUG`, `APP_URL`
 `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
 `SESSION_DRIVER`
 `CACHE_STORE`
 `QUEUE_CONNECTION`

## ☁️ Deploy (Railway)

Este projeto possui `Dockerfile`. Recomendações para deploy no Railway:

1. Configurar variáveis de ambiente de produção.
2. Garantir banco MySQL provisionado e acessível.
3. Rodar migrations no deploy (`php artisan migrate --force`).
4. Ajustar `APP_DEBUG=false` e `APP_ENV=production`.

Comando de start definido no Dockerfile:

```bash
php artisan migrate --force && php artisan optimize && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
```

## 🗺️ Roadmap técnico sugerido

 Trocar rotas com mutação de estado de `GET` para `POST/PUT/DELETE`.
 Fortalecer autenticação/autorização com `Auth`/guards.
 Adicionar índices únicos (`usuario`, `email`) e FKs faltantes no banco.
 Criar suíte de testes de feature para fluxos críticos.

## 👨‍💻 Autor

Projeto desenvolvido por **Luciano Eduardo Stefanello da Silva**.

---

Se quiser, eu também posso gerar uma versão deste README com **badges**, **GIFs da gameplay** e seção de **arquitetura** para portfólio.
