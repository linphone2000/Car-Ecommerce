import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { prisma } from "@/lib/prisma";
import { formatPrice } from "@/lib/format";
import { Car, ShoppingBag, Users } from "lucide-react";
import Link from "next/link";

export default async function AdminDashboardPage() {
  const [itemCount, userCount, orderCount, recentOrders] = await Promise.all([
    prisma.item.count(),
    prisma.user.count({ where: { role: { not: "ADMIN" } } }),
    prisma.order.count(),
    prisma.order.findMany({
      take: 5,
      orderBy: { createdAt: "desc" },
      include: { user: true, items: true },
    }),
  ]);

  const stats = [
    { label: "Items", value: itemCount, icon: Car, href: "/admin/items" },
    { label: "Customers", value: userCount, icon: Users, href: "/admin/users" },
    { label: "Orders", value: orderCount, icon: ShoppingBag, href: "/admin/orders" },
  ];

  return (
    <div>
      <h1 className="font-heading text-3xl font-bold">Dashboard</h1>
      <p className="mt-1 text-muted-foreground">Overview of your showroom</p>

      <div className="mt-8 grid gap-4 sm:grid-cols-3">
        {stats.map(({ label, value, icon: Icon, href }) => (
          <Link key={label} href={href}>
            <Card className="transition-shadow hover:shadow-md">
              <CardHeader className="flex flex-row items-center justify-between pb-2">
                <CardTitle className="text-sm font-medium text-muted-foreground">
                  {label}
                </CardTitle>
                <Icon className="h-5 w-5 text-primary" />
              </CardHeader>
              <CardContent>
                <p className="text-3xl font-bold">{value}</p>
              </CardContent>
            </Card>
          </Link>
        ))}
      </div>

      <Card className="mt-8">
        <CardHeader>
          <CardTitle className="font-heading">Recent orders</CardTitle>
        </CardHeader>
        <CardContent>
          {recentOrders.length === 0 ? (
            <p className="text-sm text-muted-foreground">No orders yet.</p>
          ) : (
            <ul className="space-y-3">
              {recentOrders.map((order) => {
                const total = order.items.reduce(
                  (s, i) => s + i.unitPrice * i.quantity,
                  0
                );
                return (
                  <li
                    key={order.id}
                    className="flex items-center justify-between rounded-lg border border-border px-4 py-3 text-sm"
                  >
                    <div>
                      <span className="font-medium">Order #{order.id}</span>
                      <span className="mx-2 text-muted-foreground">·</span>
                      <span className="text-muted-foreground">
                        {order.user?.name ?? order.guestEmail ?? "Guest"}
                      </span>
                    </div>
                    <span className="font-semibold text-primary">{formatPrice(total)}</span>
                  </li>
                );
              })}
            </ul>
          )}
        </CardContent>
      </Card>
    </div>
  );
}
