"use client";

import { CartSheet } from "@/components/store/cart-sheet";
import { Button } from "@/components/ui/button";
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import {
  Sheet,
  SheetContent,
  SheetHeader,
  SheetTitle,
  SheetTrigger,
} from "@/components/ui/sheet";
import type { CartLine } from "@/lib/cart";
import { Role } from "@prisma/client";
import { SignOutButton } from "@/components/auth/sign-out-button";
import { Menu, User } from "lucide-react";
import Link from "next/link";
import { usePathname } from "next/navigation";

const navLinks = [
  { href: "/shop", label: "Shop" },
  { href: "/about", label: "About" },
  { href: "/contact", label: "Contact" },
];

export function HeaderShell({
  cart,
  session,
}: {
  cart: CartLine[];
  session: {
    user?: { name?: string | null; email?: string | null; role?: Role };
  } | null;
}) {
  const pathname = usePathname();
  const isAdmin = session?.user?.role === Role.ADMIN;

  return (
    <header className="sticky top-0 z-50 border-b border-white/10 bg-header/95 text-header-foreground backdrop-blur-md">
      <div className="mx-auto flex h-16 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6">
        <Link
          href="/"
          className="font-heading text-xl font-bold tracking-wide text-primary"
        >
          REV UP AUTO
        </Link>

        <nav className="hidden items-center gap-1 md:flex" aria-label="Main">
          {navLinks.map((link) => (
            <Link
              key={link.href}
              href={link.href}
              className={`rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-white/10 hover:text-primary ${
                pathname === link.href || pathname.startsWith(link.href + "/")
                  ? "text-primary"
                  : "text-header-foreground/90"
              }`}
            >
              {link.label}
            </Link>
          ))}
        </nav>

        <div className="flex items-center gap-1">
          <CartSheet cart={cart} />

          {session?.user ? (
            <DropdownMenu>
              <DropdownMenuTrigger
                render={
                  <Button
                    variant="ghost"
                    size="icon"
                    className="text-header-foreground hover:bg-white/10 hover:text-primary"
                    aria-label="Account menu"
                  />
                }
              >
                <User className="h-5 w-5" />
              </DropdownMenuTrigger>
              <DropdownMenuContent align="end" className="w-48">
                <div className="px-2 py-1.5 text-sm font-medium">
                  {session.user.name ?? session.user.email}
                </div>
                <DropdownMenuSeparator />
                <DropdownMenuItem render={<Link href="/account" />}>Account</DropdownMenuItem>
                <DropdownMenuItem render={<Link href="/orders" />}>Orders</DropdownMenuItem>
                {isAdmin && (
                  <DropdownMenuItem render={<Link href="/admin" />}>Admin</DropdownMenuItem>
                )}
                <DropdownMenuSeparator />
                <SignOutButton />
              </DropdownMenuContent>
            </DropdownMenu>
          ) : (
            <div className="hidden items-center gap-2 sm:flex">
              <Button
                asChild
                variant="ghost"
                size="sm"
                className="text-header-foreground hover:bg-white/10"
              >
                <Link href="/login">Sign in</Link>
              </Button>
              <Button asChild size="sm">
                <Link href="/register">Register</Link>
              </Button>
            </div>
          )}

          <Sheet>
            <SheetTrigger
              render={
                <Button
                  variant="ghost"
                  size="icon"
                  className="md:hidden text-header-foreground hover:bg-white/10"
                  aria-label="Open menu"
                />
              }
            >
              <Menu className="h-5 w-5" />
            </SheetTrigger>
            <SheetContent side="right" className="w-[280px]">
              <SheetHeader>
                <SheetTitle className="font-heading">Menu</SheetTitle>
              </SheetHeader>
              <nav className="mt-6 flex flex-col gap-2">
                {navLinks.map((link) => (
                  <Link
                    key={link.href}
                    href={link.href}
                    className="rounded-md px-3 py-2 text-sm font-medium hover:bg-muted"
                  >
                    {link.label}
                  </Link>
                ))}
                <Link href="/cart" className="rounded-md px-3 py-2 text-sm font-medium hover:bg-muted">
                  Cart
                </Link>
                {!session?.user && (
                  <>
                    <Link href="/login" className="rounded-md px-3 py-2 text-sm font-medium hover:bg-muted">
                      Sign in
                    </Link>
                    <Link href="/register" className="rounded-md px-3 py-2 text-sm font-medium hover:bg-muted">
                      Register
                    </Link>
                    <Link
                      href="/register?b2b=1"
                      className="rounded-md px-3 py-2 text-sm font-medium text-primary hover:bg-muted"
                    >
                      B2B fleet
                    </Link>
                  </>
                )}
              </nav>
            </SheetContent>
          </Sheet>
        </div>
      </div>
    </header>
  );
}
