import { Container } from "@/components/layout/container";
import Image from "next/image";

export function AuthLayout({
  title,
  subtitle,
  children,
}: {
  title: string;
  subtitle?: string;
  children: React.ReactNode;
}) {
  return (
    <div className="min-h-[calc(100vh-8rem)] bg-muted/30">
      <Container className="grid min-h-[calc(100vh-8rem)] items-stretch gap-0 py-8 md:grid-cols-2 md:py-12">
        <div className="relative hidden overflow-hidden rounded-2xl bg-header md:block">
          <Image
            src="/images/12255-2021-kia-k5.webp"
            alt=""
            fill
            className="object-cover opacity-50"
          />
          <div className="absolute inset-0 bg-gradient-to-t from-header via-header/60 to-transparent" />
          <div className="relative flex h-full flex-col justify-end p-10">
            <p className="text-sm font-semibold uppercase tracking-widest text-primary">
              Rev Up Auto
            </p>
            <h2 className="mt-2 font-heading text-3xl font-bold text-header-foreground">
              {title}
            </h2>
            {subtitle && (
              <p className="mt-3 max-w-sm text-header-foreground/80">{subtitle}</p>
            )}
          </div>
        </div>
        <div className="flex items-center justify-center py-8 md:py-0">
          <div className="w-full max-w-md">{children}</div>
        </div>
      </Container>
    </div>
  );
}
