import { HeaderShell } from "@/components/layout/header-shell";
import { auth } from "@/lib/auth";
import { getCart } from "@/lib/cart";

export async function Header() {
  const [session, cart] = await Promise.all([auth(), getCart()]);
  return <HeaderShell cart={cart} session={session} />;
}
