import { AuthLayout } from "@/components/auth/auth-layout";
import { RegisterForm } from "@/components/auth/register-form";

type Props = { searchParams: Promise<{ b2b?: string }> };

export default async function RegisterPage({ searchParams }: Props) {
  const { b2b } = await searchParams;
  const isB2B = b2b === "1";

  return (
    <AuthLayout
      title={isB2B ? "Fleet & B2B" : "Join Rev Up Auto"}
      subtitle={
        isB2B
          ? "Register your fleet account for bulk ordering and invoice billing."
          : "Create an account to save your details and track every order."
      }
    >
      <RegisterForm role={isB2B ? "B2B" : "CUSTOMER"} />
    </AuthLayout>
  );
}
