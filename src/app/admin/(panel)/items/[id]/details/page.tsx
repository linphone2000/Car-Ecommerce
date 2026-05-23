import { upsertItemDetails } from "@/actions/items";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { prisma } from "@/lib/prisma";
import Link from "next/link";
import { notFound } from "next/navigation";

type Props = { params: Promise<{ id: string }> };

export default async function ItemDetailsPage({ params }: Props) {
  const { id } = await params;
  const itemId = Number(id);
  const item = await prisma.item.findUnique({
    where: { id: itemId },
    include: { moreData: true },
  });
  if (!item) notFound();

  const d = item.moreData;

  return (
    <div className="max-w-lg">
      <h1 className="text-3xl font-bold">Details: {item.name}</h1>
      <form
        action={upsertItemDetails}
        className="mt-8 space-y-4 rounded-xl border border-slate-200 bg-white p-6"
      >
        <input type="hidden" name="itemId" value={item.id} />
        {[1, 2, 3, 4, 5, 6].map((n) => (
          <div key={n}>
            <Label htmlFor={`detail${n}`}>Detail {n}</Label>
            <Input
              id={`detail${n}`}
              name={`detail${n}`}
              defaultValue={(d as Record<string, string | null> | null)?.[`detail${n}`] ?? ""}
              className="mt-1"
            />
          </div>
        ))}
        {[1, 2, 3].map((n) => (
          <div key={`photo${n}`}>
            <Label htmlFor={`photo${n}`}>Photo {n}</Label>
            <Input id={`photo${n}`} name={`photo${n}`} type="file" accept="image/*" className="mt-1" />
          </div>
        ))}
        <div className="flex gap-2">
          <Button type="submit">Save details</Button>
          <Link href="/admin/items">
            <Button type="button" variant="outline">
              Back
            </Button>
          </Link>
        </div>
      </form>
    </div>
  );
}
