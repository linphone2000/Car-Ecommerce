import { Breadcrumbs } from "@/components/layout/breadcrumbs";
import { Container } from "@/components/layout/container";
import { AddToCartButton } from "@/components/store/add-to-cart-button";
import { ProductCard } from "@/components/store/product-card";
import { ProductGallery } from "@/components/store/product-gallery";
import { ProductSpecs } from "@/components/store/product-specs";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { Separator } from "@/components/ui/separator";
import { prisma } from "@/lib/prisma";
import { formatPrice } from "@/lib/format";
import type { Metadata } from "next";
import Link from "next/link";
import { notFound } from "next/navigation";

type Props = { params: Promise<{ id: string }> };

export async function generateMetadata({ params }: Props): Promise<Metadata> {
  const { id } = await params;
  const item = await prisma.item.findUnique({ where: { id: Number(id) } });
  if (!item) return { title: "Vehicle not found" };
  return {
    title: item.name,
    description: item.description ?? `View ${item.name} at Rev Up Auto`,
  };
}

export default async function ProductDetailPage({ params }: Props) {
  const { id } = await params;
  const itemId = Number(id);
  if (Number.isNaN(itemId)) notFound();

  const item = await prisma.item.findUnique({
    where: { id: itemId },
    include: { moreData: true },
  });
  if (!item) notFound();

  const details = [
    item.moreData?.detail1,
    item.moreData?.detail2,
    item.moreData?.detail3,
    item.moreData?.detail4,
    item.moreData?.detail5,
    item.moreData?.detail6,
  ].filter(Boolean) as string[];

  const extraPhotos = [
    item.moreData?.photo1,
    item.moreData?.photo2,
    item.moreData?.photo3,
  ].filter(Boolean) as string[];

  const related = await prisma.item.findMany({
    where: { category: item.category, id: { not: item.id } },
    take: 3,
  });

  return (
    <Container className="py-10">
      <Breadcrumbs
        items={[
          { label: "Home", href: "/" },
          { label: "Shop", href: "/shop" },
          { label: item.name },
        ]}
      />

      <div className="grid gap-10 lg:grid-cols-2 lg:gap-12">
        <ProductGallery
          mainImage={item.image}
          extraPhotos={extraPhotos}
          alt={item.name}
        />

        <div className="lg:sticky lg:top-24 lg:self-start">
          <Badge variant="secondary">{item.category}</Badge>
          <h1 className="mt-3 font-heading text-3xl font-bold md:text-4xl">{item.name}</h1>
          <p className="mt-4 text-3xl font-bold text-primary">{formatPrice(item.price)}</p>
          {item.description && (
            <p className="mt-4 text-muted-foreground leading-relaxed">{item.description}</p>
          )}
          <Separator className="my-6" />
          <div className="flex flex-col gap-3 sm:flex-row">
            <AddToCartButton
              itemId={item.id}
              name={item.name}
              price={item.price}
              image={item.image}
              size="lg"
              label="Add to cart"
              className="flex-1"
            />
            <Button asChild variant="outline" size="lg" className="flex-1">
              <Link href="/cart">View cart</Link>
            </Button>
          </div>
        </div>
      </div>

      <ProductSpecs details={details} />

      {related.length > 0 && (
        <section className="mt-16">
          <h2 className="font-heading text-2xl font-bold">Related vehicles</h2>
          <div className="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            {related.map((r) => (
              <ProductCard key={r.id} item={r} />
            ))}
          </div>
        </section>
      )}
    </Container>
  );
}
