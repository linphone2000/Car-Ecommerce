"use client";

import { registerUser } from "@/actions/auth";
import { PasswordInput } from "@/components/auth/password-input";
import { Alert, AlertDescription } from "@/components/ui/alert";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Truck } from "lucide-react";
import { signIn } from "next-auth/react";
import Link from "next/link";
import { useRouter } from "next/navigation";
import { useState } from "react";

export function RegisterForm({ role }: { role: "CUSTOMER" | "B2B" }) {
  const router = useRouter();
  const [error, setError] = useState<string | null>(null);
  const [loading, setLoading] = useState(false);

  async function onSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();
    setLoading(true);
    setError(null);
    const formData = new FormData(e.currentTarget);
    formData.set("role", role);
    const result = await registerUser(formData);
    if (result?.error) {
      setError(result.error);
      setLoading(false);
      return;
    }
    const email = String(formData.get("email"));
    const password = String(formData.get("password"));
    await signIn("credentials", { email, password, redirect: false });
    router.push("/shop");
    router.refresh();
  }

  return (
    <Card>
      <CardHeader>
        <CardTitle className="font-heading">
          {role === "B2B" ? "B2B registration" : "Create account"}
        </CardTitle>
        <CardDescription>
          {role === "B2B"
            ? "Fleet accounts receive bulk default cart quantities."
            : "Join Rev Up Auto to track orders and checkout faster."}
        </CardDescription>
      </CardHeader>
      <CardContent>
        {role === "B2B" && (
          <Alert className="mb-4 flex gap-2 border-primary/30 bg-primary/5">
            <Truck className="h-4 w-4 shrink-0 text-primary" />
            <AlertDescription>
              B2B members get quantity 5 per add-to-cart and invoice payment options.
            </AlertDescription>
          </Alert>
        )}
        <form onSubmit={onSubmit} className="space-y-4">
          {error && (
            <p className="rounded-md bg-destructive/10 px-3 py-2 text-sm text-destructive" role="alert">
              {error}
            </p>
          )}
          <div>
            <Label htmlFor="name">Name</Label>
            <Input id="name" name="name" required className="mt-1" />
          </div>
          <div>
            <Label htmlFor="email">Email</Label>
            <Input id="email" name="email" type="email" required className="mt-1" />
          </div>
          <div>
            <Label htmlFor="password">Password</Label>
            <div className="mt-1">
              <PasswordInput minLength={6} />
            </div>
          </div>
          <div>
            <Label htmlFor="address1">Address</Label>
            <Input id="address1" name="address1" className="mt-1" />
          </div>
          <div className="grid grid-cols-2 gap-4">
            <div>
              <Label htmlFor="city">City</Label>
              <Input id="city" name="city" className="mt-1" />
            </div>
            <div>
              <Label htmlFor="state">State</Label>
              <Input id="state" name="state" className="mt-1" />
            </div>
          </div>
          <div>
            <Label htmlFor="zip">ZIP</Label>
            <Input id="zip" name="zip" className="mt-1" />
          </div>
          <Button type="submit" className="w-full" disabled={loading}>
            {loading ? "Creating account..." : "Register"}
          </Button>
        </form>
        <p className="mt-6 text-center text-sm text-muted-foreground">
          Already have an account?{" "}
          <Link href="/login" className="font-medium text-primary hover:underline">
            Sign in
          </Link>
        </p>
      </CardContent>
    </Card>
  );
}
