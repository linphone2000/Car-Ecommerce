import { AuthLayout } from "@/components/auth/auth-layout";
import { LoginForm } from "@/components/auth/login-form";
import { Suspense } from "react";

export default function AdminLoginPage() {
  return (
    <AuthLayout title="Admin portal" subtitle="Authorized staff only.">
      <Suspense fallback={<p>Loading...</p>}>
        <LoginForm callbackUrl="/admin" />
      </Suspense>
    </AuthLayout>
  );
}
