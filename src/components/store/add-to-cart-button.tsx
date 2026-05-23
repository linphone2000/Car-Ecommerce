"use client";

import { addToCart } from "@/actions/cart";
import { Button } from "@/components/ui/button";
import { Loader2, ShoppingCart } from "lucide-react";
import { useTransition } from "react";
import { toast } from "sonner";

type Props = {
  itemId: number;
  name: string;
  price: number;
  image: string | null;
  size?: "default" | "sm" | "lg";
  className?: string;
  label?: string;
};

export function AddToCartButton({
  itemId,
  name,
  price,
  image,
  size = "sm",
  className,
  label = "Add to cart",
}: Props) {
  const [pending, startTransition] = useTransition();

  function handleClick() {
    const formData = new FormData();
    formData.set("itemId", String(itemId));
    formData.set("name", name);
    formData.set("price", String(price));
    formData.set("image", image ?? "");

    startTransition(async () => {
      await addToCart(formData);
      toast.success("Added to cart", {
        description: name,
        action: {
          label: "View cart",
          onClick: () => {
            window.location.href = "/cart";
          },
        },
      });
    });
  }

  return (
    <Button
      type="button"
      size={size}
      className={className}
      disabled={pending}
      onClick={handleClick}
    >
      {pending ? (
        <Loader2 className="h-4 w-4 animate-spin" />
      ) : (
        <ShoppingCart className="h-4 w-4" />
      )}
      {label}
    </Button>
  );
}
