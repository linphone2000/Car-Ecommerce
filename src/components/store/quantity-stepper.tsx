"use client";

import { updateCartQuantity } from "@/actions/cart";
import { Button } from "@/components/ui/button";
import { Minus, Plus } from "lucide-react";
import { useRouter } from "next/navigation";
import { useTransition } from "react";

export function QuantityStepper({
  itemId,
  quantity,
}: {
  itemId: number;
  quantity: number;
}) {
  const [pending, startTransition] = useTransition();
  const router = useRouter();

  function change(delta: number) {
    const formData = new FormData();
    formData.set("itemId", String(itemId));
    formData.set("delta", String(delta));
    startTransition(async () => {
      await updateCartQuantity(formData);
      router.refresh();
    });
  }

  return (
    <div className="flex items-center gap-1">
      <Button
        type="button"
        variant="outline"
        size="icon"
        className="h-9 w-9"
        disabled={pending}
        aria-label="Decrease quantity"
        onClick={() => change(-1)}
      >
        <Minus className="h-4 w-4" />
      </Button>
      <span className="min-w-[2rem] text-center font-medium tabular-nums">
        {quantity}
      </span>
      <Button
        type="button"
        variant="outline"
        size="icon"
        className="h-9 w-9"
        disabled={pending}
        aria-label="Increase quantity"
        onClick={() => change(1)}
      >
        <Plus className="h-4 w-4" />
      </Button>
    </div>
  );
}
