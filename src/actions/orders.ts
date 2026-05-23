"use server";

import { auth, isAdmin } from "@/lib/auth";
import { prisma } from "@/lib/prisma";
import { revalidatePath } from "next/cache";
import { redirect } from "next/navigation";

async function requireAdmin() {
  const session = await auth();
  if (!session?.user || !isAdmin(session.user.role)) {
    throw new Error("Unauthorized");
  }
}

export async function deleteOrder(formData: FormData) {
  await requireAdmin();
  const id = Number(formData.get("id"));
  if (!id) redirect("/admin/orders?error=1");
  await prisma.order.delete({ where: { id } });
  revalidatePath("/admin/orders");
  redirect("/admin/orders");
}
