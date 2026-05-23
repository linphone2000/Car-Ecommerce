import { Container } from "@/components/layout/container";
import { Section } from "@/components/layout/section";
import { ProductCard } from "@/components/store/product-card";
import { Button } from "@/components/ui/button";
import { prisma } from "@/lib/prisma";
import { Car, Shield, Truck } from "lucide-react";
import Image from "next/image";
import Link from "next/link";

const categories = ["Sedan", "SUV", "Truck", "Sports"];

export default async function HomePage() {
  const featured = await prisma.item.findMany({
    take: 4,
    orderBy: { id: "asc" },
  });

  return (
    <>
      <section className="relative min-h-[70vh] overflow-hidden bg-header">
        <Image
          src="/images/BMW-M5-PNG-HD.png"
          alt=""
          fill
          className="object-cover object-center opacity-40"
          priority
        />
        <div className="absolute inset-0 bg-gradient-to-r from-header via-header/90 to-header/40" />
        <Container className="relative flex min-h-[70vh] flex-col justify-center py-20">
          <p className="text-sm font-semibold uppercase tracking-[0.2em] text-primary">
            Premium automotive
          </p>
          <h1 className="mt-4 max-w-2xl font-heading text-4xl font-bold leading-tight text-header-foreground md:text-6xl">
            Drive something extraordinary
          </h1>
          <p className="mt-6 max-w-xl text-lg text-header-foreground/80">
            Curated sedans, SUVs, trucks, and sports cars. Retail and B2B fleet
            accounts welcome.
          </p>
          <div className="mt-10 flex flex-wrap gap-4">
            <Button asChild size="lg">
              <Link href="/shop">Browse inventory</Link>
            </Button>
            <Button
              asChild
              size="lg"
              variant="outline"
              className="border-header-foreground/30 bg-transparent text-header-foreground hover:bg-white/10"
            >
              <Link href="/register?b2b=1">B2B fleet</Link>
            </Button>
          </div>
        </Container>
      </section>

      <Section>
        <h2 className="font-heading text-2xl font-bold md:text-3xl">Featured vehicles</h2>
        <p className="mt-2 text-muted-foreground">Hand-picked from our current inventory</p>
        <div className="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
          {featured.map((item) => (
            <ProductCard key={item.id} item={item} />
          ))}
        </div>
        <div className="mt-8 text-center">
          <Button asChild variant="outline" size="lg">
            <Link href="/shop">View all vehicles</Link>
          </Button>
        </div>
      </Section>

      <Section className="bg-card border-y border-border">
        <h2 className="text-center font-heading text-2xl font-bold">Shop by category</h2>
        <div className="mt-8 grid grid-cols-2 gap-4 md:grid-cols-4">
          {categories.map((cat) => (
            <Link
              key={cat}
              href={`/shop?cat=${encodeURIComponent(cat)}`}
              className="group rounded-xl border border-border bg-background p-6 text-center transition-all hover:border-primary hover:shadow-md"
            >
              <Car className="mx-auto h-8 w-8 text-primary transition-transform group-hover:scale-110" />
              <p className="mt-3 font-heading font-semibold">{cat}</p>
            </Link>
          ))}
        </div>
      </Section>

      <Section>
        <div className="grid gap-8 md:grid-cols-3">
          {[
            { icon: Car, title: "Wide selection", text: "Filter by category or search by name and specs." },
            { icon: Truck, title: "B2B ready", text: "Fleet accounts receive bulk default cart quantities." },
            { icon: Shield, title: "Secure checkout", text: "Orders saved to your account with full history." },
          ].map(({ icon: Icon, title, text }) => (
            <div
              key={title}
              className="rounded-xl border border-border bg-card p-6 text-center"
            >
              <Icon className="mx-auto h-10 w-10 text-primary" />
              <h3 className="mt-4 font-heading text-lg font-semibold">{title}</h3>
              <p className="mt-2 text-sm text-muted-foreground">{text}</p>
            </div>
          ))}
        </div>
      </Section>
    </>
  );
}
