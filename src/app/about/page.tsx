import { Container } from "@/components/layout/container";
import { PageHeader } from "@/components/layout/page-header";
import { Card, CardContent } from "@/components/ui/card";

export default function AboutPage() {
  return (
    <Container className="py-10">
      <PageHeader
        title="About Rev Up Auto"
        description="Premium vehicles for retail buyers and B2B fleets"
      />
      <div className="grid gap-6 md:grid-cols-2">
        <Card>
          <CardContent className="p-6 text-muted-foreground leading-relaxed">
            Rev Up Auto is a modern car e-commerce platform built for retail shoppers
            and B2B fleet buyers. Browse inventory by category, manage your cart, and
            place orders with a secure checkout experience.
          </CardContent>
        </Card>
        <Card>
          <CardContent className="p-6 text-muted-foreground leading-relaxed">
            Our admin team manages vehicles, extended specifications, customer accounts,
            and order fulfillment from a dedicated dashboard — so every listing you see
            is curated and up to date.
          </CardContent>
        </Card>
      </div>
    </Container>
  );
}
