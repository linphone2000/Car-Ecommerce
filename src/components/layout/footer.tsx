import { Container } from "@/components/layout/container";
import Link from "next/link";

export function Footer() {
  return (
    <footer className="border-t border-white/10 bg-header text-header-foreground">
      <Container className="py-12">
        <div className="grid gap-10 md:grid-cols-3">
          <div>
            <p className="font-heading text-lg font-bold text-primary">REV UP AUTO</p>
            <p className="mt-3 max-w-sm text-sm text-header-foreground/70">
              Premium vehicles for retail buyers and B2B fleets. Browse inventory,
              compare specs, and order with confidence.
            </p>
          </div>
          <div>
            <p className="text-sm font-semibold uppercase tracking-wider text-primary">
              Quick links
            </p>
            <ul className="mt-4 space-y-2 text-sm">
              <li>
                <Link href="/shop" className="hover:text-primary">
                  Shop inventory
                </Link>
              </li>
              <li>
                <Link href="/about" className="hover:text-primary">
                  About us
                </Link>
              </li>
              <li>
                <Link href="/contact" className="hover:text-primary">
                  Contact
                </Link>
              </li>
              <li>
                <Link href="/register?b2b=1" className="hover:text-primary">
                  B2B registration
                </Link>
              </li>
            </ul>
          </div>
          <div>
            <p className="text-sm font-semibold uppercase tracking-wider text-primary">
              Support
            </p>
            <p className="mt-4 text-sm text-header-foreground/70">
              sales@revupauto.com
              <br />
              Mon–Fri, 9am–6pm CT
            </p>
          </div>
        </div>
        <div className="mt-10 flex flex-col items-center justify-between gap-2 border-t border-white/10 pt-8 text-center text-xs text-header-foreground/60 sm:flex-row sm:text-left">
          <p>&copy; {new Date().getFullYear()} Rev Up Auto. All rights reserved.</p>
          <p>Secure checkout · B2B fleet pricing · Trusted dealers</p>
        </div>
      </Container>
    </footer>
  );
}
