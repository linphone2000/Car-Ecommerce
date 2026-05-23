import { Container } from "@/components/layout/container";
import { PageHeader } from "@/components/layout/page-header";
import { EmptyState } from "@/components/store/empty-state";
import { ProductCard } from "@/components/store/product-card";
import { ShopToolbar } from "@/components/store/shop-toolbar";
import { Alert, AlertDescription } from "@/components/ui/alert";
import { prisma } from "@/lib/prisma";
import type { Prisma } from "@prisma/client";
import { Suspense } from "react";

type Props = {
  searchParams: Promise<{ cat?: string; q?: string; success?: string; sort?: string }>;
};

function sortOrder(sort?: string): Prisma.ItemOrderByWithRelationInput {
  switch (sort) {
    case "price-asc":
      return { price: "asc" };
    case "price-desc":
      return { price: "desc" };
    case "name-desc":
      return { name: "desc" };
    default:
      return { name: "asc" };
  }
}

export default async function ShopPage({ searchParams }: Props) {
  const { cat, q, success, sort } = await searchParams;

  const categories = await prisma.item.findMany({
    select: { category: true },
    distinct: ["category"],
    orderBy: { category: "asc" },
  });

  const items = await prisma.item.findMany({
    where: {
      ...(cat ? { category: cat } : {}),
      ...(q
        ? {
            OR: [
              { name: { contains: q, mode: "insensitive" } },
              { description: { contains: q, mode: "insensitive" } },
            ],
          }
        : {}),
    },
    orderBy: sortOrder(sort),
  });

  const categoryList = categories.map((c) => c.category);

  return (
    <Container className="py-10">
      {success && (
        <Alert className="mb-6 border-green-200 bg-green-50 text-green-900">
          <AlertDescription>
            Order placed successfully! Sign in to view order history.
          </AlertDescription>
        </Alert>
      )}

      <PageHeader
        title="Shop inventory"
        description={`${items.length} vehicle${items.length === 1 ? "" : "s"} available${cat ? ` in ${cat}` : ""}`}
      />

      <Suspense fallback={<div className="h-24 animate-pulse rounded-lg bg-muted" />}>
        <ShopToolbar
          categories={categoryList}
          currentCat={cat}
          currentQ={q}
          currentSort={sort}
        />
      </Suspense>

      {items.length === 0 ? (
        <div className="mt-12">
          <EmptyState />
        </div>
      ) : (
        <div className="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {items.map((item) => (
            <ProductCard key={item.id} item={item} />
          ))}
        </div>
      )}
    </Container>
  );
}
