"use server";

import { z } from "zod";

const contactSchema = z.object({
  name: z.string().min(1),
  email: z.string().email(),
  message: z.string().min(10),
});

export async function sendContact(formData: FormData) {
  const parsed = contactSchema.safeParse({
    name: formData.get("name"),
    email: formData.get("email"),
    message: formData.get("message"),
  });

  if (!parsed.success) {
    return { error: "Please fill in all fields correctly." };
  }

  if (process.env.NODE_ENV === "development") {
    console.log("[contact]", parsed.data);
  }

  return { success: "Thanks for reaching out! We'll get back to you soon." };
}
