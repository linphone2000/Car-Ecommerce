import { AuthLayout } from "@/components/auth/auth-layout";
import { LoginForm } from "@/components/auth/login-form";
import { Suspense } from "react";

export default function LoginPage() {
  return (
    <AuthLayout
      title="Welcome back"
      subtitle="Sign in to manage orders, saved details, and fleet pricing."
    >
      <Suspense fallback={<p className="text-center text-muted-foreground">Loading...</p>}>
        <LoginForm />
      </Suspense>
    </AuthLayout>
  );
}
