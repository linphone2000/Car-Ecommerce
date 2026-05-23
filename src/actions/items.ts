"use server";

import { auth, isAdmin } from "@/lib/auth";
import { prisma } from "@/lib/prisma";
import { revalidatePath } from "next/cache";
import { redirect } from "next/navigation";
import { writeFile, mkdir } from "fs/promises";
import path from "path";
import { z } from "zod";

async function requireAdmin() {
  const session = await auth();
  if (!session?.user || !isAdmin(session.user.role)) {
    throw new Error("Unauthorized");
  }
}

const itemSchema = z.object({
  name: z.string().min(1),
  category: z.string().min(1),
  price: z.coerce.number().int().positive(),
  description: z.string().optional(),
});

export async function createItem(formData: FormData) {
  await requireAdmin();
  const parsed = itemSchema.safeParse({
    name: formData.get("name"),
    category: formData.get("category"),
    price: formData.get("price"),
    description: formData.get("description") || undefined,
  });
  if (!parsed.success) redirect("/admin/items/new?error=1");

  let imagePath: string | undefined;
  const file = formData.get("image") as File | null;
  if (file && file.size > 0) {
    imagePath = await saveImage(file);
  }

  await prisma.item.create({
    data: { ...parsed.data, image: imagePath },
  });

  revalidatePath("/shop");
  revalidatePath("/admin/items");
  redirect("/admin/items");
}

export async function updateItem(formData: FormData) {
  await requireAdmin();
  const id = Number(formData.get("id"));
  const parsed = itemSchema.safeParse({
    name: formData.get("name"),
    category: formData.get("category"),
    price: formData.get("price"),
    description: formData.get("description") || undefined,
  });
  if (!parsed.success || !id) redirect("/admin/items?error=1");

  const data: { name: string; category: string; price: number; description?: string; image?: string } = {
    ...parsed.data,
  };

  const file = formData.get("image") as File | null;
  if (file && file.size > 0) {
    data.image = await saveImage(file);
  }

  await prisma.item.update({ where: { id }, data });
  revalidatePath("/shop");
  revalidatePath(`/shop/${id}`);
  revalidatePath("/admin/items");
  redirect("/admin/items");
}

export async function deleteItem(formData: FormData) {
  await requireAdmin();
  const id = Number(formData.get("id"));
  if (!id) redirect("/admin/items?error=1");
  await prisma.item.delete({ where: { id } });
  revalidatePath("/shop");
  revalidatePath("/admin/items");
  redirect("/admin/items");
}

const detailsSchema = z.object({
  itemId: z.coerce.number(),
  detail1: z.string().optional(),
  detail2: z.string().optional(),
  detail3: z.string().optional(),
  detail4: z.string().optional(),
  detail5: z.string().optional(),
  detail6: z.string().optional(),
});

export async function upsertItemDetails(formData: FormData) {
  await requireAdmin();
  const parsed = detailsSchema.safeParse({
    itemId: formData.get("itemId"),
    detail1: formData.get("detail1") || undefined,
    detail2: formData.get("detail2") || undefined,
    detail3: formData.get("detail3") || undefined,
    detail4: formData.get("detail4") || undefined,
    detail5: formData.get("detail5") || undefined,
    detail6: formData.get("detail6") || undefined,
  });
  if (!parsed.success) redirect("/admin/items?error=1");

  const photo1 = await optionalPhoto(formData.get("photo1") as File | null);
  const photo2 = await optionalPhoto(formData.get("photo2") as File | null);
  const photo3 = await optionalPhoto(formData.get("photo3") as File | null);

  const { itemId, ...detailFields } = parsed.data;
  await prisma.itemMoreData.upsert({
    where: { itemId },
    create: {
      itemId,
      ...detailFields,
      photo1,
      photo2,
      photo3,
    },
    update: {
      detail1: parsed.data.detail1,
      detail2: parsed.data.detail2,
      detail3: parsed.data.detail3,
      detail4: parsed.data.detail4,
      detail5: parsed.data.detail5,
      detail6: parsed.data.detail6,
      ...(photo1 ? { photo1 } : {}),
      ...(photo2 ? { photo2 } : {}),
      ...(photo3 ? { photo3 } : {}),
    },
  });

  revalidatePath(`/shop/${parsed.data.itemId}`);
  revalidatePath(`/admin/items/${parsed.data.itemId}/details`);
  redirect(`/admin/items/${parsed.data.itemId}/details`);
}

async function optionalPhoto(file: File | null) {
  if (!file || file.size === 0) return undefined;
  return saveImage(file);
}

async function saveImage(file: File) {
  const bytes = await file.arrayBuffer();
  const buffer = Buffer.from(bytes);
  const ext = path.extname(file.name) || ".jpg";
  const safeName = `${Date.now()}-${Math.random().toString(36).slice(2)}${ext}`;
  const dir = path.join(process.cwd(), "public", "images");
  await mkdir(dir, { recursive: true });
  await writeFile(path.join(dir, safeName), buffer);
  return `/images/${safeName}`;
}
