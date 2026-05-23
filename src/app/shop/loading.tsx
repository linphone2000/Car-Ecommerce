import { Container } from "@/components/layout/container";
import { Skeleton } from "@/components/ui/skeleton";

export default function ShopLoading() {
  return (
    <Container className="py-10">
      <Skeleton className="h-10 w-64" />
      <Skeleton className="mt-2 h-5 w-40" />
      <Skeleton className="mt-8 h-24 w-full" />
      <div className="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        {Array.from({ length: 6 }).map((_, i) => (
          <Skeleton key={i} className="aspect-[4/3] w-full rounded-xl" />
        ))}
      </div>
    </Container>
  );
}
