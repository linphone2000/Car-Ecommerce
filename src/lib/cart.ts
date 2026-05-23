import "server-only";

import type { CartLine } from "@/lib/cart-types";
import { cookies } from "next/headers";

export type { CartLine } from "@/lib/cart-types";
export { cartCount, cartTotal } from "@/lib/cart-types";

const CART_COOKIE = "rev_up_cart";

export async function getCart(): Promise<CartLine[]> {
  const cookieStore = await cookies();
  const raw = cookieStore.get(CART_COOKIE)?.value;
  if (!raw) return [];
  try {
    const parsed = JSON.parse(raw) as CartLine[];
    return Array.isArray(parsed) ? parsed : [];
  } catch {
    return [];
  }
}

export async function setCart(lines: CartLine[]) {
  const cookieStore = await cookies();
  cookieStore.set(CART_COOKIE, JSON.stringify(lines), {
    httpOnly: true,
    sameSite: "lax",
    path: "/",
    maxAge: 60 * 60 * 24 * 7,
  });
}

export async function clearCart() {
  const cookieStore = await cookies();
  cookieStore.delete(CART_COOKIE);
}
