import { Container } from "@/components/layout/container";
import { PageHeader } from "@/components/layout/page-header";
import { QuantityStepper } from "@/components/store/quantity-stepper";
import { RemoveCartItemButton } from "@/components/store/remove-cart-item-button";
import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Separator } from "@/components/ui/separator";
import { cartCount, cartTotal, getCart } from "@/lib/cart";
import { formatPrice } from "@/lib/format";
import { ShoppingCart } from "lucide-react";
import Image from "next/image";
import Link from "next/link";

export default async function CartPage() {
  const cart = await getCart();
  const total = cartTotal(cart);
  const count = cartCount(cart);

  if (cart.length === 0) {
    return (
      <Container className="flex min-h-[50vh] flex-col items-center justify-center py-16 text-center">
        <ShoppingCart className="h-16 w-16 text-muted-foreground" />
        <h1 className="mt-6 font-heading text-3xl font-bold">Your cart is empty</h1>
        <p className="mt-2 text-muted-foreground">Discover your next vehicle in our showroom.</p>
        <Button asChild className="mt-8" size="lg">
          <Link href="/shop">Browse inventory</Link>
        </Button>
      </Container>
    );
  }

  return (
    <Container className="py-10">
      <PageHeader title="Your cart" description={`${count} item${count === 1 ? "" : "s"} in your order`} />

      <div className="grid gap-8 lg:grid-cols-3">
        <div className="space-y-4 lg:col-span-2">
          {cart.map((line) => (
            <Card key={line.itemId}>
              <CardContent className="flex flex-col gap-4 p-4 sm:flex-row sm:items-center">
                <Link
                  href={`/shop/${line.itemId}`}
                  className="relative h-24 w-32 shrink-0 overflow-hidden rounded-lg bg-muted"
                >
                  {line.image ? (
                    <Image src={line.image} alt="" fill className="object-contain p-2" />
                  ) : null}
                </Link>
                <div className="min-w-0 flex-1">
                  <Link
                    href={`/shop/${line.itemId}`}
                    className="font-semibold hover:text-primary"
                  >
                    {line.name}
                  </Link>
                  <p className="text-sm text-muted-foreground">
                    {formatPrice(line.price)} each
                  </p>
                  <div className="mt-3 flex flex-wrap items-center justify-between gap-3">
                    <QuantityStepper itemId={line.itemId} quantity={line.quantity} />
                    <RemoveCartItemButton itemId={line.itemId} name={line.name} />
                  </div>
                </div>
                <p className="text-lg font-bold sm:text-right">
                  {formatPrice(line.price * line.quantity)}
                </p>
              </CardContent>
            </Card>
          ))}
        </div>

        <div className="lg:sticky lg:top-24 lg:self-start">
          <Card>
            <CardContent className="space-y-4 p-6">
              <h2 className="font-heading text-lg font-semibold">Order summary</h2>
              <Separator />
              <div className="flex justify-between text-sm">
                <span className="text-muted-foreground">Subtotal ({count} items)</span>
                <span className="font-medium">{formatPrice(total)}</span>
              </div>
              <Separator />
              <div className="flex justify-between text-lg font-bold">
                <span>Total</span>
                <span className="text-primary">{formatPrice(total)}</span>
              </div>
              <Button asChild size="lg" className="w-full">
                <Link href="/checkout">Proceed to checkout</Link>
              </Button>
              <Button asChild variant="outline" className="w-full">
                <Link href="/shop">Continue shopping</Link>
              </Button>
            </CardContent>
          </Card>
        </div>
      </div>
    </Container>
  );
}
