# Rev Up Auto

Next.js car e-commerce app with Prisma and PostgreSQL. Replaces the legacy PHP storefront and admin.

## Stack

- Next.js 16 (App Router)
- Prisma 6 + PostgreSQL
- Auth.js (NextAuth v5) with credentials
- Tailwind CSS

## Setup

1. Install dependencies:

```bash
npm install
```

2. Copy environment variables:

```bash
cp .env.example .env
```

Generate a production `AUTH_SECRET`:

```bash
openssl rand -base64 32
```

3. Start PostgreSQL (Docker):

```bash
docker compose up -d
```

4. Run migrations and seed:

```bash
npx prisma migrate deploy
npm run db:seed
```

5. Start the dev server:

```bash
npm run dev
```

Open [http://localhost:3000](http://localhost:3000).

## Seed accounts

| Role     | Email                   | Password      |
|----------|-------------------------|---------------|
| Admin    | admin@revupauto.com     | password123   |
| Customer | customer@example.com    | password123   |
| B2B      | b2b@fleet.com           | password123   |

## Routes

| Area        | Paths |
|-------------|-------|
| Storefront  | `/`, `/shop`, `/shop/[id]`, `/cart`, `/checkout` |
| Account     | `/login`, `/register`, `/account`, `/orders` |
| Admin       | `/admin/login`, `/admin`, `/admin/items`, `/admin/users`, `/admin/orders` |

## Scripts

- `npm run dev` — development server
- `npm run build` — production build
- `npm run db:migrate` — create/apply migrations (dev)
- `npm run db:seed` — seed sample data
