import { Button } from "@/components/ui/button";
import { Car } from "lucide-react";
import Link from "next/link";

export function EmptyState({
  title = "No vehicles found",
  description = "Try adjusting your filters or search terms.",
}: {
  title?: string;
  description?: string;
}) {
  return (
    <div className="flex flex-col items-center justify-center rounded-xl border border-dashed border-border bg-card px-6 py-16 text-center">
      <Car className="h-12 w-12 text-muted-foreground" />
      <h2 className="mt-4 font-heading text-xl font-semibold">{title}</h2>
      <p className="mt-2 max-w-sm text-muted-foreground">{description}</p>
      <Button asChild className="mt-6">
        <Link href="/shop">View all inventory</Link>
      </Button>
    </div>
  );
}
