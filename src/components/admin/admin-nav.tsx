"use client";

import { cn } from "@/lib/utils";
import {
  Car,
  ExternalLink,
  LayoutDashboard,
  Package,
  ShoppingBag,
  Users,
} from "lucide-react";
import Link from "next/link";
import { usePathname } from "next/navigation";

const links = [
  { href: "/admin", label: "Dashboard", icon: LayoutDashboard, exact: true },
  { href: "/admin/items", label: "Items", icon: Car },
  { href: "/admin/users", label: "Users", icon: Users },
  { href: "/admin/orders", label: "Orders", icon: ShoppingBag },
];

export function AdminNav() {
  const pathname = usePathname();

  return (
    <aside className="flex w-full flex-col border-b border-sidebar-border bg-sidebar text-sidebar-foreground md:w-56 md:border-b-0 md:border-r">
      <div className="border-b border-sidebar-border p-4">
        <p className="font-heading text-sm font-bold text-primary">ADMIN</p>
        <p className="text-xs text-sidebar-foreground/70">Rev Up Auto</p>
      </div>
      <nav className="flex flex-1 flex-row gap-1 overflow-x-auto p-2 md:flex-col md:overflow-visible">
        {links.map(({ href, label, icon: Icon, exact }) => {
          const active = exact ? pathname === href : pathname.startsWith(href);
          return (
            <Link
              key={href}
              href={href}
              className={cn(
                "flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium whitespace-nowrap transition-colors",
                active
                  ? "bg-primary text-primary-foreground"
                  : "text-sidebar-foreground/80 hover:bg-sidebar-accent hover:text-sidebar-accent-foreground"
              )}
            >
              <Icon className="h-4 w-4 shrink-0" />
              {label}
            </Link>
          );
        })}
      </nav>
      <div className="border-t border-sidebar-border p-3">
        <Link
          href="/"
          className="flex items-center gap-2 rounded-md px-3 py-2 text-sm text-sidebar-foreground/70 hover:text-primary"
        >
          <ExternalLink className="h-4 w-4" />
          View storefront
        </Link>
      </div>
    </aside>
  );
}
