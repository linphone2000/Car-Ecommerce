import { AddToCartButton } from "@/components/store/add-to-cart-button";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardFooter } from "@/components/ui/card";
import { formatPrice } from "@/lib/format";
import type { Item } from "@prisma/client";
import Image from "next/image";
import Link from "next/link";

export function ProductCard({ item }: { item: Item }) {
  return (
    <Card className="group overflow-hidden border-border/80 bg-card transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">
      <Link href={`/shop/${item.id}`} className="block">
        <div className="relative aspect-[4/3] overflow-hidden bg-muted">
          {item.image ? (
            <Image
              src={item.image}
              alt={item.name}
              fill
              className="object-cover p-2 transition-transform duration-500 group-hover:scale-105"
              sizes="(max-width: 768px) 100vw, 33vw"
            />
          ) : (
            <div className="flex h-full items-center justify-center text-muted-foreground">
              No image
            </div>
          )}
          <Badge className="absolute left-3 top-3 bg-header/80 text-header-foreground backdrop-blur">
            {item.category}
          </Badge>
        </div>
      </Link>
      <CardContent className="p-4 pb-2">
        <Link href={`/shop/${item.id}`}>
          <h3 className="font-heading text-lg font-semibold leading-tight hover:text-primary">
            {item.name}
          </h3>
        </Link>
        {item.description && (
          <p className="mt-1 line-clamp-2 text-sm text-muted-foreground">
            {item.description}
          </p>
        )}
        <p className="mt-3 text-xl font-bold text-primary">{formatPrice(item.price)}</p>
      </CardContent>
      <CardFooter className="flex gap-2 p-4 pt-0">
        <Button asChild variant="outline" size="sm" className="flex-1">
          <Link href={`/shop/${item.id}`}>Details</Link>
        </Button>
        <AddToCartButton
          itemId={item.id}
          name={item.name}
          price={item.price}
          image={item.image}
          className="flex-1"
        />
      </CardFooter>
    </Card>
  );
}
