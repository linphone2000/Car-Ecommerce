import { Container } from "@/components/layout/container";
import { PageHeader } from "@/components/layout/page-header";
import { Badge } from "@/components/ui/badge";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Separator } from "@/components/ui/separator";
import { auth } from "@/lib/auth";
import { prisma } from "@/lib/prisma";
import { redirect } from "next/navigation";

export default async function AccountPage() {
  const session = await auth();
  if (!session?.user?.id) redirect("/login");

  const user = await prisma.user.findUnique({
    where: { id: Number(session.user.id) },
  });
  if (!user) redirect("/login");

  return (
    <Container className="py-10">
      <PageHeader title="Account" description="Your profile and preferences" />

      <div className="grid gap-6 md:grid-cols-2">
        <Card>
          <CardHeader>
            <CardTitle className="font-heading">Profile</CardTitle>
          </CardHeader>
          <CardContent className="space-y-4">
            <div className="flex items-center gap-2">
              <span className="text-2xl font-bold">{user.name}</span>
              <Badge>{user.role}</Badge>
            </div>
            <Separator />
            <dl className="space-y-3 text-sm">
              <div>
                <dt className="text-muted-foreground">Email</dt>
                <dd className="font-medium">{user.email}</dd>
              </div>
              {user.payment && (
                <div>
                  <dt className="text-muted-foreground">Payment</dt>
                  <dd className="font-medium">{user.payment}</dd>
                </div>
              )}
            </dl>
          </CardContent>
        </Card>

        <Card>
          <CardHeader>
            <CardTitle className="font-heading">Address</CardTitle>
          </CardHeader>
          <CardContent>
            {user.address1 ? (
              <address className="text-sm not-italic leading-relaxed">
                {user.address1}
                {user.address2 && (
                  <>
                    <br />
                    {user.address2}
                  </>
                )}
                <br />
                {[user.city, user.state, user.zip].filter(Boolean).join(", ")}
              </address>
            ) : (
              <p className="text-sm text-muted-foreground">No address on file.</p>
            )}
          </CardContent>
        </Card>
      </div>
    </Container>
  );
}
