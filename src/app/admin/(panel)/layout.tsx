import { AdminNav } from "@/components/admin/admin-nav";

export default function AdminLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <div className="flex min-h-[calc(100vh-4rem)] flex-col md:flex-row">
      <AdminNav />
      <div className="flex-1 bg-muted/20 p-6 md:p-8">{children}</div>
    </div>
  );
}
