import { UsersTable } from "@/components/admin/users-table";
import { prisma } from "@/lib/prisma";
import { Role } from "@prisma/client";

export default async function AdminUsersPage() {
  const users = await prisma.user.findMany({
    where: { role: { not: Role.ADMIN } },
    orderBy: { id: "asc" },
  });

  return (
    <div>
      <h1 className="font-heading text-3xl font-bold">Users</h1>
      <p className="mt-1 text-muted-foreground">Customer and B2B accounts</p>
      <div className="mt-8">
        <UsersTable users={users} />
      </div>
    </div>
  );
}
