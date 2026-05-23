"use server";

import { prisma } from "@/lib/prisma";
import { Role } from "@prisma/client";
import bcrypt from "bcryptjs";
import { z } from "zod";

const registerSchema = z.object({
  name: z.string().min(1),
  email: z.string().email(),
  password: z.string().min(6),
  role: z.enum(["CUSTOMER", "B2B"]).default("CUSTOMER"),
  payment: z.string().optional(),
  address1: z.string().optional(),
  address2: z.string().optional(),
  city: z.string().optional(),
  state: z.string().optional(),
  zip: z.string().optional(),
});

export async function registerUser(formData: FormData) {
  const parsed = registerSchema.safeParse({
    name: formData.get("name"),
    email: formData.get("email"),
    password: formData.get("password"),
    role: formData.get("role") || "CUSTOMER",
    payment: formData.get("payment") || undefined,
    address1: formData.get("address1") || undefined,
    address2: formData.get("address2") || undefined,
    city: formData.get("city") || undefined,
    state: formData.get("state") || undefined,
    zip: formData.get("zip") || undefined,
  });

  if (!parsed.success) {
    return { error: "Invalid registration data." };
  }

  const email = parsed.data.email.toLowerCase();
  const existing = await prisma.user.findUnique({ where: { email } });
  if (existing) {
    return { error: "An account with this email already exists." };
  }

  const passwordHash = await bcrypt.hash(parsed.data.password, 10);
  await prisma.user.create({
    data: {
      name: parsed.data.name,
      email,
      password: passwordHash,
      role: parsed.data.role as Role,
      payment: parsed.data.payment,
      address1: parsed.data.address1,
      address2: parsed.data.address2,
      city: parsed.data.city,
      state: parsed.data.state,
      zip: parsed.data.zip,
    },
  });

  return { success: true };
}
