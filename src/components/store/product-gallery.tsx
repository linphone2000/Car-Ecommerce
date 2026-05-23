"use client";

import { cn } from "@/lib/utils";
import Image from "next/image";
import { useState } from "react";

export function ProductGallery({
  mainImage,
  extraPhotos,
  alt,
}: {
  mainImage: string | null;
  extraPhotos: string[];
  alt: string;
}) {
  const images = [mainImage, ...extraPhotos].filter(Boolean) as string[];
  const [active, setActive] = useState(images[0] ?? null);

  if (!active && images.length === 0) {
    return (
      <div className="flex aspect-[4/3] items-center justify-center rounded-xl bg-muted text-muted-foreground">
        No image available
      </div>
    );
  }

  return (
    <div className="space-y-4">
      <div className="relative aspect-[4/3] overflow-hidden rounded-xl border border-border bg-card">
        {active && (
          <Image
            src={active}
            alt={alt}
            fill
            className="object-contain p-4"
            priority
            sizes="(max-width: 1024px) 100vw, 50vw"
          />
        )}
      </div>
      {images.length > 1 && (
        <div className="grid grid-cols-4 gap-2">
          {images.map((src) => (
            <button
              key={src}
              type="button"
              onClick={() => setActive(src)}
              className={cn(
                "relative aspect-square overflow-hidden rounded-lg border-2 bg-muted transition-colors",
                active === src ? "border-primary" : "border-transparent hover:border-border"
              )}
            >
              <Image src={src} alt="" fill className="object-contain p-1" />
            </button>
          ))}
        </div>
      )}
    </div>
  );
}
