"use server";

import { auth, isAdmin } from "@/lib/auth";
import { prisma } from "@/lib/prisma";
import { Role } from "@prisma/client";
import { revalidatePath } from "next/cache";
import { redirect } from "next/navigation";
import { z } from "zod";

async function requireAdmin() {
  const session = await auth();
  if (!session?.user || !isAdmin(session.user.role)) {
    throw new Error("Unauthorized");
  }
}

const userUpdateSchema = z.object({
  id: z.coerce.number(),
  name: z.string().min(1),
  email: z.string().email(),
  role: z.nativeEnum(Role),
  payment: z.string().optional(),
  address1: z.string().optional(),
  city: z.string().optional(),
  state: z.string().optional(),
  zip: z.string().optional(),
});

export async function updateUser(formData: FormData) {
  await requireAdmin();
  const parsed = userUpdateSchema.safeParse({
    id: formData.get("id"),
    name: formData.get("name"),
    email: formData.get("email"),
    role: formData.get("role"),
    payment: formData.get("payment") || undefined,
    address1: formData.get("address1") || undefined,
    city: formData.get("city") || undefined,
    state: formData.get("state") || undefined,
    zip: formData.get("zip") || undefined,
  });
  if (!parsed.success) redirect("/admin/users?error=1");

  await prisma.user.update({
    where: { id: parsed.data.id },
    data: {
      name: parsed.data.name,
      email: parsed.data.email.toLowerCase(),
      role: parsed.data.role,
      payment: parsed.data.payment,
      address1: parsed.data.address1,
      city: parsed.data.city,
      state: parsed.data.state,
      zip: parsed.data.zip,
    },
  });

  revalidatePath("/admin/users");
  redirect("/admin/users");
}

export async function deleteUser(formData: FormData) {
  await requireAdmin();
  const id = Number(formData.get("id"));
  if (!id) redirect("/admin/users?error=1");
  await prisma.order.deleteMany({ where: { userId: id } });
  await prisma.user.delete({ where: { id } });
  revalidatePath("/admin/users");
  redirect("/admin/users");
}
