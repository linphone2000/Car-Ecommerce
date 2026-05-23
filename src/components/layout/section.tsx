import { Container } from "@/components/layout/container";
import { cn } from "@/lib/utils";

export function Section({
  className,
  children,
  container = true,
}: {
  className?: string;
  children: React.ReactNode;
  container?: boolean;
}) {
  const content = container ? <Container>{children}</Container> : children;
  return <section className={cn("py-12 md:py-16", className)}>{content}</section>;
}
