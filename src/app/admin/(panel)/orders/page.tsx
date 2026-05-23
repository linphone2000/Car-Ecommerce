import { OrdersTable } from "@/components/admin/orders-table";
import { prisma } from "@/lib/prisma";

export default async function AdminOrdersPage() {
  const orders = await prisma.order.findMany({
    include: { user: true, items: true },
    orderBy: { createdAt: "desc" },
  });

  const rows = orders.map((order) => ({
    id: order.id,
    createdAt: order.createdAt,
    customer: order.user?.name ?? order.guestEmail ?? "Guest",
    itemCount: order.items.length,
    total: order.items.reduce((s, i) => s + i.unitPrice * i.quantity, 0),
  }));

  return (
    <div>
      <h1 className="font-heading text-3xl font-bold">Orders</h1>
      <p className="mt-1 text-muted-foreground">All customer and guest orders</p>
      <div className="mt-8">
        <OrdersTable orders={rows} />
      </div>
    </div>
  );
}
