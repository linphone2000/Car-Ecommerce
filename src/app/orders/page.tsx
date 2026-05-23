import { Container } from "@/components/layout/container";
import { PageHeader } from "@/components/layout/page-header";
import { Alert, AlertDescription } from "@/components/ui/alert";
import { Badge } from "@/components/ui/badge";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Separator } from "@/components/ui/separator";
import { auth } from "@/lib/auth";
import { prisma } from "@/lib/prisma";
import { formatPrice } from "@/lib/format";
import { CheckCircle2 } from "lucide-react";
import { redirect } from "next/navigation";

type Props = { searchParams: Promise<{ success?: string }> };

export default async function OrdersPage({ searchParams }: Props) {
  const session = await auth();
  if (!session?.user?.id) redirect("/login");

  const { success } = await searchParams;

  const orders = await prisma.order.findMany({
    where: { userId: Number(session.user.id) },
    include: { items: true },
    orderBy: { createdAt: "desc" },
  });

  return (
    <Container className="py-10">
      <PageHeader title="Your orders" description="Track purchases and order details" />

      {success && (
        <Alert className="mb-8 border-green-200 bg-green-50">
          <CheckCircle2 className="h-4 w-4 text-green-700" />
          <AlertDescription className="text-green-900">
            Order placed successfully! Details are below.
          </AlertDescription>
        </Alert>
      )}

      {orders.length === 0 ? (
        <Card>
          <CardContent className="py-12 text-center text-muted-foreground">
            No orders yet. Start browsing our inventory.
          </CardContent>
        </Card>
      ) : (
        <div className="space-y-6">
          {orders.map((order) => {
            const total = order.items.reduce(
              (s, i) => s + i.unitPrice * i.quantity,
              0
            );
            return (
              <Card key={order.id}>
                <CardHeader className="flex flex-row items-start justify-between gap-4 pb-2">
                  <div>
                    <CardTitle className="font-heading text-lg">
                      Order #{order.id}
                    </CardTitle>
                    <p className="text-sm text-muted-foreground">
                      {order.createdAt.toLocaleString()}
                    </p>
                  </div>
                  <Badge variant="secondary">{formatPrice(total)}</Badge>
                </CardHeader>
                <CardContent>
                  <Separator className="mb-4" />
                  <ul className="space-y-2">
                    {order.items.map((item) => (
                      <li key={item.id} className="flex justify-between text-sm">
                        <span>
                          {item.name}{" "}
                          <span className="text-muted-foreground">×{item.quantity}</span>
                        </span>
                        <span className="font-medium">
                          {formatPrice(item.unitPrice * item.quantity)}
                        </span>
                      </li>
                    ))}
                  </ul>
                </CardContent>
              </Card>
            );
          })}
        </div>
      )}
    </Container>
  );
}
