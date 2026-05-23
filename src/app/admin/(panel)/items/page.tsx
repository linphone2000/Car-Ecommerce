import { ItemsTable } from "@/components/admin/items-table";
import { Button } from "@/components/ui/button";
import { prisma } from "@/lib/prisma";
import Link from "next/link";

export default async function AdminItemsPage() {
  const items = await prisma.item.findMany({ orderBy: { id: "asc" } });

  return (
    <div>
      <div className="flex items-center justify-between">
        <div>
          <h1 className="font-heading text-3xl font-bold">Items</h1>
          <p className="text-muted-foreground">Manage vehicle inventory</p>
        </div>
        <Button asChild>
          <Link href="/admin/items/new">Add item</Link>
        </Button>
      </div>
      <div className="mt-8">
        <ItemsTable items={items} />
      </div>
    </div>
  );
}
