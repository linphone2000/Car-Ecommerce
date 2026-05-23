"use client";

import { deleteOrder } from "@/actions/orders";
import { DeleteConfirmButton } from "@/components/admin/delete-confirm-button";
import { Input } from "@/components/ui/input";
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";
import { formatPrice } from "@/lib/format";
import { useMemo, useState } from "react";

type OrderRow = {
  id: number;
  createdAt: Date;
  customer: string;
  total: number;
  itemCount: number;
};

export function OrdersTable({ orders }: { orders: OrderRow[] }) {
  const [q, setQ] = useState("");
  const filtered = useMemo(() => {
    const term = q.toLowerCase();
    if (!term) return orders;
    return orders.filter(
      (o) =>
        o.customer.toLowerCase().includes(term) ||
        String(o.id).includes(term)
    );
  }, [orders, q]);

  return (
    <div className="space-y-4">
      <Input
        placeholder="Search orders..."
        value={q}
        onChange={(e) => setQ(e.target.value)}
        className="max-w-sm"
      />
      <div className="rounded-xl border border-border bg-card">
        <Table>
          <TableHeader>
            <TableRow>
              <TableHead>ID</TableHead>
              <TableHead>Customer</TableHead>
              <TableHead>Date</TableHead>
              <TableHead>Items</TableHead>
              <TableHead>Total</TableHead>
              <TableHead className="text-right">Actions</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            {filtered.map((order) => (
              <TableRow key={order.id}>
                <TableCell>#{order.id}</TableCell>
                <TableCell>{order.customer}</TableCell>
                <TableCell className="text-muted-foreground">
                  {new Date(order.createdAt).toLocaleDateString()}
                </TableCell>
                <TableCell>{order.itemCount}</TableCell>
                <TableCell className="font-medium">{formatPrice(order.total)}</TableCell>
                <TableCell className="text-right">
                  <DeleteConfirmButton
                    title="Delete order?"
                    description={`Remove order #${order.id} permanently.`}
                    onConfirm={async () => {
                      const fd = new FormData();
                      fd.set("id", String(order.id));
                      await deleteOrder(fd);
                    }}
                  />
                </TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </div>
    </div>
  );
}
