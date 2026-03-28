# ⚔️ Jogo RPG (Laravel)

Aplicação web de RPG por turnos desenvolvida com **Laravel**, com foco em:
- cadastro e autenticação de jogadores,
- escolha de classe/personagem,
- batalhas PvE/PvP,
- progressão de nível,
- ranking e registros de batalha.

---

## ✨ Funcionalidades

- Cadastro, login, atualização e exclusão de player.
- Escolha de classe com atributos e skills.
- Batalha por turnos contra computador e contra outros players.
- Sistema de XP / nível.
- Registro de vitórias e derrotas.
- Listagens de players, batalhas em andamento e totais por país.
- Tema claro/escuro via sessão.

---

## 🧱 Stack

- **Backend:** PHP 8.5 + Laravel 12
- **Banco de dados:** MySQL 8
- **Frontend build:** Vite + CSS/JS
- **Testes:** Pest / PHPUnit (feature tests)
- **Containerização:** Docker

---

## 📁 Estrutura principal

```text
app/
  Http/Controllers/      # Fluxos principais (cadastro, login, batalha, etc.)
  Http/Middleware/       # Regras de acesso
  Models/                # Entidades (Player, Batalha, Personagem, ...)
  Services/              # Regras de negócio auxiliares
routes/
  web.php                # Rotas da aplicação
database/
  migrations/            # Estrutura do banco
  seeders/               # Dados iniciais
resources/views/         # Telas Blade
tests/                   # Testes automatizados
```

---

## ✅ Pré-requisitos

- PHP 8.5+
- Composer 2+
- Node.js 20+
- MySQL 8+

---

## 🚀 Como rodar localmente

1. Clone o projeto:

```bash
git clone <url-do-repositorio>
cd jogo_rpg
```

2. Instale dependências PHP:

```bash
composer install
```

3. Instale dependências front-end:

```bash
npm install
```

4. Crie o arquivo de ambiente:

```bash
cp .env.example .env
```

5. Gere a chave da aplicação:

```bash
php artisan key:generate
```

6. Configure as variáveis de banco no `.env`.

7. Rode as migrations:

```bash
php artisan migrate
```

8. Suba o ambiente de desenvolvimento (server + queue + vite):
 
```bash
composer run dev
```

> O comando acima executa `php artisan serve`, `queue:listen` e `npm run dev` em paralelo.

---
 
## 🧪 Testes

Rodar suíte de testes:
 
```bash
php artisan test
```

Ou via Composer:
 
```bash
composer test
```
 
---

## ⚙️ Variáveis de ambiente importantes

Ajuste pelo menos:

- `APP_ENV`, `APP_KEY`, `APP_DEBUG`, `APP_URL`
- `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- `SESSION_DRIVER`
- `CACHE_STORE`
- `QUEUE_CONNECTION`

---

## 🐳 Docker

Este projeto possui `Dockerfile` para facilitar execução/deploy.

Exemplo de build e run:

```bash
docker build -t jogo-rpg .
docker run -p 8000:8000 --env-file .env jogo-rpg
```

Comando de start definido no container:
 
```bash
php artisan migrate --force && php artisan optimize && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
```

---

## ☁️ Deploy (ex.: Railway)

Checklist recomendado:

1. Configurar variáveis de ambiente de produção.
2. Garantir banco MySQL provisionado e acessível.
3. Rodar migrations no deploy (`php artisan migrate --force`).
4. Definir `APP_DEBUG=false` e `APP_ENV=production`.
 
---

## 🗺️ Roadmap técnico sugerido

- Reforçar autenticação/autorização (policies/guards).
- Evoluir cobertura de testes para fluxos PvP e edge cases.
- Melhorar observabilidade (logs, métricas, alertas).
- Balanceamento de classes e progressão.

---

## 👨‍💻 Autor

Projeto desenvolvido por **Luciano Eduardo Stefanello da Silva**.