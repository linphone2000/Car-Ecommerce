"use client";

import { removeFromCart } from "@/actions/cart";
import { QuantityStepper } from "@/components/store/quantity-stepper";
import { Button, buttonVariants } from "@/components/ui/button";
import { cn } from "@/lib/utils";
import { Separator } from "@/components/ui/separator";
import {
  Sheet,
  SheetContent,
  SheetHeader,
  SheetTitle,
  SheetTrigger,
} from "@/components/ui/sheet";
import type { CartLine } from "@/lib/cart-types";
import { cartCount, cartTotal } from "@/lib/cart-types";
import { formatPrice } from "@/lib/format";
import { ShoppingCart } from "lucide-react";
import Image from "next/image";
import Link from "next/link";
import { useRouter } from "next/navigation";
import { useState, useTransition } from "react";

export function CartSheet({ cart }: { cart: CartLine[] }) {
  const [open, setOpen] = useState(false);
  const count = cartCount(cart);
  const total = cartTotal(cart);
  const [pending, startTransition] = useTransition();
  const router = useRouter();

  function remove(itemId: number) {
    const formData = new FormData();
    formData.set("itemId", String(itemId));
    startTransition(async () => {
      await removeFromCart(formData);
      router.refresh();
    });
  }

  return (
    <Sheet open={open} onOpenChange={setOpen}>
      <SheetTrigger
        className={cn(
          buttonVariants({ variant: "ghost", size: "icon" }),
          "relative text-header-foreground hover:bg-white/10 hover:text-primary"
        )}
        aria-label={`Cart, ${count} items`}
      >
        <ShoppingCart className="h-5 w-5" />
        {count > 0 && (
          <span className="absolute -right-0.5 -top-0.5 flex h-5 min-w-5 items-center justify-center rounded-full bg-primary px-1 text-[10px] font-bold text-primary-foreground">
            {count}
          </span>
        )}
      </SheetTrigger>
      <SheetContent className="flex w-full flex-col sm:max-w-md">
        <SheetHeader>
          <SheetTitle className="font-heading">Your cart</SheetTitle>
        </SheetHeader>
        {cart.length === 0 ? (
          <div className="flex flex-1 flex-col items-center justify-center gap-4 text-center">
            <ShoppingCart className="h-12 w-12 text-muted-foreground" />
            <p className="text-muted-foreground">Your cart is empty</p>
            <Button asChild onClick={() => setOpen(false)}>
              <Link href="/shop">Browse inventory</Link>
            </Button>
          </div>
        ) : (
          <>
            <ul className="flex-1 space-y-4 overflow-y-auto py-4">
              {cart.map((line) => (
                <li key={line.itemId} className="flex gap-3">
                  <div className="relative h-16 w-20 shrink-0 overflow-hidden rounded-md bg-muted">
                    {line.image ? (
                      <Image
                        src={line.image}
                        alt=""
                        fill
                        className="object-contain p-1"
                      />
                    ) : null}
                  </div>
                  <div className="min-w-0 flex-1">
                    <p className="truncate font-medium">{line.name}</p>
                    <p className="text-sm text-muted-foreground">
                      {formatPrice(line.price)} each
                    </p>
                    <div className="mt-2 flex items-center justify-between gap-2">
                      <QuantityStepper itemId={line.itemId} quantity={line.quantity} />
                      <Button
                        type="button"
                        variant="ghost"
                        size="sm"
                        className="text-destructive"
                        disabled={pending}
                        onClick={() => remove(line.itemId)}
                      >
                        Remove
                      </Button>
                    </div>
                  </div>
                </li>
              ))}
            </ul>
            <Separator />
            <div className="space-y-3 pt-2">
              <div className="flex justify-between text-lg font-semibold">
                <span>Subtotal</span>
                <span>{formatPrice(total)}</span>
              </div>
              <Button asChild className="w-full" onClick={() => setOpen(false)}>
                <Link href="/cart">View full cart</Link>
              </Button>
              <Button asChild variant="secondary" className="w-full" onClick={() => setOpen(false)}>
                <Link href="/checkout">Checkout</Link>
              </Button>
            </div>
          </>
        )}
      </SheetContent>
    </Sheet>
  );
}
