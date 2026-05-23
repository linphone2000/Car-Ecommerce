"use client";

import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { Search, X } from "lucide-react";
import Link from "next/link";
import { useRouter, useSearchParams } from "next/navigation";

export function ShopToolbar({
  categories,
  currentCat,
  currentQ,
  currentSort,
}: {
  categories: string[];
  currentCat?: string;
  currentQ?: string;
  currentSort?: string;
}) {
  const router = useRouter();
  const searchParams = useSearchParams();

  function updateParams(updates: Record<string, string | null>) {
    const params = new URLSearchParams(searchParams.toString());
    Object.entries(updates).forEach(([k, v]) => {
      if (v === null || v === "") params.delete(k);
      else params.set(k, v);
    });
    router.push(`/shop?${params.toString()}`);
  }

  const hasFilters = !!(currentCat || currentQ);

  return (
    <div className="space-y-4">
      <form
        className="flex flex-col gap-3 sm:flex-row"
        onSubmit={(e) => {
          e.preventDefault();
          const fd = new FormData(e.currentTarget);
          updateParams({ q: (fd.get("q") as string) || null });
        }}
      >
        <div className="relative flex-1">
          <Search className="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-muted-foreground" />
          <Input
            name="q"
            placeholder="Search vehicles..."
            defaultValue={currentQ ?? ""}
            className="pl-9"
          />
        </div>
        <Select
          value={currentSort ?? "name-asc"}
          onValueChange={(v) => updateParams({ sort: v })}
        >
          <SelectTrigger className="w-full sm:w-[180px]">
            <SelectValue placeholder="Sort by" />
          </SelectTrigger>
          <SelectContent>
            <SelectItem value="name-asc">Name A–Z</SelectItem>
            <SelectItem value="name-desc">Name Z–A</SelectItem>
            <SelectItem value="price-asc">Price: Low to high</SelectItem>
            <SelectItem value="price-desc">Price: High to low</SelectItem>
          </SelectContent>
        </Select>
        <Button type="submit">Search</Button>
      </form>

      <div className="flex flex-wrap items-center gap-2">
        <Link href="/shop">
          <Badge variant={!currentCat ? "default" : "outline"} className="cursor-pointer">
            All
          </Badge>
        </Link>
        {categories.map((category) => {
          const href = currentQ
            ? `/shop?cat=${encodeURIComponent(category)}&q=${encodeURIComponent(currentQ)}${currentSort ? `&sort=${currentSort}` : ""}`
            : `/shop?cat=${encodeURIComponent(category)}${currentSort ? `&sort=${currentSort}` : ""}`;
          return (
            <Link key={category} href={href}>
              <Badge
                variant={currentCat === category ? "default" : "outline"}
                className="cursor-pointer"
              >
                {category}
              </Badge>
            </Link>
          );
        })}
        {hasFilters && (
          <Button variant="ghost" size="sm" asChild className="h-7 gap-1 text-muted-foreground">
            <Link href="/shop">
              <X className="h-3 w-3" />
              Clear filters
            </Link>
          </Button>
        )}
      </div>
    </div>
  );
}
