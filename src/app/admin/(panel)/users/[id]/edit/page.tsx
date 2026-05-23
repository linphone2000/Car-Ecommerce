import { updateUser } from "@/actions/users";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { prisma } from "@/lib/prisma";
import { Role } from "@prisma/client";
import Link from "next/link";
import { notFound } from "next/navigation";

type Props = { params: Promise<{ id: string }> };

export default async function EditUserPage({ params }: Props) {
  const { id } = await params;
  const user = await prisma.user.findUnique({ where: { id: Number(id) } });
  if (!user || user.role === Role.ADMIN) notFound();

  return (
    <div className="max-w-lg">
      <h1 className="text-3xl font-bold">Edit user</h1>
      <form action={updateUser} className="mt-8 space-y-4 rounded-xl border border-slate-200 bg-white p-6">
        <input type="hidden" name="id" value={user.id} />
        <div>
          <Label htmlFor="name">Name</Label>
          <Input id="name" name="name" defaultValue={user.name} required className="mt-1" />
        </div>
        <div>
          <Label htmlFor="email">Email</Label>
          <Input id="email" name="email" type="email" defaultValue={user.email} required className="mt-1" />
        </div>
        <div>
          <Label htmlFor="role">Role</Label>
          <select
            id="role"
            name="role"
            defaultValue={user.role}
            className="mt-1 flex h-10 w-full rounded-md border border-slate-300 px-3 text-sm"
          >
            <option value="CUSTOMER">CUSTOMER</option>
            <option value="B2B">B2B</option>
          </select>
        </div>
        <div>
          <Label htmlFor="address1">Address</Label>
          <Input id="address1" name="address1" defaultValue={user.address1 ?? ""} className="mt-1" />
        </div>
        <div className="grid grid-cols-2 gap-4">
          <div>
            <Label htmlFor="city">City</Label>
            <Input id="city" name="city" defaultValue={user.city ?? ""} className="mt-1" />
          </div>
          <div>
            <Label htmlFor="state">State</Label>
            <Input id="state" name="state" defaultValue={user.state ?? ""} className="mt-1" />
          </div>
        </div>
        <div>
          <Label htmlFor="zip">ZIP</Label>
          <Input id="zip" name="zip" defaultValue={user.zip ?? ""} className="mt-1" />
        </div>
        <div className="flex gap-2">
          <Button type="submit">Save</Button>
          <Link href="/admin/users">
            <Button type="button" variant="outline">
              Cancel
            </Button>
          </Link>
        </div>
      </form>
    </div>
  );
}
