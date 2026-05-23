import { Container } from "@/components/layout/container";
import { Button } from "@/components/ui/button";
import Link from "next/link";

export default function ProductNotFound() {
  return (
    <Container className="flex min-h-[50vh] flex-col items-center justify-center py-16 text-center">
      <h1 className="font-heading text-3xl font-bold">Vehicle not found</h1>
      <p className="mt-2 text-muted-foreground">
        This listing may have been removed or the link is incorrect.
      </p>
      <Button asChild className="mt-8">
        <Link href="/shop">Back to shop</Link>
      </Button>
    </Container>
  );
}
