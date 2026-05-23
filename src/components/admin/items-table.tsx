"use client";

import { deleteItem } from "@/actions/items";
import { DeleteConfirmButton } from "@/components/admin/delete-confirm-button";
import { Button } from "@/components/ui/button";
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
import type { Item } from "@prisma/client";
import Image from "next/image";
import Link from "next/link";
import { useMemo, useState } from "react";

export function ItemsTable({ items }: { items: Item[] }) {
  const [q, setQ] = useState("");
  const filtered = useMemo(() => {
    const term = q.toLowerCase();
    if (!term) return items;
    return items.filter(
      (i) =>
        i.name.toLowerCase().includes(term) ||
        i.category.toLowerCase().includes(term)
    );
  }, [items, q]);

  return (
    <div className="space-y-4">
      <Input
        placeholder="Search items..."
        value={q}
        onChange={(e) => setQ(e.target.value)}
        className="max-w-sm"
      />
      <div className="rounded-xl border border-border bg-card">
        <Table>
          <TableHeader>
            <TableRow>
              <TableHead className="w-16">Img</TableHead>
              <TableHead>Name</TableHead>
              <TableHead>Category</TableHead>
              <TableHead>Price</TableHead>
              <TableHead className="text-right">Actions</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            {filtered.map((item) => (
              <TableRow key={item.id}>
                <TableCell>
                  <div className="relative h-10 w-14 overflow-hidden rounded bg-muted">
                    {item.image && (
                      <Image src={item.image} alt="" fill className="object-contain" />
                    )}
                  </div>
                </TableCell>
                <TableCell className="font-medium">{item.name}</TableCell>
                <TableCell>{item.category}</TableCell>
                <TableCell>{formatPrice(item.price)}</TableCell>
                <TableCell className="text-right">
                  <div className="flex justify-end gap-2">
                    <Button asChild variant="outline" size="sm">
                      <Link href={`/admin/items/${item.id}/edit`}>Edit</Link>
                    </Button>
                    <Button asChild variant="outline" size="sm">
                      <Link href={`/admin/items/${item.id}/details`}>Details</Link>
                    </Button>
                    <DeleteConfirmButton
                      title="Delete item?"
                      description={`Remove ${item.name} permanently.`}
                      onConfirm={async () => {
                        const fd = new FormData();
                        fd.set("id", String(item.id));
                        await deleteItem(fd);
                      }}
                    />
                  </div>
                </TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </div>
    </div>
  );
}
