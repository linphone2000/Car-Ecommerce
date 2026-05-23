import { updateItem } from "@/actions/items";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { prisma } from "@/lib/prisma";
import Link from "next/link";
import { notFound } from "next/navigation";

type Props = { params: Promise<{ id: string }> };

export default async function EditItemPage({ params }: Props) {
  const { id } = await params;
  const item = await prisma.item.findUnique({ where: { id: Number(id) } });
  if (!item) notFound();

  return (
    <div className="max-w-lg">
      <h1 className="text-3xl font-bold">Edit item</h1>
      <form action={updateItem} className="mt-8 space-y-4 rounded-xl border border-slate-200 bg-white p-6">
        <input type="hidden" name="id" value={item.id} />
        <div>
          <Label htmlFor="name">Name</Label>
          <Input id="name" name="name" defaultValue={item.name} required className="mt-1" />
        </div>
        <div>
          <Label htmlFor="category">Category</Label>
          <Input id="category" name="category" defaultValue={item.category} required className="mt-1" />
        </div>
        <div>
          <Label htmlFor="price">Price (USD)</Label>
          <Input id="price" name="price" type="number" defaultValue={item.price} required className="mt-1" />
        </div>
        <div>
          <Label htmlFor="description">Description</Label>
          <Input id="description" name="description" defaultValue={item.description ?? ""} className="mt-1" />
        </div>
        <div>
          <Label htmlFor="image">Replace image</Label>
          <Input id="image" name="image" type="file" accept="image/*" className="mt-1" />
        </div>
        <div className="flex gap-2">
          <Button type="submit">Save</Button>
          <Link href="/admin/items">
            <Button type="button" variant="outline">
              Cancel
            </Button>
          </Link>
        </div>
      </form>
    </div>
  );
}
