"use server";

import { auth } from "@/lib/auth";
import { getCart, setCart, type CartLine } from "@/lib/cart";
import { Role } from "@prisma/client";
import { revalidatePath } from "next/cache";

function defaultQty(role: Role | undefined) {
  if (role === Role.B2B) return 5;
  return 1;
}

export async function addToCart(formData: FormData) {
  const session = await auth();
  const itemId = Number(formData.get("itemId"));
  const name = String(formData.get("name"));
  const price = Number(formData.get("price"));
  const image = formData.get("image") ? String(formData.get("image")) : null;

  const cart = await getCart();
  const existing = cart.find((l) => l.itemId === itemId);
  const qty = defaultQty(session?.user?.role);

  let updated: CartLine[];
  if (existing) {
    updated = cart.map((l) =>
      l.itemId === itemId ? { ...l, quantity: l.quantity + 1 } : l
    );
  } else {
    updated = [...cart, { itemId, name, price, quantity: qty, image }];
  }

  await setCart(updated);
  revalidatePath("/cart");
  revalidatePath("/shop");
}

export async function updateCartQuantity(formData: FormData) {
  const itemId = Number(formData.get("itemId"));
  const delta = Number(formData.get("delta"));
  const cart = await getCart();
  const updated = cart
    .map((l) =>
      l.itemId === itemId ? { ...l, quantity: l.quantity + delta } : l
    )
    .filter((l) => l.quantity > 0);

  await setCart(updated);
  revalidatePath("/cart");
}

export async function removeFromCart(formData: FormData) {
  const itemId = Number(formData.get("itemId"));
  const cart = await getCart();
  await setCart(cart.filter((l) => l.itemId !== itemId));
  revalidatePath("/cart");
}
