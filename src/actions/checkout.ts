"use server";

import { auth } from "@/lib/auth";
import { clearCart, getCart } from "@/lib/cart";
import { prisma } from "@/lib/prisma";
import { revalidatePath } from "next/cache";
import { redirect } from "next/navigation";
import { z } from "zod";

const checkoutSchema = z.object({
  guestEmail: z.string().email().optional(),
  name: z.string().min(1).optional(),
  payment: z.string().optional(),
  address1: z.string().optional(),
  address2: z.string().optional(),
  city: z.string().optional(),
  state: z.string().optional(),
  zip: z.string().optional(),
  cardLast4: z.string().max(4).optional(),
});

export async function placeOrder(formData: FormData) {
  const session = await auth();
  const cart = await getCart();
  if (cart.length === 0) {
    redirect("/cart");
  }

  const parsed = checkoutSchema.safeParse({
    guestEmail: formData.get("guestEmail") || undefined,
    name: formData.get("name") || undefined,
    payment: formData.get("payment") || undefined,
    address1: formData.get("address1") || undefined,
    address2: formData.get("address2") || undefined,
    city: formData.get("city") || undefined,
    state: formData.get("state") || undefined,
    zip: formData.get("zip") || undefined,
    cardLast4: formData.get("cardLast4") || undefined,
  });

  if (!parsed.success) {
    redirect("/checkout?error=1");
  }

  const userId = session?.user?.id ? Number(session.user.id) : null;

  if (!userId && !parsed.data.guestEmail) {
    redirect("/checkout?error=guest-email");
  }

  if (userId && parsed.data.name) {
    await prisma.user.update({
      where: { id: userId },
      data: {
        name: parsed.data.name,
        payment: parsed.data.payment,
        address1: parsed.data.address1,
        address2: parsed.data.address2,
        city: parsed.data.city,
        state: parsed.data.state,
        zip: parsed.data.zip,
        cardLast4: parsed.data.cardLast4,
      },
    });
  }

  await prisma.order.create({
    data: {
      userId: userId ?? undefined,
      guestEmail: userId ? undefined : parsed.data.guestEmail,
      items: {
        create: cart.map((line) => ({
          itemId: line.itemId,
          name: line.name,
          quantity: line.quantity,
          unitPrice: line.price,
        })),
      },
    },
  });

  await clearCart();
  revalidatePath("/orders");
  revalidatePath("/admin/orders");
  if (userId) {
    redirect("/orders?success=1");
  }
  redirect("/shop?success=1");
}
