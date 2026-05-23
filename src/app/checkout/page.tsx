import { placeOrder } from "@/actions/checkout";
import { Breadcrumbs } from "@/components/layout/breadcrumbs";
import { Container } from "@/components/layout/container";
import { PageHeader } from "@/components/layout/page-header";
import { Alert, AlertDescription } from "@/components/ui/alert";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Separator } from "@/components/ui/separator";
import { auth } from "@/lib/auth";
import { cartCount, cartTotal, getCart } from "@/lib/cart";
import { prisma } from "@/lib/prisma";
import { formatPrice } from "@/lib/format";
import { Role } from "@prisma/client";
import Image from "next/image";
import Link from "next/link";
import { redirect } from "next/navigation";

type Props = { searchParams: Promise<{ error?: string }> };

export default async function CheckoutPage({ searchParams }: Props) {
  const cart = await getCart();
  if (cart.length === 0) redirect("/cart");

  const { error } = await searchParams;
  const session = await auth();
  const user = session?.user?.id
    ? await prisma.user.findUnique({ where: { id: Number(session.user.id) } })
    : null;

  const total = cartTotal(cart);
  const count = cartCount(cart);
  const isB2B = user?.role === Role.B2B;

  return (
    <Container className="py-10">
      <Breadcrumbs
        items={[
          { label: "Home", href: "/" },
          { label: "Cart", href: "/cart" },
          { label: "Checkout" },
        ]}
      />
      <PageHeader title="Checkout" description="Complete your order" />

      {error === "guest-email" && (
        <Alert variant="destructive" className="mb-6">
          <AlertDescription>Email is required for guest checkout.</AlertDescription>
        </Alert>
      )}
      {error === "1" && (
        <Alert variant="destructive" className="mb-6">
          <AlertDescription>Please check your information and try again.</AlertDescription>
        </Alert>
      )}

      <div className="grid gap-8 lg:grid-cols-3">
        <div className="space-y-8 lg:col-span-2">
          {user ? (
            <Badge variant="secondary">Welcome back, {user.name}</Badge>
          ) : (
            <Badge variant="outline">Checking out as guest</Badge>
          )}

          <form action={placeOrder} className="space-y-8">
            <fieldset className="space-y-4 rounded-xl border border-border bg-card p-6">
              <legend className="px-1 font-heading text-lg font-semibold">Contact</legend>
              {!user && (
                <div>
                  <Label htmlFor="guestEmail">Email</Label>
                  <Input id="guestEmail" name="guestEmail" type="email" required className="mt-1" />
                </div>
              )}
              <div>
                <Label htmlFor="name">Full name</Label>
                <Input
                  id="name"
                  name="name"
                  defaultValue={user?.name ?? ""}
                  required
                  className="mt-1"
                />
              </div>
            </fieldset>

            <fieldset className="space-y-4 rounded-xl border border-border bg-card p-6">
              <legend className="px-1 font-heading text-lg font-semibold">Shipping</legend>
              <div>
                <Label htmlFor="address1">Address line 1</Label>
                <Input id="address1" name="address1" defaultValue={user?.address1 ?? ""} className="mt-1" />
              </div>
              <div>
                <Label htmlFor="address2">Address line 2</Label>
                <Input id="address2" name="address2" defaultValue={user?.address2 ?? ""} className="mt-1" />
              </div>
              <div className="grid grid-cols-2 gap-4">
                <div>
                  <Label htmlFor="city">City</Label>
                  <Input id="city" name="city" defaultValue={user?.city ?? ""} className="mt-1" />
                </div>
                <div>
                  <Label htmlFor="state">State</Label>
                  <Input id="state" name="state" defaultValue={user?.state ?? ""} className="mt-1" />
                </div>
              </div>
              <div>
                <Label htmlFor="zip">ZIP</Label>
                <Input id="zip" name="zip" defaultValue={user?.zip ?? ""} className="mt-1" />
              </div>
            </fieldset>

            <fieldset className="space-y-4 rounded-xl border border-border bg-card p-6">
              <legend className="px-1 font-heading text-lg font-semibold">Payment</legend>
              <div>
                <Label htmlFor="payment">Payment method</Label>
                <select
                  id="payment"
                  name="payment"
                  defaultValue={user?.payment ?? (isB2B ? "Invoice" : "Credit Card")}
                  className="mt-1 flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
                >
                  <option value="Credit Card">Credit Card</option>
                  <option value="Debit Card">Debit Card</option>
                  {isB2B && <option value="Invoice">Invoice (B2B)</option>}
                </select>
              </div>
              <div>
                <Label htmlFor="cardLast4">Card last 4 digits (optional)</Label>
                <Input
                  id="cardLast4"
                  name="cardLast4"
                  maxLength={4}
                  defaultValue={user?.cardLast4 ?? ""}
                  className="mt-1"
                />
              </div>
            </fieldset>

            <div className="flex gap-4">
              <Button type="submit" size="lg">
                Place order
              </Button>
              <Button type="button" variant="outline" size="lg" asChild>
                <Link href="/cart">Back to cart</Link>
              </Button>
            </div>
          </form>
        </div>

        <div className="lg:sticky lg:top-24 lg:self-start">
          <div className="rounded-xl border border-border bg-card p-6">
            <h2 className="font-heading text-lg font-semibold">Order summary</h2>
            <Separator className="my-4" />
            <ul className="max-h-64 space-y-3 overflow-y-auto">
              {cart.map((line) => (
                <li key={line.itemId} className="flex gap-3 text-sm">
                  <div className="relative h-12 w-16 shrink-0 rounded bg-muted">
                    {line.image && (
                      <Image src={line.image} alt="" fill className="object-contain p-0.5" />
                    )}
                  </div>
                  <div className="min-w-0 flex-1">
                    <p className="truncate font-medium">{line.name}</p>
                    <p className="text-muted-foreground">Qty {line.quantity}</p>
                  </div>
                  <span className="shrink-0 font-medium">
                    {formatPrice(line.price * line.quantity)}
                  </span>
                </li>
              ))}
            </ul>
            <Separator className="my-4" />
            <div className="flex justify-between text-sm text-muted-foreground">
              <span>{count} items</span>
            </div>
            <div className="mt-2 flex justify-between text-xl font-bold">
              <span>Total</span>
              <span className="text-primary">{formatPrice(total)}</span>
            </div>
          </div>
        </div>
      </div>
    </Container>
  );
}
