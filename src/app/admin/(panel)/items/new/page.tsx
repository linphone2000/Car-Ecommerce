import { createItem } from "@/actions/items";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import Link from "next/link";

export default function NewItemPage() {
  return (
    <div className="max-w-lg">
      <h1 className="text-3xl font-bold">Add item</h1>
      <form action={createItem} className="mt-8 space-y-4 rounded-xl border border-slate-200 bg-white p-6">
        <div>
          <Label htmlFor="name">Name</Label>
          <Input id="name" name="name" required className="mt-1" />
        </div>
        <div>
          <Label htmlFor="category">Category</Label>
          <Input id="category" name="category" required className="mt-1" />
        </div>
        <div>
          <Label htmlFor="price">Price (USD)</Label>
          <Input id="price" name="price" type="number" required className="mt-1" />
        </div>
        <div>
          <Label htmlFor="description">Description</Label>
          <Input id="description" name="description" className="mt-1" />
        </div>
        <div>
          <Label htmlFor="image">Image</Label>
          <Input id="image" name="image" type="file" accept="image/*" className="mt-1" />
        </div>
        <div className="flex gap-2">
          <Button type="submit">Create</Button>
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
