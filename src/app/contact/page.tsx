import { ContactForm } from "@/components/contact/contact-form";
import { Container } from "@/components/layout/container";
import { PageHeader } from "@/components/layout/page-header";
import { Card, CardContent } from "@/components/ui/card";
import { Mail, MapPin, Phone } from "lucide-react";

export default function ContactPage() {
  return (
    <Container className="py-10">
      <PageHeader
        title="Contact us"
        description="Questions about a vehicle or your order? We're here to help."
      />
      <div className="grid gap-8 lg:grid-cols-3">
        <div className="space-y-4 lg:col-span-1">
          {[
            { icon: Mail, label: "Email", value: "sales@revupauto.com" },
            { icon: Phone, label: "Phone", value: "(555) 123-4567" },
            { icon: MapPin, label: "Hours", value: "Mon–Fri, 9am–6pm CT" },
          ].map(({ icon: Icon, label, value }) => (
            <Card key={label}>
              <CardContent className="flex items-start gap-3 p-4">
                <Icon className="mt-0.5 h-5 w-5 text-primary" />
                <div>
                  <p className="text-sm font-medium">{label}</p>
                  <p className="text-sm text-muted-foreground">{value}</p>
                </div>
              </CardContent>
            </Card>
          ))}
        </div>
        <div className="lg:col-span-2">
          <ContactForm />
        </div>
      </div>
    </Container>
  );
}
